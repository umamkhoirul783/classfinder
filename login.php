<?php
require "connect.php";
$username = $_POST ["username"];
$password = $_POST ["password"];

$query_sql = "SELECT * FROM registerpage WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $query_sql);

if (mysqli_num_rows($result) > 0) {
    header("Location: dashboard.html");
} else {
    echo "<center><hi>Username atau Password Anda Salah. Silahkan Login Kembali.</h1>
            <button><strong><a href = 'index.html'>Login</a></strong></button></center>";
}