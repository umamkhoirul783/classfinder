<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
    <div class="container" id="container">
        <div class="navbar">
        <h1>Class<span>Finder</span></h1>
            <ul>
                <li><a href="../user/dashboard.php">Overview</a></li>
                <li><a href="index.php">Classes</a></li>
                <li><a href="../notifications/notif_user.php">Notifications</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>  

        <!--OVERVIEW section start -->
        <section class="overview" id="overview">
            <img src="https://www.clipartkey.com/mpngs/m/118-1188761_avatar-cartoon-profile-picture-png.png" alt="Avatar" class="avatar">
            <main class="profile">
                <h3>Welcome<span> yourname</span></h3>
                <p>5302422030</p>
                <p>Informatics and Computer Engineering Education</p>
            </main>
        </section>
        <!--OVERVIEW section end -->
        <!--Classes section start -->
        <section class="classes" id="classes">
            <h2>Classrooms</h2>
        </section>
        <main class="rooms">
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room1">
                        <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-109</h3>
                        <p>Computer Lab</p>
                        <p>Capacity: 30</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room2">
                        <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-111</h3>
                        <p>Classroom</p>
                        <p>Capacity: 40</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room3">
                    <li class="booked">Booked</li>
                    </div>
                    <div class="content">
                        <h3>E11-112</h3>
                        <p>Classroom</p>
                        <p>Capacity: 35</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room4">
                    <li class="booked">Booked</li>
                    </div>
                    <div class="content">
                        <h3>E11-201</h3>
                        <p>Computer Lab</p>
                        <p>Capacity: 20</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room5">
                    <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-202</h3>
                        <p>Computer Lab</p>
                        <p>Capacity: 25</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room6">
                    <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-205</h3>
                        <p>Classroom</p>
                        <p>Capacity: 35</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room7">
                    <li class="booked">Booked</li>
                    </div>
                    <div class="content">
                        <h3>E11-206</h3>
                        <p>Classroom</p>
                        <p>Capacity: 35</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room8">
                    <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-207</h3>
                        <p>Classroom</p>
                        <p>Capacity: 35</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room9">
                    <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-209</h3>
                        <p>Classroom</p>
                        <p>Capacity: 35</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room10">
                    <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-210</h3>
                        <p>Classroom</p>
                        <p>Capacity: 40</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room11">
                    <li class="booked">Booked</li>
                    </div>
                    <div class="content">
                        <h3>E11-301</h3>
                        <p>Computer Lab</p>
                        <p>Capacity: 25</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room12">
                    <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-302</h3>
                        <p>Computer Lab</p>
                        <p>Capacity: 30</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room13">
                    <li class="booked">Booked</li>
                    </div>
                    <div class="content">
                        <h3>E11-305</h3>
                        <p>Classroom</p>
                        <p>Capacity: 35</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room14">
                    <li class="status">Available</li>
                    </div>
                    <div class="content">
                        <h3>E11-306</h3>
                        <p>Computer Lab</p>
                        <p>Capacity: 25</p>
                    </div>
                </div>
                <div class="box">
                    <div class="image">
                    <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room15">
                    <li class="booked">Booked</li>
                    </div>
                    <div class="content">
                        <h3>E11-307</h3>
                        <p>Classroom</p>
                        <p>Capacity: 30</p>
                    </div>
                </div>
        </main>
        <!--Classes section end -->
    </div>
</body>
</html>