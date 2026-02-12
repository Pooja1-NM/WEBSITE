<?php
include 'connection.php'; // Include database connection
include 'config.php';
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $otp = $_POST['otp'];
    $table_name = $_POST['table_name'];

$query10 = mysqli_query($connect, "SELECT `id`,`name` FROM cafe_customer_data WHERE email ='$email'");
                                        
                                        while ($row10 = mysqli_fetch_array($query10)) {
											
										$id=$row10[0];	
										$name=$row10[1];	
										}


    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Validate OTP format (numeric and 6 digits)
    if (!preg_match('/^\d{6}$/', $otp)) {
        die("Invalid OTP format. Please enter a 6-digit OTP.");
    }

    // Prepare the SQL query to prevent SQL injection
    $stmt = $connect->prepare("
        SELECT * FROM `otp_requests` 
        WHERE `email` = ? AND `otp` = ? AND `expires_at` > NOW()
    ");
    $stmt->bind_param('ss', $email, $otp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        echo "Login successful!";
        
        // Clear OTP after successful login
        $deleteStmt = $connect->prepare("DELETE FROM `otp_requests` WHERE `email` = ?");
        $deleteStmt->bind_param('s', $email);
        $deleteStmt->execute();

        // Set session and redirect to the dashboard
        $_SESSION['email'] = $email;
        //header("Location: food_order_new.php");
		header("Location: food_order1.php?id=$id&email=$email&name=$name&table_name=$table_name");
        exit;
    } else {
        echo "Invalid or expired OTP.";
    }

    $stmt->close();
	
	
	
}
?>
