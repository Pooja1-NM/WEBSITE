<?php
include("connection.php");
$c_name=$_POST['c_name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$message=$_POST['message'];



	
$query=mysqli_query($connect,"INSERT INTO `contact_website`(`c_name`, `phone`, `email`, `message`, `id`) 
VALUES ('$c_name','$phone','$email','$message','')");




header('location:index.html');


?>