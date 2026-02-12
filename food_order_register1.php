<?php
include("connection.php");

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$Cpassword = $_POST['Cpassword'];
$address = $_POST['address'];
$guest = 'external';

// Check if passwords match
if ($password !== $Cpassword) {
    echo "<script>alert('Passwords do not match'); window.location.href='food_order_register.php';</script>";
    exit();
}

// Prepare and execute the SQL query
$stmt = $connect->prepare("INSERT INTO `cafe_customer_data` (`name`, `phone`, `email`, `Cpassword`, `address`, `guest_type`) 
VALUES (?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssss", $name, $phone, $email, $Cpassword, $address, $guest);

if ($stmt->execute()) {
    echo "<script>alert('Registration Successful! Please log in to place your food order.'); window.location.href='guest_type.php';</script>";
} else {
    echo "<script>alert('Error: Registration failed. Please try again later.'); window.location.href='food_order_register.php';</script>";
}

// Close the statement and connection
$stmt->close();
$connect->close();
?>
