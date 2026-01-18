<?php
include("navbar.php");
include("../database/connection.php"); // Include your database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome 6 (Latest Version) -->
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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Role</th>
                <!-- <th>Status</th>
                <th>Code</th> -->
                <!-- <th>Points</th> -->
                <!-- <th>Actions</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM user WHERE role = 'admin'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Fname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['Lname']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['contact']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['role']) . "</td>";
                    // echo "<td>" . htmlspecialchars($row['status']) . "</td>";
                    // echo "<td>" . htmlspecialchars($row['code']) . "</td>";
                    // echo "<td>" . htmlspecialchars($row['points']) . "</td>";
                    // echo "<td>
                    //         <div class='btn-group'>
                    //             <a href='edit_user.php?id=" . $row['user_id'] . "' class='btn btn-sm btn-success'>
                    //                 <i class='fa-solid fa-floppy-disk'></i>
                    //             </a>
                    //             <a href='delete_user.php?id=" . $row['user_id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\");'>
                    //                 <i class='fa-solid fa-trash'></i>
                    //             </a>
                    //         </div>
                    //       </td>";
                    // echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11' class='text-center'>No admins found</td></tr>";
            }

            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</div>
</section>
</body>
</html>
