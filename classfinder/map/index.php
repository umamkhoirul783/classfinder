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

$roomData = array(
    array('id' => 1, 'name' => 'Room 101', 'capacity' => 20, 'position' => array(100, 200)),
    array('id' => 2, 'name' => 'Room 102', 'capacity' => 15, 'position' => array(300, 150)),
  // Tambahkan data ruangan lain sesuai kebutuhan
);

// Convert PHP array to JSON for use in JavaScript
$roomDataJson = json_encode($roomData);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Sertakan Leaflet CSS -->
    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> -->
    <title>Room Map - ClassFinder</title>
    <!-- <style>
        #map {
            background-image: url('path/to/your/floor_plan_image.jpg');
            background-size: contain;
            background-repeat: no-repeat;
            width: 100%;
            height: 500px;
        }
    </style> -->
</head>
<body>
    <div class="container">
        <div class="navbar">
            <h2>Welcome, <?php echo $username; ?> (User)</h2>
        </div>

        <div class="sidebar">
            <a href="../user/dashboard.php">Overview</a>
            <a href="index.php">Map</a>
            <a href="../rooms/room_info.php">Room Information</a>
            <!-- <a href="booking.php">Book a Room</a> -->
            <!-- <a href="booking_status.php">Booking Status</a> -->
            <a href="../notifications/notif_user.php">Notifications</a>
            <!-- <a href="profile.php">Profile</a> -->
            <a href="../logout.php">Logout</a>
        </div>

        <div class="content">
            <!-- Konten untuk tampilan peta dan informasi ruangan -->
            <h2>Room Map - E11 Building</h2>
            <!-- Sertakan Leaflet JavaScript -->
            <!-- <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> -->
            <div id="map"></div>

            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Inisialisasi peta Leaflet
                    var map = L.map('map').setView([0, 0], 1);

                    // Load the tile layer from OpenStreetMap
                    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    //     attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    // }).addTo(map);

                    // Room data dari PHP ke JavaScript
                    var roomData = <?php echo $roomDataJson; ?>;

                    // Tambahkan marker untuk setiap ruangan
                    roomData.forEach(function (room) {
                        var marker = L.marker(room.position)
                            .addTo(map)
                            .bindPopup('<b>' + room.name + '</b><br>Capacity: ' + room.capacity + ' people');
                        
                        // Tambahkan event klik ke marker
                        marker.on('click', function () {
                            // Implementasikan logika untuk menampilkan detail ruangan atau melakukan permintaan ruangan
                            alert('Room ' + room.name + ' clicked!');
                        });
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>