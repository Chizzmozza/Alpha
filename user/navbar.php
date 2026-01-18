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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../user/navbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- FontAwesome -->
    <title>Alpha Grind Lab</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../pictures/alphalogonew.png" alt="Logo">

        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
    <!-- Centered Navbar Links -->
    <div class="d-flex justify-content-center w-100">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item"><a class="nav-link" href="../user/index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="../user/index.php#products">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="../user/index.php#courses">Courses</a></li>
            <li class="nav-item"><a class="nav-link" href="../user/aboutus.php">About Us</a></li>
        </ul>
    </div>


    <!-- Profile Dropdown - Moved to Right -->
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                <?php
                $select = mysqli_query($conn, "SELECT image FROM `user` WHERE user_id = '$user_id'") or die('Query failed');
                if (mysqli_num_rows($select) > 0) {
                    $fetch = mysqli_fetch_assoc($select);
                }
                if (!empty($fetch['image'])) {
                    echo '<img class="rounded-circle" src="../images/' . $fetch['image'] . '" alt="Profile Picture" width="50" height="50">';
                } else {
                    echo '<img class="rounded-circle" src="../pictures/profilelogo.png" alt="Default Profile Picture" width="50" height="50">';
                }
                ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="?Logout=true"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</div>

    </nav>

    <!-- Bootstrap & jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fix Bootstrap Dropdown Issue -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
          var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
          var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
            return new bootstrap.Dropdown(dropdownToggleEl)
          })
      });
    </script>
</body>
</html>
