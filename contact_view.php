<!-- View Contacts Page: view_contacts.php -->
<?php
// Database connection
$conn = new mysqli("127.0.0.1:3300", "root", "", "CMS");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM contacts");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Contacts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h2 class="mb-4 text-center">Contact List</h2>
    <a href="contact_add.html" class="btn btn-primary mb-3">+ Add New Contact</a>

    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Phone</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['contact_name'] ?></td>
            <td><?= $row['phone_number'] ?></td>
            <td><?= $row['description'] ?></td>
            <td>
              <a href="edit_contact.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="delete_contact.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>

    <div class="text-center mt-3">
          <a href="index.html" class="text-decoration-none">&larr; Back to Home</a>
        </div>

  </div>
</body>
</html>
<?php $conn->close(); ?>
