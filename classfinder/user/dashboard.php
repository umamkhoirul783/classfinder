<?php
session_start();

// Pastikan hanya user yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("location: ../login.php");
    exit();
}

// Ambil informasi pengguna dari sesi
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>User Dashboard - ClassFinder</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <h2>Welcome, <?php echo $username; ?> (User)</h2>
        </div>

        <div class="sidebar">
            <a href="dashboard.php">Overview</a>
            <a href="../map">Map</a>
            <!-- <a href="booking_status.php">Booking Status</a> -->
            <a href="../notifications/notif_user.php">Notifications</a>
            <!-- <a href="profile.php">Profile</a> -->
            <a href="../logout.php">Logout</a>
        </div>

        <div class="content">
            <!-- Konten dashboard untuk user -->
            <p>User-specific content goes here.</p>
        </div>
    </div>
</body>
</html>
