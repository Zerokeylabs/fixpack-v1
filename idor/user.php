<?php
if (!isset($_GET['id'])) {
    echo "No user ID given.";
    exit;
}

$id = $_GET['id'];
$path = "user-data/user" . $id . ".txt";

if (file_exists($path)) {
    echo "<h3>👤 User Profile</h3>";
    echo nl2br(file_get_contents($path));
} else {
    echo "User not found.";
}
?>
