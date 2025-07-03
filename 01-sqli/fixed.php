<?php
$conn = new mysqli("localhost", "root", "", "test");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use a safe default if no ID is set
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!is_numeric($id)) {
    die("Invalid input.");
}

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT username, password FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"] . "<br>";
        echo "Password (MD5 hash): " . $row["password"] . "<br><br>";
    }
} else {
    echo "No results.";
}

$stmt->close();
$conn->close();
?>