<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include("connection.php");


ini_set('display_errors', 1);
error_reporting(E_ALL);

$guest_type='External Guest';

    $name = $_POST['name'];
    $table_name = $_POST['table_name'];
    $cn_date = $_POST['cn_date'];
    $cn_time = $_POST['cn_time'];
    $selectedItems = $_POST['dish_name']; // Array of dish names
    $orderQuantities = $_POST['order_Quantity']; // Associative array of quantities
    $email = $_POST['email'];
    $id = $_POST['id'];
    $invoice_status='No Invoice generated';
    $status = 'Order Placed';
    $monthName = date('F');
    $finalPrice = 0; // Initialize for revenue

    // Check if at least one checkbox was selected
    if (empty($selectedItems)) {
        echo "<script>
                alert('Please select at least one dish to place an order.');
                window.location.href='food_order.php';
              </script>";
        exit(); // Stop script if no item is selected
    }

    // Insert basic order info
    $sql = mysqli_query($connect, "INSERT INTO `today_food_order_draft`(`name`, `table_no`, `currentDate`, `time`, 
	`id_order`,`invoice_status`,`id`,`guest_type`)
	VALUES ('$name', '$table_name', '$cn_date', '$cn_time', '','$invoice_status','$id','$guest_type')");

    // Prepare statement for food_order table
    $stmtOrder = $connect->prepare("INSERT INTO `food_order`(`dish_name`, `name`, `table_no`, `order_Quantity`, `currentDate`, `time`, 
	`status`, `charges`, `email`,`invoice_status`,`customer_id`,`guest_type`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

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
            $stmtOrder->bind_param('sssisssissis', $dishName, $name, $table_name, $quantity, $cn_date, $cn_time, $status, $total, $email,$invoice_status,$id,$guest_type);
            $stmtOrder->execute();
        }
    }

   

    
    $stmtOrder->close();
    // $stmtRevenue->close();
    $connect->close();

    // Redirect if necessary
    // header("Location: process_order2.php");
    
    
            header("Location: external_guest_checkout.php?name=$name&email=$email&table_name=$table_name&cn_date=$cn_date&id=$id");

          
}
?>
