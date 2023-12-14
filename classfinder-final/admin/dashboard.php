<?php
session_start();
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
            <h2 style="text-align: center;">Welcome, <?php echo ucfirst($username); ?>! (Admin)</h2>
        </div>

        <div class="sidebar">
            <a href="dashboard.php">Overview</a>
            <a href="manage_rooms.php">Manage Rooms</a>
            <a href="manage_requests.php">Manage Requests</a>
            <a href="events.php">Event Calendar</a>
            <a href="notif_admin.php">Notifications</a>
            <a href="../logout.php">Logout</a>
        </div>

        <div class="content" style="text-align: center; line-height: 1.5;">
            <!-- Konten dashboard untuk admin -->
            <p>We are delighted to have you on board, steering the course of our digital journey. As you enter this virtual command center, we extend a warm greeting and express our gratitude for your invaluable role. This dashboard is designed to empower you with insights, tools, and functionalities to streamline and enhance your administrative tasks. It serves as a hub for efficient management and informed decision-making.</p>
            <p>Your expertise and dedication contribute significantly to our collective success. May your experience here be seamless, and may you find the resources at your fingertips both powerful and user-friendly. Thank you for being an essential part of our online ecosystem. Happy exploring!</p>
        </div>
    </div>
</body>
</html>