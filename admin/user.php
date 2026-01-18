<?php
include("navbar.php");
include("../database/connection.php"); // Include database connection

include("../database/connection.php"); // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $Fname = mysqli_real_escape_string($conn, $_POST['Fname']);
    $Lname = mysqli_real_escape_string($conn, $_POST['Lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $points = mysqli_real_escape_string($conn, $_POST['points']);

    $sql = "UPDATE user SET
              Fname='$Fname',
              Lname='$Lname',
              email='$email',
              address='$address',
              contact='$contact',
              role='$role',
              points='$points',
              role_updated_at = CURRENT_TIMESTAMP
          WHERE user_id='$user_id'";

    if (mysqli_query($conn, $sql)) {
        header("Location:user.php"); // Redirect back to the user list
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>User Management</title>
</head>
<body>

<section class="main-content">
<div class="container mt-4">
    <h2 class="mb-3">User List</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Full name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Role</th>
                <th>Points</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // $sql = "SELECT * FROM user WHERE role = 'user' ";
            $sql = "SELECT * FROM user WHERE role = 'user' ORDER BY user_id DESC";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<form action='user.php' method='POST'>";
      echo "<input type='hidden' name='user_id' value='" . $row['user_id'] . "'>";

      // Add hidden fields for uneditable data (but needed for update)
      echo "<input type='hidden' name='Fname' value='" . htmlspecialchars($row['Fname']) . "'>";
      echo "<input type='hidden' name='Lname' value='" . htmlspecialchars($row['Lname']) . "'>";
      echo "<input type='hidden' name='email' value='" . htmlspecialchars($row['email']) . "'>";
      echo "<input type='hidden' name='address' value='" . htmlspecialchars($row['address']) . "'>";
      echo "<input type='hidden' name='contact' value='" . htmlspecialchars($row['contact']) . "'>";

      echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
      echo "<td>" . htmlspecialchars($row['Fname'] . ' ' . $row['Lname']) . "</td>";
      echo "<td>" . htmlspecialchars($row['email']) . "</td>";
      echo "<td>" . htmlspecialchars($row['address']) . "</td>";
      echo "<td>" . htmlspecialchars($row['contact']) . "</td>";

      echo "<td style='width:12%;'>
              <select name='role' class='form-select'>
                  <option value='user' " . ($row['role'] == 'user' ? 'selected' : '') . ">User</option>
                  <option value='member' " . ($row['role'] == 'member' ? 'selected' : '') . ">Member</option>
                  <option value='admin' " . ($row['role'] == 'admin' ? 'selected' : '') . ">Admin</option>
              </select>
            </td>";

      echo "<td style='width:12%;'>
              <input type='text' class='form-control' name='points' value='" . htmlspecialchars($row['points']) . "'>
            </td>";

      echo "<td>
              <button type='submit' class='btn btn-sm btn-success'>
                  <i class='fa-solid fa-floppy-disk'></i> Update
              </button>
            </td>";

      echo "</form>";
      echo "</tr>";
  }

            } else {
                echo "<tr><td colspan='11' class='text-center'>No users found</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form[action='user.php']");

    forms.forEach(form => {
        form.addEventListener("submit", function (e) {
            e.preventDefault(); // Stop the default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to update this user’s information?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel',
                reverseButtons: false,
                buttonsStyling: true,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Submit manually after confirmation
                }
            });
        });
    });
});
</script>

</body>
</html>
