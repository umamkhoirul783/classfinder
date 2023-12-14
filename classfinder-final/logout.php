<?php
session_start();
session_destroy();
header("Location: index.php"); // Redirect to admin login page
exit();
