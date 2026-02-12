<?php
include("connection.php");

// Display errors for debugging (disable in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Sanitize and validate inputs
echo $email = mysqli_real_escape_string($connect, $_POST['email']);
echo $from_date = mysqli_real_escape_string($connect, $_POST['from_date']);
echo $to_date = mysqli_real_escape_string($connect, $_POST['to_date']);
echo $C_name = mysqli_real_escape_string($connect, $_POST['C_name']);

echo $team = mysqli_real_escape_string($connect, $_POST['team']);
echo $room_id = mysqli_real_escape_string($connect, $_POST['room_id']);

echo $phone = mysqli_real_escape_string($connect, $_POST['phone']);

echo $address = mysqli_real_escape_string($connect, $_POST['address']);


$currentDate = date('Y-m-d');
$status = 'BOOKED';
$mode = 'WEBSITE';

// Validate date inputs
if (!strtotime($from_date) || !strtotime($to_date)) {
    die("Invalid dates provided.");
}

// Calculate the number of days
$startDate = new DateTime($from_date);
$endDate = new DateTime($to_date);
$num_of_days = $startDate->diff($endDate)->days;

// Calculate the previous day's date
$dateTime = new DateTime($to_date);
$dateTime->modify('-1 day');
$previousDate = $dateTime->format('Y-m-d');

// Fetch room details from `sub_category_price`
$query = "SELECT `charges`, `sub_category`, `cgst`, `sgst`, `taxable_price`, `room_type`
          FROM `sub_category_price` 
          WHERE id='$room_id'";
$result = mysqli_query($connect, $query);

if ($result && $row = mysqli_fetch_assoc($result)) {
    $charges1 = $row['charges'];
    $sub_category = $row['sub_category'];
    $cgst1 = $row['cgst'];
    $sgst1 = $row['sgst'];
    $taxable_price1 = $row['taxable_price'];
    $room_type = strtoupper($row['room_type']); // Convert room type to uppercase

    // Calculate charges, taxes, and taxable price for the duration
    $charges = $charges1 * $num_of_days;
    $cgst = $cgst1 * $num_of_days;
    $sgst = $sgst1 * $num_of_days;
    $taxable_price = $taxable_price1 * $num_of_days;




 $sql = "INSERT INTO `bookings_villa` 
        (`room_id`, `from_date`, `to_date`, `team`, `C_name`, `phone`, `email`, `charges`, `status`, 
         `left_amount`, `output_checkout`, `taxable_price`, `cgst`, `sgst`, `address`, `BOOKING_MODE`, `booking_date`) 
        SELECT '$room_id', '$from_date', '$to_date', '$team', '$C_name', '$phone', '$email', '$charges', '$status', 
               '$charges', '$previousDate', '$taxable_price', '$cgst', '$sgst', '$address', '$mode', '$currentDate' 
        WHERE NOT EXISTS (
            SELECT 1 
            FROM `bookings_villa` 
            WHERE `room_id` = '$room_id' 
            AND `from_date` = '$from_date' 
            AND `to_date` = '$to_date'
        )";


    if (mysqli_query($connect, $sql)) {
        // Redirect to confirmation page if insertion is successful
        header("Location: book_villa_customers3.php?" . http_build_query([
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
    } else {
        echo "Error inserting booking: " . mysqli_error($connect);
    }
} else {
    echo "Error fetching room details: " . mysqli_error($connect);
}
?>
