<?php
ob_start(); // Start output buffering

include("connection.php");

// Display errors for debugging (disable in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Sanitize input
$email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
$from_date = htmlspecialchars($_GET['from_date']);
$to_date = htmlspecialchars($_GET['to_date']);
$C_name = htmlspecialchars($_GET['C_name']);
$address = htmlspecialchars($_GET['address']);

$room_type = htmlspecialchars($_GET['room_type']);
$team = htmlspecialchars($_GET['team']);

$num_of_days = htmlspecialchars($_GET['num_of_days']);
$taxable_price = htmlspecialchars($_GET['taxable_price']);
$charges = htmlspecialchars($_GET['charges']);
$cgst = htmlspecialchars($_GET['cgst']);
$sgst = htmlspecialchars($_GET['sgst']);




$queryy_new =mysqli_query($connect,"SELECT `villa_booking_id` FROM `bookings_apartments`
                                         WHERE from_date='$from_date' and email='$email' and to_date='$to_date' and C_name='$C_name' ");
                                        while ($row_new = mysqli_fetch_array($queryy_new)) {
                                            $villa_booking_id = htmlspecialchars($row_new['villa_booking_id']);
                                        }
                                        



$todayDate = date("Y-m-d");

require_once('AETHERIA_HOSPITALITY_software/TCPDF/tcpdf.php');

// Extend the TCPDF class to create a custom header
class CustomPDF extends TCPDF {
    public function Header() {
        // Path to the image file
        $imageFile = 'images/l1.jpg';

        // Get the total page width
        $pageWidth = $this->getPageWidth();

        // Set the width of the image
        $imageWidth = 50;

        // Calculate the X position to center the logo
        $centerX = ($pageWidth - $imageWidth) / 2 - 5;

        // Place the image in the center
        //$this->Image($imageFile, $centerX, 10, $imageWidth, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->Image($imageFile, $centerX, 10, 65, 30, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        // Add contact information
        $this->SetFont('helvetica', 'B', 15);
        $this->SetX(25);
       // $this->Cell(0, 70, 'THE AETHERIA HOSPITALITY', 0, true, 'C', 0, '', 0, false, 'T', 'C');
        $this->Line(10, 45, 200, 45);
    }
}

// Create PDF instance
$pdf = new CustomPDF();
$pdf->AddPage();

// Generate HTML content for the invoice
$html = "
<br><br><br><br><br><br><br><br>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Booking Confirmation Form</h2>

<table>

    <tr>
        <!-- Customer Information -->
       <td>
            <p><strong>Guest Name :</strong>$C_name<br>
<strong>Address :</strong>$address<br>
<strong>Booking Id :</strong> $villa_booking_id </p>
        </td>
        
        <!-- Cafe Information -->
        <td style='text-align: right;'>
            <p>
            <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AETHERIA SERVICE APARTMENTS</strong>
            <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; GSTIN:</strong> 29AXXXXXXXXXXX<br>
           <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Address:</strong> MMD village, Mugthihalli  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; post, Chikmagalur - 577133. <br>
           <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Phone No:</strong> 7019454382<br>
           </p>
        </td>
    </tr>
</table>

";

// Output the HTML content to the PDF
$pdf->writeHTML($html, true, false, true, false, '');


$pdf->Line(10, 111, 200, 111);

// Generate HTML content for the invoice
$html1 = "

<table>

    <tr>
        <!-- Customer Information -->
        <td>
            <p><strong>Check-In :</strong> $from_date<br><br>
<strong>Check-Out :</strong> $to_date<br><br>
<strong>Date of Booking :</strong> $todayDate<br><br>
<strong>Room Type :</strong> $room_type <br><br>
<strong>Room1 :</strong> $team Adults
</p>
        </td>
        
        <!-- Cafe Information -->
        <td style='text-align: right;'>
            <p>
           <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Room Charges:</strong> Rs. $taxable_price<br><br>
           <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; IGST Charges:</strong> Rs. 0<br><br>
        <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CGST Charges:</strong> Rs. $cgst<br><br>
        <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; SGST Charges:</strong> Rs. $sgst<br><br>
       <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Total Charges:</strong> Rs. $charges<br><br>
       
           </p>
        </td>
    </tr>
</table>
<p>
<strong>Inclusions:</strong> Accomodation only , Complimentory Daily Newspaper.</p>

";

// Output the HTML content to the PDF
$pdf->writeHTML($html1, true, false, true, false, '');


$pdf->Line(10, 200, 200, 200);

$html2 = "
<br><p><strong>Hotel Policy:</strong> Please ensure that the customer submits their Aadhaar card to the hotelier before                             completing the check-in process.</p>

";
$pdf->writeHTML($html2, true, false, true, false, '');

$pdf->Line(10, 222, 200, 222);

$html3 = "
<br><h2><strong>Cancellation & Amendment Policy</strong></h2><br>

";
$pdf->writeHTML($html3, true, false, true, false, '');
//$pdf->Line(10, 236, 200, 236);

// Clean buffer and output PDF
ob_end_clean(); // Clear the buffer
$pdfFilePath = __DIR__ . '/invoice.pdf';
$pdf->Output($pdfFilePath, 'F');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



$to_address = $email;
$subject1 = 'Booking Confirmation at AETHERIA SERVICE APARTMENTS';

$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'aetheriahospitality@gmail.com';       // Your Gmail address
    $mail->Password = 'vusa fndv buyc gudp';    // Use an App Password if 2-Step Verification is on
    
    
   
    
    
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('aetheriahospitality@gmail.com', 'THE AETHERIA HOSPITALITY');
    $mail->addAddress($to_address);
    $mail->addAttachment($pdfFilePath, 'Booking_Confirmation.pdf'); // File path and name


    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject1;
    $mail->Body = "
        Dear $C_name,<br><br>
        Thank you for choosing AETHERIA SERVICE APARTMENTS for your stay! We are delighted to welcome you.<br><br>
        Your booking has been confirmed as follows:<br>
        <b>Check-in Date:</b> $from_date<br>
        <b>Check-out Date:</b> $to_date<br><br>
        We hope you enjoy a relaxing and memorable stay with us. Should you need any assistance or have specific requests, 
        please feel free to reach out to us.<br><br>
        Thank you once again, and we look forward to hosting you!<br><br>
        Warm regards,<br>
        Sachin M S<br>
        AETHERIA SERVICE APARTMENTS<br>
        7019454382
    ";

    $mail->send();
    echo "ROOMS BOOKED SUCCESSFULLY.";
} catch (Exception $e) {
    echo " Error: {$mail->ErrorInfo}";
}



unlink($pdfFilePath);

?>

<script>
	   alert('ROOMS BOOKED SUCCESSFULLY.');
       window.location.href='about1.html';
        </script>
