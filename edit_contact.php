<?php
$conn = new mysqli("127.0.0.1:3300", "root", "", "CMS");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid contact ID.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['contact_name']);
    $phone = $conn->real_escape_string($_POST['phone_number']);
    $description = $conn->real_escape_string($_POST['description']);

    if (!empty($name) && !empty($phone)) {
        $sql = "UPDATE contacts SET contact_name='$name', phone_number='$phone', description='$description' WHERE id=$id";
        if ($conn->query($sql) === TRUE) {
            $message = "Contact updated successfully.";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Name and Phone are required.";
    }
}

// Fetch current data
$result = $conn->query("SELECT * FROM contacts WHERE id=$id");
$contact = $result->fetch_assoc();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Edit Contact</h2>
        <?php if ($message): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="contact_name" class="form-control" value="<?= htmlspecialchars($contact['contact_name']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Phone</label>
                <input type="text" name="phone_number" class="form-control" value="<?= htmlspecialchars($contact['phone_number']) ?>" required>
            </div>
            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"><?= htmlspecialchars($contact['description']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Contact</button>
            <a href="contact_view.php" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
