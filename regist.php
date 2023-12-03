<?php
require 'connect.php';
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];

$query_sql = "INSERT INTO registerpage (fullname, email, username, password) 
            VALUES ('$fullname', '$email', '$username', '$password')";

if (mysqli_query($conn, $query_sql)) {
    header("Location: loginpage.html");
} else {
    echo "Registration Failed: " . mysqli_error($conn);
}