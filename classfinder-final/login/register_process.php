<?php
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Lakukan hash password sesuai kebutuhan aplikasi
    // Contoh menggunakan Bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Periksa apakah username sudah digunakan
    $check_username_query = "SELECT * FROM users WHERE username = '$username'";
    $check_username_result = $conn->query($check_username_query);

    if ($check_username_result->num_rows > 0) {
        // Username sudah digunakan, mungkin berikan pesan kesalahan atau arahkan kembali ke halaman register
        header("location: register.php");
    } else {
        // Username tersedia, lanjutkan proses pendaftaran
        $register_query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
        if ($conn->query($register_query) === TRUE) {
            // Pendaftaran berhasil, arahkan ke halaman login
            header("location: login.php");
        } else {
            // Pendaftaran gagal, mungkin berikan pesan kesalahan atau arahkan kembali ke halaman register
            header("location: register.php");
        }
    }
}

// Tutup koneksi database (jika perlu)
$conn->close();
