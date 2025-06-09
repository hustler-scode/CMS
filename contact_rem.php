<?php
// delete_contact.php

// Database connection
$conn = new mysqli("127.0.0.1:3300", "root", "", "CMS");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // First, confirm the contact exists
    $result = $conn->query("SELECT * FROM contacts WHERE id = $id");
    if ($result->num_rows === 0) {
        echo "Contact not found.";
        exit;
    }

    // If form is submitted to confirm deletion
    if (isset($_POST['confirm'])) {
        if ($_POST['confirm'] === 'Yes') {
            // Delete the contact
            $conn->query("DELETE FROM contacts WHERE id = $id");
            header("Location: view_contacts.php?msg=deleted");
            exit;
        } else {
            // Redirect back if deletion cancelled
            header("Location: view_contacts.php");
            exit;
        }
    }
} else {
    echo "No contact ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Delete Contact</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-header bg-danger text-white text-center">
            <h4>Delete Contact</h4>
          </div>
          <div class="card-body">
            <p>Are you sure you want to delete this contact?</p>
            <form method="POST">
              <button type="submit" name="confirm" value="Yes" class="btn btn-danger me-2">Yes, Delete</button>
              <button type="submit" name="confirm" value="No" class="btn btn-secondary">Cancel</button>
            </form>
          </div>
        </div>
        <div class="text-center mt-3">
          <a href="view_contacts.php" class="text-decoration-none">&larr; Back to List</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
