<?php

$host = "localhost"; // Ganti dengan nama host MySQL Anda
$username = "root"; // Ganti dengan nama pengguna MySQL Anda
$password = ""; // Ganti dengan kata sandi MySQL Anda
$database = "classfinder_db"; // Ganti dengan nama database Anda

// Membuat koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

//Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
} else {
    echo "Koneksi Berhasil!";
}

// Set karakter set untuk koneksi
mysqli_set_charset($conn, "utf8");
?>
