<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include("connection.php");

    // Fetching GET parameters
    $name = $_GET['name'];
    $table_no = $_GET['table_name'];
    $currentDate = $_GET['currentDate'];
    $email = $_GET['email'];
    $id = $_GET['id'];
    
    $invoice_status = 'Check Out Requested';
    $invoice_status_pre = 'No Invoice generated';
    
    
    // Set timezone and get the current time
    date_default_timezone_set('Asia/Kolkata');
    $current_time_in_india = date("H:i:s");

    // Prepared statement to prevent SQL injection for food_order table
    $query5 = $connect->prepare("UPDATE `food_order` SET `invoice_status`='Check Out Requested'  
    WHERE name=? AND table_no=? AND currentDate=? AND email=? AND customer_id=? AND invoice_status=?");
    $query5->bind_param('ssssis', $name, $table_no, $currentDate, $email, $id, $invoice_status_pre);
    $query5->execute();

    // Error handling for query5
    if ($query5->error) {
        echo "Error: " . $query5->error;
        exit();
    }

    // Updating second table (today_food_order_draft)
    $query6 = $connect->prepare("UPDATE `today_food_order_draft` SET `invoice_status`='Check Out Requested'  
    WHERE name=? AND table_no=? AND currentDate=?    AND id=? AND invoice_status=?");
    $query6->bind_param('sssis', $name, $table_no, $currentDate, $id, $invoice_status_pre);
    $query6->execute();

    // Error handling for query6
    if ($query6->error) {
        echo "Error: " . $query6->error;
        exit();
    }

    // Corrected INSERT statement for cafe_checkout table
    $query7 = $connect->prepare("INSERT INTO `cafe_checkout`(`name`, `table_no`, `currentDate`, `time`, `email`, `invoice_status`, `customer_id`)   
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $query7->bind_param('ssssssi', $name, $table_no, $currentDate, $current_time_in_india, $email, $invoice_status, $id);
    $query7->execute();

    // Error handling for query7
    if ($query7->error) {
        echo "Error: " . $query7->error;
        exit();
    }

    // Redirect with JavaScript
    echo "<script>
            alert('We hope you enjoyed your meal! Kindly proceed to checkout at your convenience..'); 
            window.location.href = 'food_order.php';
          </script>";
    exit();  // Stop further script execution after redirect
}
?>
