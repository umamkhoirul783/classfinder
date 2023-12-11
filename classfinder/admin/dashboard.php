<?php
session_start();
// include('../includes/header.php')

// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
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
    <title>Admin Dashboard - ClassFinder</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <h2>Welcome, <?php echo $username; ?> (Admin)</h2>
        </div>

        <div class="sidebar">
            <a href="dashboard.php">Overview</a>
            <a href="manage_rooms.php">Manage Rooms</a>
            <a href="manage_requests.php">Manage Requests</a>
            <!-- <a href="manage_users.php">Manage Users</a> -->
            <a href="../calendar/events.php">Event Calendar</a>
            <a href="../notifications/notif_admin.php">Notifications</a>
            <a href="../logout.php">Logout</a>
        </div>

        <div class="content">
            <!-- Konten dashboard untuk admin -->
            <p>Admin-specific content goes here.</p>
        </div>
    </div>
</body>
</html>
