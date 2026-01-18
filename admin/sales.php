<?php
include("navbar.php");
include("../database/connection.php"); // Include database connection

// Query to fetch the data from the bookings table and count total avails
$sql = "SELECT b.training, b.price, COUNT(b.booking_id) AS total_avail,
        (CAST(b.price AS DECIMAL(10,2)) * COUNT(b.booking_id)) AS total_price
        FROM bookings b
        GROUP BY b.training, b.price";


$result = mysqli_query($conn, $sql);
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
    <title>Sales Management</title>
</head>
<body>

<section class="main-content">
<div class="container mt-4">
    <h2 class="mb-3">Sales List</h2>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Total Avail</th>
            </tr>
        </thead>
        <tbody>
          <?php
                 // Check if the query returns results
                 if (mysqli_num_rows($result) > 0) {
                     while($row = mysqli_fetch_assoc($result)) {
                         echo "<tr>";
                         echo "<td>" . $row['training'] . "</td>";
                         echo "<td>" . $row['price'] . "</td>";
                         echo "<td>" . $row['total_avail'] . "</td>";
                         echo "</tr>";
                     }
                 } else {
                     echo "<tr><td colspan='3' class='text-center'>No data available</td></tr>";
                 }
          ?>
        </tbody>
    </table>
</div>
</section>

</body>
</html>
