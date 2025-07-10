<?php
include 'includes/db.php'; // Ensure database connection is included

$email = "shreekudale166@gmail.com"; // Change to your admin email

$sql = "SELECT password FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "Stored Hashed Password: " . $row['password'];
} else {
    echo "No user found!";
}
?>
