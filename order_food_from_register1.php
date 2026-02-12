<?php
include("connection.php");

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$guest = 'external';
//$table_name = $_POST['table_name'];

// Prepare and execute the SQL query
$stmt = $connect->prepare("INSERT INTO `cafe_customer_data` (`name`, `phone`, `email`, `address`, `guest_type`) 
VALUES (?, ?, ?, ?, ?)");

$stmt->bind_param("sssss", $name, $phone, $email, $address, $guest);

if ($stmt->execute()) {
    // Use prepared statement for the SELECT query
    $stmt_select = $connect->prepare("SELECT `id` FROM cafe_customer_data WHERE phone = ? AND name = ?");
    $stmt_select->bind_param("ss", $phone, $name);
    $stmt_select->execute();
    $result = $stmt_select->get_result();

    if ($row = $result->fetch_assoc()) {
        $id = htmlspecialchars($row['id']);
        // Proper header redirect and then the alert (after setting header)
        header("Location: otp_login.php");
        exit; // Make sure to stop execution after header redirect
    }
} else {
    // Correctly handling quotes for JavaScript
    echo "<script>
        alert('Error: Registration failed. Please try again later.');
        window.location.href='order_food_from_register.php';
    </script>";
}

// Close the statement and connection
$stmt->close();
$connect->close();
?>
