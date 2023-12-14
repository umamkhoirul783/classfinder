<?php
session_start();
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editItemForm'])) {
    // Fetch data from the database
    include '../config/db.php';

    $id_user = $_SESSION['user_id'];
    $id_room = $_POST['id'];
    $description = $_POST['description'];
    $request_date = $_POST['request_date'];
    $capacity = $_POST['capacity'];
    $status = 'pending';

    // Perform SQL update
    $sql = "INSERT INTO requests (id_user, id_room, request_date, status, description) VALUES ('$id_user', '$id_room', '$request_date', '$status', '$description')";
    if ($conn->query($sql) === TRUE) {
        $room_info = $conn->query("SELECT * FROM rooms WHERE id_room = $id_room");
        if ($room_info) {
            $_room_info = $room_info->fetch_assoc();
            $_result = $conn->query("SELECT * FROM users WHERE role = 'admin'");
            while ($_row = $_result->fetch_assoc()) {
                try {
                    $id_user_admin = $_row['id_user'];
                    $message = 'ID User: ' . $_SESSION['username'] . ' is requested room ' . $_room_info['room_name'] . ' (' . $_room_info['type'] . ')';
                    $sql = "INSERT INTO notifications (id_user, message, status) VALUES ('$id_user_admin', '$message', 'unread')";
                    $conn->query($sql);
                } catch (\Throwable $th) {
                }
            }

            try {
                $message = 'Your request for room ' . $_room_info['room_name'] . ' (' . $_room_info['type'] . ') has been successfully submitted';
                $sql = "INSERT INTO notifications (id_user, message, status) VALUES ('$id_user', '$message', 'unread')";
                $conn->query($sql);
            } catch (\Throwable $th) {
            }
        }

        echo '<script>alert("' . $message . '. Please waiting from Admin for approval"); window.location.href = "' . $_SERVER['PHP_SELF'] . '";</script>';

        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Overview - ClassFinder</title>

    <style>
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            margin: auto;
        }

        .close {
            color: #fff;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: black;
        }
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="navbar">
            <h1>Class<span>Finder</span></h1>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="index.php">Overview</a></li>
                <li><a href="notif_user.php">Notifications</a></li>
                <li><a href="../logout.php">Logout</a></li>
            </ul>
        </div>

        <!--OVERVIEW section start -->
        <section class="overview" id="overview">
            <img src="https://www.clipartkey.com/mpngs/m/118-1188761_avatar-cartoon-profile-picture-png.png" alt="Avatar" class="avatar">
            <main class="profile">
                <h3>Welcome<span> <?php echo $_SESSION['username']; ?></span></h3>
                <p>5302422030</p>
                <!-- <p><?php echo $_SESSION['user_id']; ?></p> -->
                <p>Informatics and Computer Engineering Education</p>
            </main>
        </section>
        <!--OVERVIEW section end -->
        
        <!--Classes section start -->
        <section class="classes" id="classes">
            <h2>Classrooms</h2>
        </section>
        <main class="rooms">
            <?php
            // Fetch data from the database
            include '../config/db.php';

            $result = $conn->query("SELECT * FROM rooms");

            while ($row = $result->fetch_assoc()) {
            ?>
                <div class="box" style="cursor: pointer;" <?php if ($row['status'] == "Available") { ?>onclick="openEditModal('<?php echo $row['id_room']; ?>', '<?php echo $row['room_name']; ?>', '<?php echo $row['type']; ?>', '<?php echo $row['capacity']; ?>', '<?php echo $row['status']; ?>')" <?php } else { ?>onclick="alert('Room is already booked')" <?php } ?>>
                    <div class="image" style="width: 140px;"> <!-- hot fix -->
                        <img src="https://2.bp.blogspot.com/-2v5DE5vy6y4/UZzaEAcy2HI/AAAAAAAAACU/WvleJTIxYUI/s1600/photo.JPG" alt="room1">
                        <?php if ($row['status'] == "Available") { ?>
                            <li class="status">Available</li>
                        <?php } else { ?>
                            <li class="booked">Booked</li>
                        <?php } ?>

                    </div>
                    <div class="content">
                        <h3><?php echo $row['room_name']; ?></h3>
                        <p><?php echo $row['type']; ?></p>
                        <p>Capacity: <?php echo $row['capacity']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </main>
        <!--Classes section end -->
    </div>
</body>

</html>
<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="editItemModalLabel" style="color: #000000;">
                    Book a Room
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #ffffff;">
                        <span aria-hidden="true" style="color: #ffffff;">&times;</span>
                    </button>
                </h1>
            </div>
            <br />
            <div class="modal-body">
                <form id="editItemForm" method="POST" action="">
                    <input type="hidden" name="editItemForm" value="true" />
                    <input type="hidden" id="editItemId" name="id" />
                    <div class="form-group">
                        <label for="editRoomName">Room Name</label><br />
                        <input disabled class="form-control" id="editRoomName" name="room_name" placeholder="" style="width: 90%;">
                    </div>
                    <div class="form-group">
                        <label for="editRoomName">Type</label><br />
                        <input disabled class="form-control" id="editType" name="type" placeholder="" style="width: 90%;">
                    </div>
                    <div class="form-group">
                        <label for="editCapacity">Capacity</label><br />
                        <input disabled class="form-control" id="editCapacity" name="capacity" placeholder="" style="width: 90%;">
                    </div>
                    <div class="form-group">
                        <label for="editCapacity">Request Date</label><br />
                        <input required class="form-control" name="request_date" type="datetime-local" placeholder="" style="width: 90%;">
                    </div>
                    <div class="form-group">
                        <label for="editCapacity">Reason (Description)</label><br />
                        <input required class="form-control" name="description" placeholder="" style="width: 90%;">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width: 93%; text-align: center;">Request Book</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    // Function to open modal
    function openModal(modalId) {
        document.getElementById(modalId).style.display = 'block';
    }

    // Function to close modal
    function closeModal(modalId) {
        document.getElementById(modalId).style.display = 'none';
    }

    // Close modal if clicked outside the modal
    window.onclick = function(event) {
        if (event.target.className === 'modal') {
            event.target.style.display = 'none';
        }
    };

    function openEditModal(itemId, roomName, type, capacity, status) {
        // Set values for the edit modal fields
        document.getElementById('editItemId').value = itemId;
        document.getElementById('editRoomName').value = roomName;
        document.getElementById('editType').value = type;
        document.getElementById('editCapacity').value = capacity;

        // Show the edit modal
        $('#editItemModal').modal('show');
    }
</script>