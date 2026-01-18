<?php
include '../database/connection.php';

// Membership stats
$membership_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM descriptions"))['total'];
$average_price = mysqli_fetch_assoc(mysqli_query($conn, "SELECT AVG(price) AS avg_price FROM descriptions"))['avg_price'];

// Product stats
$product_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM products"))['total'];
$total_value = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(price) AS total_value FROM products"))['total_value'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Statistics</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="statistics.css">
</head>
<body>

<div class="container py-5">
  <h1 class="text-center mb-5 fw-bold"> Dashboard Statistics</h1>

  <div class="row g-4 justify-content-center">
    <div class="col-md-6 col-lg-3">
      <div class="stat-card bg-membership">
        <h2><?php echo $membership_count; ?></h2>
        <p>Total Membership Packages</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="stat-card bg-average-price">
        <h2>₱<?php echo number_format($average_price, 2); ?></h2>
        <p>Average Membership Price</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="stat-card bg-product">
        <h2><?php echo $product_count; ?></h2>
        <p>Total Products</p>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="stat-card bg-total-value">
        <h2>₱<?php echo number_format($total_value, 2); ?></h2>
        <p>Total Product Value</p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
