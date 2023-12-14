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

    $id_room = $_POST['id_room'];
    $id_subject = $_POST['id_subject'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Perform SQL insert
    $sql = "INSERT INTO default_schedules (id_room, id_subject, day_of_week, start_time, end_time) VALUES ('$id_room', '$id_subject', '$day_of_week', '$start_time', '$end_time')";
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
    $id_room = $_POST['id_room'];
    $id_subject = $_POST['id_subject'];
    $day_of_week = $_POST['day_of_week'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    // Perform SQL update
    $sql = "UPDATE default_schedules SET id_room='$id_room', id_subject='$id_subject', day_of_week='$day_of_week', start_time='$start_time', end_time='$end_time' WHERE id_schedule=$id";
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
    $sql = "DELETE FROM default_schedules WHERE id_schedule=$itemIdToDelete";
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

        <div class="content" style="text-align: center; line-height: 1.5; overflow-x: scroll;">
            <!-- Konten event calendar -->
            <h2>Event Calendar</h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#addItemModal">Add Event Calendar</button>
            <br><br>
            <table class="table" id="datatable">
                <thead>
                    <tr>
                        <th>ID Schedule</th>
                        <th>Subject Name</th>
                        <th>Lecturer</th>
                        <th>ID Room</th>
                        <th>Room Name</th>
                        <th>Type</th>
                        <th>Capacity</th>
                        <th>Day of Week</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>SKS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch data from the database
                    include '../config/db.php';

                    $result = $conn->query("SELECT default_schedules.*, rooms.room_name, rooms.type, rooms.capacity, subject.subject_name, subject.lecturer, subject.sks FROM default_schedules JOIN rooms ON rooms.id_room = default_schedules.id_room JOIN subject ON subject.id_subject = default_schedules.id_subject");

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id_schedule']}</td>
                            <td>{$row['subject_name']}</td>
                            <td>{$row['lecturer']}</td>
                            <td>{$row['id_room']}</td>
                            <td>{$row['room_name']}</td>
                            <td>{$row['type']}</td>
                            <td>{$row['capacity']}</td>
                            <td>{$row['day_of_week']}</td>
                            <td>{$row['start_time']}</td>
                            <td>{$row['end_time']}</td>
                            <td>{$row['sks']}</td>
                            <td>
                                <button class='btn btn-warning btn-sm' style='background: green; width: 80px;' onclick='openEditModal({$row['id_schedule']}, {$row['id_room']}, {$row['id_subject']}, \"{$row['day_of_week']}\", \"{$row['start_time']}\", \"{$row['end_time']}\")'>Edit</button>
                                <button class='btn btn-danger btn-sm' style='background: red; width: 80px;' onclick='deleteItem({$row['id_schedule']})'>Delete</button>
                            </td>
                        </tr>";
                    }

                    $rooms = $conn->query("SELECT * FROM rooms");
                    $opt_rooms = [];
                    while ($_row = $rooms->fetch_assoc()) {
                        $opt_rooms[] = $_row;
                    }

                    $subject = $conn->query("SELECT * FROM subject");
                    $opt_subject = [];
                    while ($__row = $subject->fetch_assoc()) {
                        $opt_subject[] = $__row;
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
                    Add Event Calendar
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
                        <select style="width: 100%;" class="form-control" name="id_room">
                            <?php foreach ($opt_rooms as $opt) { ?>
                                <option value="<?php echo $opt['id_room']; ?>"><?php echo $opt['room_name']; ?> - <?php echo $opt['type']; ?> - Capacity <?php echo $opt['capacity']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Subject</label><br />
                        <select style="width: 100%;" class="form-control" name="id_subject">
                            <?php foreach ($opt_subject as $opt) { ?>
                                <option value="<?php echo $opt['id_subject']; ?>"><?php echo $opt['subject_name']; ?> - <?php echo $opt['lecturer']; ?> - SKS <?php echo $opt['sks']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Day of Week</label><br />
                        <select style="width: 100%;" class="form-control" name="day_of_week">
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Start Time</label><br />
                        <input style="width: 100%;" class="form-control" name="start_time" type="time" />
                    </div>
                    <div class="form-group">
                        <label for="">End Time</label><br />
                        <input style="width: 100%;" class="form-control" name="end_time" type="time" />
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
                    Edit Event Calendar
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
                        <label for="">Room Name</label><br />
                        <select style="width: 100%;" class="form-control" name="id_room" id="id_room">
                            <?php foreach ($opt_rooms as $opt) { ?>
                                <option value="<?php echo $opt['id_room']; ?>"><?php echo $opt['room_name']; ?> - <?php echo $opt['type']; ?> - Capacity <?php echo $opt['capacity']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Subject</label><br />
                        <select style="width: 100%;" class="form-control" name="id_subject" id="id_subject">
                            <?php foreach ($opt_subject as $opt) { ?>
                                <option value="<?php echo $opt['id_subject']; ?>"><?php echo $opt['subject_name']; ?> - <?php echo $opt['lecturer']; ?> - SKS <?php echo $opt['sks']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Day of Week</label><br />
                        <select style="width: 100%;" class="form-control" name="day_of_week" id="day_of_week">
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Start Time</label><br />
                        <input style="width: 100%;" class="form-control" id="start_time" name="start_time" type="time" />
                    </div>
                    <div class="form-group">
                        <label for="">End Time</label><br />
                        <input style="width: 100%;" class="form-control" id="end_time" name="end_time" type="time" />
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

    function openEditModal(itemId, idRoom, idSubject, dayOfWeek, startTime, endTime) {
        console.log('itemId:', itemId);
        console.log('idRoom:', idRoom);
        console.log('idSubject:', idSubject);
        console.log('dayOfWeek:', dayOfWeek);
        console.log('startTime:', startTime);
        console.log('endTime:', endTime);

        // Set values for the edit modal fields
        document.getElementById('editItemId').value = itemId;
        document.getElementById('id_room').value = idRoom;
        document.getElementById('id_subject').value = idSubject;
        document.getElementById('day_of_week').value = dayOfWeek;
        document.getElementById('start_time').value = startTime;
        document.getElementById('end_time').value = endTime;

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