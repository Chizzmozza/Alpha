<?php include("navbar.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Alpha Grind Lab Dashboard</title>
</head>
<body>
  <div class="d-flex">
        <!-- Include Sidebar -->
        <?php include("navbar.php"); ?>

        <!-- Main Content -->
        <div class="content flex-grow-1 p-4">
            <h2>Dashboard</h2>
            <p>Welcome to the Alpha Grind Lab dashboard!</p>

            <div class="row g-3">
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <i class="fas fa-bicycle icon-green"></i>
                        <h5>Membership Packages</h5>
                        <h3>4</h3>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-card">
                        <i class="fas fa-users icon-yellow"></i>
                        <h5>Users</h5>
                        <h3>13</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <i class="fas fa-bicycle icon-green"></i>
                        <h5>Members</h5>
                        <h3>7</h3>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <i class="fas fa-bicycle icon-green"></i>
                        <h5>Sales</h5>
                        <h3>9999.99PHP</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
