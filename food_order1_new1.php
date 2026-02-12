<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Start session
    session_start();

    // Use session variables
    $name = $_SESSION['name'] ?? '';
    $table_name = $_SESSION['table_name'] ?? '';
    $cn_time = $_POST['cn_time'] ?? date('H:i:s'); // Default to current time if not set
    $selectedItems = $_POST['dish_name']; // Array of dish names
    $orderQuantities = $_POST['order_Quantity']; // Associative array of quantities
    $email = $_SESSION['email'] ?? '';
    $id = $_SESSION['id'] ?? '';
    $guest_type = 'External Guest';
    $invoice_status = 'No Invoice generated';
    $status = 'Order Placed';
    $monthName = date('F');
    $finalPrice = 0; // Initialize for revenue
    $cn_date = date('Y-m-d'); // Current date

    // Check if at least one checkbox was selected
    if (empty($selectedItems)) {
        echo "<script>
                alert('Please select at least one dish to place an order.');
                window.location.href='food_order.php';
              </script>";
        exit(); // Stop script if no item is selected
    }

    // Include database connection
    include("connection.php");
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    // Insert basic order info into draft table
    $sql = mysqli_query($connect, "INSERT INTO `today_food_order_draft`(`name`, `table_no`, `currentDate`, `time`, 
    `id_order`, `invoice_status`, `id`, `guest_type`)
    VALUES ('$name', '$table_name', '$cn_date', '$cn_time', '', '$invoice_status', '$id', '$guest_type')");

    // Prepare statement for food_order table
    $stmtOrder = $connect->prepare("INSERT INTO `food_order`(`dish_name`, `name`, `table_no`, `order_Quantity`, `currentDate`, `time`, 
    `status`, `charges`, `email`, `invoice_status`, `customer_id`, `guest_type`) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Loop through each selected dish
    foreach ($selectedItems as $dishName) {
        $quantity = (int)$orderQuantities[$dishName];

        // Fetch price for the dish
        $stmtPrice = $connect->prepare("SELECT `price` FROM `food_list` WHERE `dish_name` = ?");
        $stmtPrice->bind_param('s', $dishName);
        $stmtPrice->execute();
        $stmtPrice->bind_result($price);
        $stmtPrice->fetch();
        $stmtPrice->close();

        if (isset($price)) {
            $total = $price * $quantity;
            $finalPrice += $total;

            // Insert data into food_order
            $stmtOrder->bind_param('sssisssissis', $dishName, $name, $table_name, $quantity, $cn_date, $cn_time, $status, $total, $email, $invoice_status, $id, $guest_type);
            $stmtOrder->execute();
        }
    }

    // Close statement and connection
    $stmtOrder->close();
    $connect->close();

    // Redirect to checkout page with session variables
    // Ensure all four session variables are passed in the query string of the URL
    header("Location: check_out_page.php?name=$name&email=$email&table_name=$table_name&cn_date=$cn_date&id=$id");
    exit(); // Always call exit after header to stop script execution
}
?>
