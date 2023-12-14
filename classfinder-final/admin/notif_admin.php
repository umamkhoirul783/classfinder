<?php
session_start();
// Pastikan hanya admin yang bisa mengakses halaman ini
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("location: ../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['readItem'])) {
    // Fetch data from the database
    include '../config/db.php';

    $itemIdToDelete = $_POST['readItem'];

    // Perform SQL update
    $sql = "UPDATE notifications SET status = 'read' WHERE id_notification=$itemIdToDelete";
    if ($conn->query($sql) === TRUE) {
        header("Location: {$_SERVER['PHP_SELF']}");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit;
    }

    $conn->close();
}

// Ambil informasi pengguna dari sesi
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

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
            <!-- Konten notif untuk admin -->
            <h2>Notif Admin</h2>
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>ID Notification</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch data from the database
                    include '../config/db.php';

                    $result = $conn->query("SELECT * FROM notifications WHERE id_user = $user_id");

                    while ($row = $result->fetch_assoc()) {
                        if ($row['status'] == 'unread') {
                            echo "<tr>
                                <td>{$row['id_notification']}</td>
                                <td>{$row['message']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <button class='btn btn-danger btn-sm' onclick='deleteItem({$row['id_notification']})'>Mark as Read</button>
                                </td>
                            </tr>";
                        } else {
                            echo "<tr>
                                <td>{$row['id_notification']}</td>
                                <td>{$row['message']}</td>
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

    function deleteItem(id) {
        if (confirm("Are you sure you want to mark as read this item?")) {
            // Create a hidden form to submit the item ID
            var form = document.createElement('form');
            form.method = 'post';
            form.action = '<?php echo $_SERVER["PHP_SELF"]; ?>'; // The same page

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'readItem';
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