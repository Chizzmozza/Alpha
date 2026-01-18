<?php
include("../database/connection.php");

$search = isset($_POST['search']) ? mysqli_real_escape_string($conn, $_POST['search']) : "";
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 10;

$sql = "SELECT * FROM user WHERE
        user_id LIKE '%$search%' OR
        Fname LIKE '%$search%' OR
        Lname LIKE '%$search%' OR
        email LIKE '%$search%' OR
        address LIKE '%$search%'
        LIMIT $limit";

$result = mysqli_query($conn, $sql);

echo '<table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Role</th>
                <th>Status</th>
                <th>Code</th>
                <th>Points</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>';

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['user_id']) . "</td>
                <td>" . htmlspecialchars($row['Fname']) . "</td>
                <td>" . htmlspecialchars($row['Lname']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['address']) . "</td>
                <td>" . htmlspecialchars($row['contact']) . "</td>
                <td>" . htmlspecialchars($row['role']) . "</td>
                <td>" . htmlspecialchars($row['status']) . "</td>
                <td>" . htmlspecialchars($row['code']) . "</td>
                <td>" . htmlspecialchars($row['points']) . "</td>
                <td>
                    <a href='edit_user.php?id=" . $row['user_id'] . "' class='btn btn-sm btn-primary'><i class='fas fa-edit'></i></a>
                    <a href='delete_user.php?id=" . $row['user_id'] . "' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\");'><i class='fas fa-trash-alt'></i></a>
                </td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='11' class='text-center'>No users found</td></tr>";
}

echo '</tbody></table>';

mysqli_close($conn);
?>
