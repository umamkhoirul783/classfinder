<?php
session_start();
include('../config/db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Lakukan hash password menggunakan Bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();

        // Periksa apakah password sesuai dengan hash yang tersimpan
        if (password_verify($password, $user_data['password'])) {
            // Set sesi pengguna
            $_SESSION['user_id'] = $user_data['id_user'];
            $_SESSION['username'] = $user_data['username'];
            $_SESSION['role'] = $user_data['role'];

            // Login berhasil, arahkan ke halaman dashboard sesuai peran
            if ($_SESSION['role'] == 'admin') {
                header("location: dashboard.php");
            } else {
                header("location: ../user/dashboard.php");
            }
        } else {
            // Password tidak cocok, arahkan kembali ke halaman login
            header("location: login.php");
        }
    } else {
        // Pengguna tidak ditemukan, arahkan kembali ke halaman login
        header("location: login.php");
    }
}

// Tutup koneksi database (jika perlu)
$conn->close();
?>
