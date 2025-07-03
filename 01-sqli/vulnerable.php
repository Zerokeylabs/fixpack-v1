<?php
$conn = new mysqli("localhost", "root", "", "test");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id']; // Vulnerable to SQLi

$sql = "SELECT username, password FROM users WHERE id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"] . "<br>";
        echo "Password (MD5 hash): " . $row["password"] . "<br><br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>