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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pendingItem'])) {
    // Fetch data from the database
    include '../config/db.php';

    $itemIdToDelete = $_POST['pendingItem'];

    // Perform SQL update
    $sql = "UPDATE requests SET status = 'pending' WHERE id_request =$itemIdToDelete";
    if ($conn->query($sql) === TRUE) {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['approveItem'])) {
    // Fetch data from the database
    include '../config/db.php';

    $itemIdToDelete = $_POST['approveItem'];

    // Perform SQL update
    $sql = "UPDATE requests SET status = 'approved' WHERE id_request = $itemIdToDelete";
    if ($conn->query($sql) === TRUE) {
        $request = $conn->query("SELECT * FROM requests WHERE id_request = $itemIdToDelete");
        if ($request) {
            // Fetch a single row
            $row = $request->fetch_assoc();
            $id_room = $row['id_room'];

            $room_info = $conn->query("SELECT * FROM rooms WHERE id_room = $id_room");
            $_room_info = $room_info->fetch_assoc();

            // Check if a row was fetched
            if ($row) {
                $id_user = $row['id_user'];
                $message = 'Your request for room ' . $_room_info['room_name'] . ' (' . $_room_info['type'] . ') has been approved';
                try {
                    $sql = "INSERT INTO notifications (id_user, message, status) VALUES ('$id_user', '$message', 'unread')";
                    $conn->query($sql);
                } catch (\Throwable $th) {
                }
            }
        }
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rejectItem'])) {
    // Fetch data from the database
    include '../config/db.php';

    $itemIdToDelete = $_POST['rejectItem'];

    // Perform SQL update
    $sql = "UPDATE requests SET status = 'rejected' WHERE id_request = $itemIdToDelete";
    if ($conn->query($sql) === TRUE) {
        $request = $conn->query("SELECT * FROM requests WHERE id_request = $itemIdToDelete");
        if ($request) {
            // Fetch a single row
            $row = $request->fetch_assoc();
            $id_room = $row['id_room'];

            $room_info = $conn->query("SELECT * FROM rooms WHERE id_room = $id_room");
            $_room_info = $room_info->fetch_assoc();

            // Check if a row was fetched
            if ($row) {
                $id_user = $row['id_user'];
                $message = 'Your request for room ' . $_room_info['room_name'] . ' (' . $_room_info['type'] . ') has been rejected';
                try {
                    $sql = "INSERT INTO notifications (id_user, message, status) VALUES ('$id_user', '$message', 'unread')";
                    $conn->query($sql);
                } catch (\Throwable $th) {
                }
            }
        }
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }

    $conn->close();
}
?>

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

    table {
        font-size: 13px;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Admin Dashboard - ClassFinder</title>
</head>

<body style="height: unset;">
    <div class="container">
        <div class="sidebar">
            <a href="dashboard.php">Overview</a>
            <a href="manage_rooms.php">Manage Rooms</a>
            <a href="manage_requests.php">Manage Requests</a>
            <a href="events.php">Event Calendar</a>
            <a href="notif_admin.php">Notifications</a>
            <a href="../logout.php">Logout</a>
        </div>

        <div class="content" style="text-align: center; line-height: 1.5; overflow-x: scroll;">
            <!-- Konten requests -->
            <h2>Manage Requests</h2>
            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addItemModal">Add Request</button> -->
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>ID Request</th>
                        <th>ID Room</th>
                        <th>Request Date</th>
                        <th>Room Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>ID User</th>
                        <th>User Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch data from the database
                    include '../config/db.php';

                    $result = $conn->query("SELECT requests.*, rooms.room_name, rooms.type, rooms.capacity, users.username, users.role FROM requests JOIN rooms ON rooms.id_room = requests.id_room JOIN users ON users.id_user = requests.id_user");

                    // <button class='btn btn-danger btn-sm' style='background: orange; width: 100px;' onclick='pending({$row['id_request']})'>Pending</button>
                    while ($row = $result->fetch_assoc()) {
                        if ($row['status'] == 'pending') {
                            echo "<tr>
                                <td>{$row['id_request']}</td>    
                                <td>{$row['id_room']}</td>
                                <td>{$row['request_date']}</td>
                                <td>{$row['room_name']}</td>
                                <td>{$row['type']}</td>
                                <td>{$row['capacity']}</td>
                                <td>{$row['id_user']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <button class='btn btn-danger btn-sm' style='background: green; width: 80px;' onclick='approved({$row['id_request']})'>Approved</button>
                                    <button class='btn btn-danger btn-sm' style='background: red; width: 80px;' onclick='rejected({$row['id_request']})'>Rejected</button>
                                </td>
                            </tr>";
                        } else {
                            echo "<tr>
                                <td>{$row['id_request']}</td>    
                                <td>{$row['id_room']}</td>
                                <td>{$row['request_date']}</td>
                                <td>{$row['room_name']}</td>
                                <td>{$row['type']}</td>
                                <td>{$row['capacity']}</td>
                                <td>{$row['id_user']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    -
                                </td>
                            </tr>";
                        }
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<!-- Include jQuery and Bootstrap JS -->
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Custom script for deleting items -->
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

    function openEditModal(itemId, roomName, type, capacity) {
        // Set values for the edit modal fields
        document.getElementById('editItemId').value = itemId;
        document.getElementById('editRoomName').value = roomName;
        document.getElementById('editType').value = type;
        document.getElementById('editCapacity').value = capacity;

        // Show the edit modal
        $('#editItemModal').modal('show');
    }

    function pending(id) {
        if (confirm("Are you sure you want to pending this item?")) {
            // Create a hidden form to submit the item ID
            var form = document.createElement('form');
            form.method = 'post';
            form.action = '<?php echo $_SERVER["PHP_SELF"]; ?>'; // The same page

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'pendingItem';
            input.value = id;

            form.appendChild(input);
            document.body.appendChild(form);

            form.submit();
        }
    }

    function approved(id) {
        if (confirm("Are you sure you want to approve this item?")) {
            // Create a hidden form to submit the item ID
            var form = document.createElement('form');
            form.method = 'post';
            form.action = '<?php echo $_SERVER["PHP_SELF"]; ?>'; // The same page

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'approveItem';
            input.value = id;

            form.appendChild(input);
            document.body.appendChild(form);

            form.submit();
        }
    }

    function rejected(id) {
        if (confirm("Are you sure you want to reject this item?")) {
            // Create a hidden form to submit the item ID
            var form = document.createElement('form');
            form.method = 'post';
            form.action = '<?php echo $_SERVER["PHP_SELF"]; ?>'; // The same page

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'rejectItem';
            input.value = id;

            form.appendChild(input);
            document.body.appendChild(form);

            form.submit();
        }
    }
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>