<?php
session_start();
include 'navbar.php';
include '../database/connection.php'; // Database connection file

// Fetch existing membership packages
$query = "SELECT * FROM descriptions ORDER BY description_id ASC";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

$packages = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['new_description']) && isset($_POST['new_price'])) {
        $new_description = mysqli_real_escape_string($conn, $_POST['new_description']);
        $new_price = mysqli_real_escape_string($conn, $_POST['new_price']);

        // Handle image upload
        $image_path = '../pictures/smokeybg.png'; // Default image path
        if (!empty($_FILES['new_background']['name'])) {
            $target_dir = "../pictures/";
            $target_file = $target_dir . basename($_FILES['new_background']['name']);
            move_uploaded_file($_FILES['new_background']['tmp_name'], $target_file);
            $image_path = $target_file;
        }

        $insert_query = "INSERT INTO descriptions (membership_description, price, image) VALUES ('$new_description', '$new_price', '$image_path')";
        if (!mysqli_query($conn, $insert_query)) {
            die("Insert failed: " . mysqli_error($conn));
        }
    }

    foreach ($_POST['packages'] as $id => $package) {
        $description = mysqli_real_escape_string($conn, $package['descriptions']);
        $price = mysqli_real_escape_string($conn, $package['price']);

        // Handle image upload
        if (!empty($_FILES['packages']['name'][$id]['image'])) {
            $target_dir = "../images/";
            $target_file = $target_dir . basename($_FILES['packages']['name'][$id]['image']);
            move_uploaded_file($_FILES['packages']['tmp_name'][$id]['image'], $target_file);

            $update_query = "UPDATE descriptions SET membership_description='$description', price='$price', image='$target_file' WHERE description_id='$id'";
        } else {
            $update_query = "UPDATE descriptions SET membership_description='$description', price='$price' WHERE description_id='$id'";
        }

        if (!mysqli_query($conn, $update_query)) {
            die("Update failed: " . mysqli_error($conn));
        }
    }
    header('Location: dashboard.php?success=1');
    exit;
}

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = mysqli_real_escape_string($conn, $_GET['delete_id']);
    $delete_query = "DELETE FROM descriptions WHERE description_id='$delete_id'";
    mysqli_query($conn, $delete_query);
    header('Location: dashboard.php?success=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Memberships</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<section class="main-content">

  <section class="header-section">
      <div class="container text-center">
          <h1 class="fw-bold mb-3">Manage Membership Packages</h1>

      </div>
  </section>

  <div class="container mt-5">
      <?php if (isset($_GET['success'])): ?>
          <div class="alert alert-success text-center">Membership packages updated successfully.</div>
      <?php endif; ?>

      <div class="table-wrapper">
    <div class="card shadow-sm p-4">
        <form method="post" enctype="multipart/form-data">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Description</th>
                            <th>Price (₱)</th>
                            <th>Background Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($packages as $package): ?>
                            <tr>
                                <td>
                                    <input type="text" name="packages[<?php echo $package['description_id']; ?>][descriptions]"
                                        value="<?php echo htmlspecialchars($package['membership_description']); ?>"
                                        class="form-control w-100" required>
                                </td>
                                <td>
                                    <input type="text" name="packages[<?php echo $package['description_id']; ?>][price]"
                                        value="<?php echo htmlspecialchars($package['price']); ?>"
                                        class="form-control w-100" required>
                                </td>
                                <td>
                                    <input type="file" name="packages[<?php echo $package['description_id']; ?>][image]"
                                        class="form-control w-100">
                                </td>
                                <td class="text-center">
                                    <a href="dashboard.php?delete_id=<?php echo $package['description_id']; ?>"
                                        class="btn delete-icon-btn btn-danger"
                                        title="Delete Package"
                                        onclick="return confirm('Are you sure you want to delete this package?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <!-- New Package Row -->
                        <tr class="table-secondary">
                            <td>
                                <input type="text" name="new_description" placeholder="New Package Description"
                                    class="form-control w-100">
                            </td>
                            <td>
                                <input type="text" name="new_price" placeholder="New Package Price"
                                    class="form-control w-100">
                            </td>
                            <td>
                                <input type="file" name="new_background" class="form-control w-100">
                            </td>
                            <td class="text-muted text-center">New Package</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success save-icon-btn" title="Save">
                    <i class="fas fa-save"></i>
                </button>
            </div>
        </form>
    </div>
</div>
</section>

  <script>
      // Save button confirmation
      document.querySelector('.save-icon-btn').addEventListener('click', function (event) {
          var confirmSave = confirm("Are you sure you want to save the changes?");
          if (!confirmSave) {
              event.preventDefault(); // Prevent form submission if user cancels
          }
      });

      // Delete button confirmation
      const deleteButtons = document.querySelectorAll('.delete-icon-btn');
      deleteButtons.forEach(function (deleteButton) {
          deleteButton.addEventListener('click', function (event) {
              var confirmDelete = confirm("Are you sure you want to delete this package?");
              if (!confirmDelete) {
                  event.preventDefault(); // Prevent delete action if user cancels
              }
          });
      });
  </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
