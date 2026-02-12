<?php
// Database credentials
$mysqlUserName = "u850628302_root";
$mysqlPassword = "Pooja@1995nm";
$mysqlHostName = "localhost";
$DbName = "u850628302_aetheria";

// Create connection
$conn = new mysqli($mysqlHostName, $mysqlUserName, $mysqlPassword, $DbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully to the database!";
}

// Close the connection
$conn->close();
?>
