<?php
$conn = new mysqli("127.0.0.1:3300", "root", "", "CMS");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;

if ($id) {
    $id = (int)$id;
    $sql = "DELETE FROM contacts WHERE id=$id";
    $conn->query($sql);
}

$conn->close();
header("Location: contact_view.php");
exit;
