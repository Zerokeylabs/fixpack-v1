<?php
session_start();

// Simulated login user
$_SESSION['user_id'] = 1;

if (!isset($_GET['id'])) {
    echo "No user ID given.";
    exit;
}

$id = $_GET['id'];

// Authorization check
if ($_SESSION['user_id'] != $id) {
    echo "⛔ Unauthorized access blocked.";
    exit;
}

$path = "user-data/user" . $id . ".txt";

if (file_exists($path)) {
    echo "<h3>👤 User Profile</h3>";
    echo nl2br(file_get_contents($path));
} else {
    echo "User not found.";
}
?>
