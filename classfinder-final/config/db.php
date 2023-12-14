<?php

$host = "localhost"; // nama host MySQL
$username = "root"; // nama pengguna MySQL
$password = ""; // kata sandi MySQL
$database = "database_classfinder"; // nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

//Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
} else {
    echo "";
}
// Set karakter set untuk koneksi
mysqli_set_charset($conn, "utf8");
