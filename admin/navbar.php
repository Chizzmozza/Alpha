<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "../database/connection.php"; // FIX: Added semicolon

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
   header('location:../guest/index.php');
   exit();
}

if (isset($_GET['Logout'])) {
   session_unset();
   session_destroy();
   header('location:../guest/index.php');
   exit();
}

?>

<div class="sidebar d-flex flex-column p-3">
  <h3 class="text-Dark fw-bold" style="margin-left: 15%">
    <img src="../pictures/alphalogonew.png" alt="Alpha Grind Lab Logo" style="height: 50px;">
</h3>
    <a href="admin.php">Dashboard</a>
    <a href="dashboard.php">Membership Packages</a>
    <a href="products.php">Products</a>
    <a href="sales.php">Sales</a>
    <a href="user.php">Users</a>
    <a href="admins.php">Admins</a>
    <!-- <a href="logging.php">Logging</a> -->
    <a href="member.php">Members</a>
    <a href="membershiprequest.php">Membership request</a>
    <a href="registeredmember.php">Attendance</a>
    <a href="bookingadmin.php">Bookings</a>
    <!-- eeeeeeeeeeeee -->
    <a href="?Logout=true">Logout</a>
</div>
