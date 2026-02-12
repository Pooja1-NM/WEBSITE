<?php 
include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phone = $_POST['phone'];
    $table_name = $_POST['table_name'];
    $password = $_POST['password'];
$cn_date = date("Y-m-d");
    // Check if fields are empty
    if (empty($phone) || empty($password)) {
        echo "<script>alert('Please enter both userphone and password.');</script>";
        header('Refresh: 0; url=guest_type.php');
        exit();
    }


$query = mysqli_query($connect, "SELECT `email`, `name`,`id`   FROM cafe_customer_data WHERE phone ='$phone' AND cpassword ='$password' ");
                                        
                                        while ($row = mysqli_fetch_array($query)) {
                                            $email = htmlspecialchars($row['email']);
                                            $name = htmlspecialchars($row['name']);
                                            $id = htmlspecialchars($row['id']);
										}


    // Use prepared statements to prevent SQL injection SELECT `phone`, `phone`, `email`, `password`, `Cpassword`, `address`, `guest_type`, `id` FROM `cafe_customer_data` WHERE 1
    $stmt = $connect->prepare("SELECT * FROM cafe_customer_data WHERE phone = ? AND cpassword = ?");
    $stmt->bind_param("ss", $phone, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        // User found, proceed to dashboard
        header("Location: food_order1.php?phone=$phone&email=$email&table_name=$table_name&cn_date=$cn_date&name=$name&id=$id");

        exit();
    } else {
        // User not found, show error
        echo "<script>alert('Invalid userphone or password. Please try again.');</script>";
        header('Refresh: 0; url=guest_type.php');
        exit();
    }

    // Close the statement
    $stmt->close();
}
?>
