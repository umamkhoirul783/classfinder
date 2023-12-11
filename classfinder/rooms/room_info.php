<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("location: ../login.php");
    exit();
}

// Ambil informasi pengguna dari sesi
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Placeholder for room data
// Anda seharusnya mengambil informasi ruangan dari basis data dan meneruskannya ke JavaScript
// $roomId = isset($_GET['id']) ? $_GET['id'] : 0;

// Contoh data ruangan (gantilah dengan logika pengambilan data dari database)
// $roomData = array(
//     1 => array('name' => 'Room 101', 'capacity' => 20, 'description' => 'Ruangan untuk seminar'),
//     2 => array('name' => 'Room 102', 'capacity' => 15, 'description' => 'Ruangan untuk rapat'),
//     // Tambahkan data ruangan lain sesuai kebutuhan
// );

// Ambil data ruangan berdasarkan ID
// $room = isset($roomData[$roomId]) ? $roomData[$roomId] : null;

// Redirect ke halaman map jika ruangan tidak ditemukan
// if (!$room) {
//     header("location: ../map/index.php");
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Room Information - ClassFinder</title>
</head>
<body>
    <div class="container">
        <div class="navbar">
            <h2>Welcome, <?php echo $username; ?> (User)</h2>
        </div>

        <div class="sidebar">
            <a href="../user/dashboard.php">Dashboard</a>
            <a href="../map/index.php">Map</a>
            <a href="room_info.php">Room Information</a>
            <!-- <a href="booking.php">Book a Room</a> -->
            <!-- <a href="booking_status.php">Booking Status</a> -->
            <a href="../notifications/notif_user.php">Notifications</a>
            <!-- <a href="../profile.php">Profile</a> -->
            <a href="../logout.php">Logout</a>
        </div>

        <div class="content">
            <h1>Room Info</h1>
            <!-- <h2>Room Information - <?php echo $room['name']; ?></h2> -->
            <!-- <p><strong>Capacity:</strong> <?php echo $room['capacity']; ?> people</p> -->
            <!-- <p><strong>Description:</strong> <?php echo $room['description']; ?></p> -->

            <!-- Form untuk permintaan ruangan -->
            <!-- <h3>Request This Room</h3>
            <form action="booking_process.php" method="post">
                <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                <label for="date">Date:</label>
                <input type="date" name="date" required>

                <label for="purpose">Purpose:</label>
                <textarea name="purpose" rows="4" required></textarea>

                <button type="submit">Submit Request</button>
            </form> -->
        </div>
    </div>
</body>
</html>
