<?php
$conn = new mysqli("localhost", "root", "", "test");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $message = $_POST['message'];
    $stmt = $conn->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $message);
    $stmt->execute();
    $stmt->close();
}

// Display messages
$result = $conn->query("SELECT name, message FROM messages");
?>

<h2>Leave a Comment</h2>
<form method="POST">
    Name: <input name="name"><br><br>
    Message: <input name="message"><br><br>
    <button type="submit">Submit</button>
</form>

<h2>All Comments</h2>
<?php
while ($row = $result->fetch_assoc()) {
    echo "<p><strong>" . $row['name'] . ":</strong> " . $row['message'] . "</p>";
}
$conn->close();
?>