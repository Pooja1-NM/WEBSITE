<?php
include 'connection.php'; // Include DB connection
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    //$table_name = $_POST['table_name'];

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    // Check if the user exists
    $userCheckQuery = mysqli_query($connect, "SELECT * FROM `cafe_customer_data` WHERE `email` = '$email'");
    if (mysqli_num_rows($userCheckQuery) == 0) {
        die("User not found");
    }

    // Generate OTP
    $otp = rand(100000, 999999);
    $expiresAt = date("Y-m-d H:i:s", strtotime("+10 minutes"));

    // Save OTP in the database
    $insertOtpQuery = mysqli_query($connect, "
        INSERT INTO `otp_requests` (`email`, `otp`, `expires_at`) 
        VALUES ('$email', '$otp', '$expiresAt')
        ON DUPLICATE KEY UPDATE `otp` = '$otp', `expires_at` = '$expiresAt'
    ");

    if (!$insertOtpQuery) {
        die("Error saving OTP: " . mysqli_error($connect));
    }

    // Send OTP via email using PHPMailer
    $subject1 = "Your Login OTP";
    $message = "Your OTP for login is: $otp\nIt is valid for 10 minutes.";

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'aetheriahospitality@gmail.com';
        $mail->Password = 'cdcd frjb tvwt ugmg'; // Ensure this is kept secret
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('aetheriahospitality@gmail.com', 'AVA`S CAFE');
        $mail->addAddress($email);  // Customer's email address

        // Email content
        $mail->Subject = $subject1;
        $mail->Body    = $message;

        $mail->send();
        echo "OTP has been sent successfully!";
    } catch (Exception $e) {
        echo "OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
header("Location: otp_generate1.php?email=$email");
exit;
?>
