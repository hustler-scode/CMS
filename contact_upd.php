<?php
              // Database connection
              $conn = new mysqli("127.0.0.1:3300", "root", "", "CMS");
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }

              // Fetch contact details by ID
              if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $result = $conn->query("SELECT * FROM contacts WHERE id = $id");
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                } else {
                  echo '<div class="alert alert-danger">Contact not found!</div>';
                  exit();
                }
              } else {
                echo '<div class="alert alert-danger">No contact ID provided!</div>';
                exit();
              }
            ?>
            