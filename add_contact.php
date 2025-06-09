<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("127.0.0.1:3300", "root", "", "CMS");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['contact_name']);
    $phone = $conn->real_escape_string($_POST['phone_number']);
    $description = $conn->real_escape_string($_POST['description']);

    if (!empty($name) && !empty($phone)) {
        $sql = "INSERT INTO contacts (contact_name, phone_number, description) VALUES ('$name', '$phone', '$description')";
        if ($conn->query($sql) === TRUE) {
            $message = "Contact added successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    } else {
        $message = "Please fill in both Name and Phone Number.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Contact Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="alert alert-info text-center">
            <?php echo $message; ?>
        </div>
        <div class="text-center">
            <a href="contact_add.html" class="btn btn-primary">Add Another</a>
            <a href="contact_view.php" class="btn btn-success">View Contacts</a>
        </div>
    </div>
</body>
</html>
