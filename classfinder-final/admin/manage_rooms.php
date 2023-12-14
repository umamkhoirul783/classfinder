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


// Add
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addItemForm'])) {
    // Fetch data from the database
    include '../config/db.php';

    $roomName = $_POST['room_name'];
    $type = $_POST['type'];
    $capacity = $_POST['capacity'];

    // Perform SQL insert
    $sql = "INSERT INTO rooms (room_name, type, capacity, status) VALUES ('$roomName', '$type', '$capacity', 'Available')";
    if ($conn->query($sql) === TRUE) {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }
    $conn->close();
}

// Edit
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editItemForm'])) {
    // Fetch data from the database
    include '../config/db.php';

    $id = $_POST['id'];
    $room_name = $_POST['room_name'];
    $type = $_POST['type'];
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];

    // Perform SQL update
    $sql = "UPDATE rooms SET room_name='$room_name', type='$type', capacity='$capacity', status='$status' WHERE id_room=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }
    $conn->close();
}

// Delete
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteItem'])) {
    // Fetch data from the database
    include '../config/db.php';

    $itemIdToDelete = $_POST['deleteItem'];

    // Perform SQL update
    $sql = "DELETE FROM rooms WHERE id_room=$itemIdToDelete";
    if ($conn->query($sql) === TRUE) {
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

        <div class="content" style="text-align: center; line-height: 1.5;">
            <!-- Konten rooms -->
            <h2>Manage Rooms</h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addItemModal">Add Room</button>
            <br><br>
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>ID Room</th>
                        <th>Room Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch data from the database
                    include '../config/db.php';

                    $result = $conn->query("SELECT * FROM rooms");

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id_room']}</td>
                            <td>{$row['room_name']}</td>
                            <td>{$row['type']}</td>
                            <td>{$row['capacity']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <button class='btn btn-warning btn-sm' style='background: green;' onclick='openEditModal({$row['id_room']}, \"{$row['room_name']}\", \"{$row['type']}\", \"{$row['capacity']}\", \"{$row['status']}\")'>Edit</button>
                                <button class='btn btn-danger btn-sm' style='background: red;' onclick='deleteItem({$row['id_room']})'>Delete</button>
                            </td>
                        </tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="addItemModalLabel">
                    Add Room
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h1>
            </div>
            <br />
            <div class="modal-body">
                <form id="addItemForm" method="POST" action="">
                    <input type="hidden" name="addItemForm" value="true" />
                    <div class="form-group">
                        <label for="">Room Name</label><br />
                        <input type="text" class="form-control" id="" name="room_name" placeholder="" required style="width: 100%;">
                    </div>
                    <div class="form-group">
                        <label for="">Type</label><br />
                        <select style="width: 100%;" class="form-control" name="type">
                            <option value="Computer Lab">Computer Lab</option>
                            <option value="Classroom">Classroom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Capacity</label><br />
                        <input type="text" class="form-control" id="" name="capacity" placeholder="" required style="width: 100%;">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="editItemModalLabel">
                    Edit Room
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
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
                        <input type="text" class="form-control" id="editRoomName" name="room_name" placeholder="" required style="width: 100%;">
                    </div>
                    <div class="form-group">
                        <label for="editType">Type</label><br />
                        <select style="width: 100%;" class="form-control" name="type" id="editType">
                            <option value="Computer Lab">Computer Lab</option>
                            <option value="Classroom">Classroom</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editCapacity">Capacity</label><br />
                        <input type="text" class="form-control" id="editCapacity" name="capacity" placeholder="" required style="width: 100%;">
                    </div>
                    <div class="form-group">
                        <label for="editStatus">Status</label><br />
                        <select style="width: 100%;" class="form-control" name="status" id="editStatus">
                            <option value="Available">Available</option>
                            <option value="Booked">Booked</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

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

    function openEditModal(itemId, roomName, type, capacity, status) {
        // Set values for the edit modal fields
        document.getElementById('editItemId').value = itemId;
        document.getElementById('editRoomName').value = roomName;
        document.getElementById('editType').value = type;
        document.getElementById('editCapacity').value = capacity;
        document.getElementById('editStatus').value = status;

        // Show the edit modal
        $('#editItemModal').modal('show');
    }

    function deleteItem(id) {
        if (confirm("Are you sure you want to delete this item?")) {
            // Create a hidden form to submit the item ID
            var form = document.createElement('form');
            form.method = 'post';
            form.action = '<?php echo $_SERVER["PHP_SELF"]; ?>'; // The same page

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'deleteItem';
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