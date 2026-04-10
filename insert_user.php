<?php
include("db_connect.php");

$email = "test@gmail.com";
$password = "123";  // Plain password

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO login (email, password) VALUES ('$email', '$hashed_password')";

if ($conn->query($sql)) {
    echo "User inserted successfully!";
} else {
    echo "Error: " . $conn->error;
}
?>
