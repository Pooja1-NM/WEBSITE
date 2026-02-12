<?php
ob_start();
include("connection.php");

// Display errors for debugging (disable in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

/* =========================
   SANITIZE INPUTS
========================= */
$from_date = mysqli_real_escape_string($connect, $_POST['from_date']);
$to_date   = mysqli_real_escape_string($connect, $_POST['to_date']);
$team      = mysqli_real_escape_string($connect, $_POST['team']);
$room_id   = mysqli_real_escape_string($connect, $_POST['room_id']);
$C_name    = mysqli_real_escape_string($connect, $_POST['C_name']);
$phone     = mysqli_real_escape_string($connect, $_POST['phone']);
$email     = mysqli_real_escape_string($connect, $_POST['email']);
$address   = mysqli_real_escape_string($connect, $_POST['address']);

$currentDate = date('Y-m-d');
$status = 'BOOKED';
$mode   = 'WEBSITE';

/* =========================
   VALIDATE DATES
========================= */
if (!strtotime($from_date) || !strtotime($to_date)) {
    die("Invalid date format.");
}

if ($from_date >= $to_date) {
    die("Check-out date must be after check-in date.");
}

/* =========================
   CALCULATE DAYS
========================= */
$startDate = new DateTime($from_date);
$endDate   = new DateTime($to_date);
$num_of_days = max(1, $startDate->diff($endDate)->days);

/* =========================
   PREVIOUS DATE (CHECKOUT -1)
========================= */
$previousDate = date('Y-m-d', strtotime($to_date . ' -1 day'));

/* =========================
   CHECK ROOM AVAILABILITY
========================= */
/*
$checkQuery = "
    SELECT 1 FROM bookings_apartments
    WHERE room_id = '$room_id'
    AND status = 'BOOKED'
    AND (
        ('$from_date' BETWEEN from_date AND to_date)
        OR ('$previousDate' BETWEEN from_date AND to_date)
        OR (from_date BETWEEN '$from_date' AND '$previousDate')
    )
";


$checkResult = mysqli_query($connect, $checkQuery);
if (mysqli_num_rows($checkResult) > 0) {
    die("Room already booked for selected dates.");
}*/

/* =========================
   FETCH ROOM PRICES
========================= */
$query = "
    SELECT charges, sub_category, cgst, sgst, taxable_price, room_type
    FROM sub_category_price
    WHERE id = '$room_id'
";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Room pricing not found.");
}

$row = mysqli_fetch_assoc($result);

$charges1        = $row['charges'];
$cgst1           = $row['cgst'];
$sgst1           = $row['sgst'];
$taxable_price1 = $row['taxable_price'];
$room_type       = strtoupper($row['room_type']);

/* =========================
   TOTAL CALCULATIONS
========================= */
$charges        = $charges1 * $num_of_days;
$cgst           = $cgst1 * $num_of_days;
$sgst           = $sgst1 * $num_of_days;
$taxable_price  = $taxable_price1 * $num_of_days;

/* =========================
   INSERT BOOKING
========================= */
$sql = "
INSERT INTO bookings_apartments
(room_id, from_date, to_date, team, C_name, phone, email, charges, status,
 left_amount, output_checkout, taxable_price, cgst, sgst, address,
 BOOKING_MODE, booking_date)
VALUES
('$room_id', '$from_date', '$to_date', '$team', '$C_name', '$phone', '$email',
 '$charges', '$status', '$charges', '$previousDate',
 '$taxable_price', '$cgst', '$sgst', '$address', '$mode', '$currentDate')
";

if (!mysqli_query($connect, $sql)) {
    die("Booking failed: " . mysqli_error($connect));
}

/* =========================
   REDIRECT TO CONFIRMATION
========================= */
header("Location: book_apartments_customers3.php?" . http_build_query([
    'email' => $email,
    'from_date' => $from_date,
    'to_date' => $to_date,
    'C_name' => $C_name,
    'address' => $address,
    'room_type' => $room_type,
    'team' => $team,
    'num_of_days' => $num_of_days,
    'taxable_price' => $taxable_price,
    'charges' => $charges,
    'cgst' => $cgst,
    'sgst' => $sgst
]));

exit;
?>
