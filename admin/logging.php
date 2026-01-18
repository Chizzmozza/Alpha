<?php
include("navbar.php");
$select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
} else {
    die("User not found in database.");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Welcome</title>
</head>
<body class="text-center">

  <div class="content">
      <div class="container">
          <div class="card">
              <div class="card-body" >
                  <div class="text-white p-4" style="
                      background: url('../pictures/smokeybg.png') no-repeat center center;
                      background-size: cover;
                      border-radius: 12px;
                      min-height: 400px;
                      padding: 2rem;
                      display: flex;
                      flex-direction: column;
                      justify-content: space-between;
                      position: relative;
                  ">

                      <!-- Header Section -->
                      <div class="d-flex justify-content-between align-items-center">
                          <h1 class="fw-bold">Welcome, <?php echo $fetch['Fname'] . " " . $fetch['Lname']; ?></h1>
                          <h5 class="text-info fw-bold">VIP Member</h5>
                      </div>

                      <!-- Profile and Points -->
                      <div class="d-flex align-items-center mt-3">
                          <!-- Profile Picture Below Welcome -->
                          <?php
                          $select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('Query failed');
                          if (mysqli_num_rows($select) > 0) {
                              $fetch = mysqli_fetch_assoc($select);
                              $profileImage = !empty($fetch['image']) ? "../images/" . $fetch['image'] : "../pictures/userlogo.png";
                          } else {
                              $profileImage = "../pictures/userlogo.png"; // Default image if user not found
                          }
                          ?>
                          <img src="<?= $profileImage ?>" alt="Profile Picture" style="
                              width: 250px;
                              height: 250px;
                              border-radius: 50%;
                              border: 4px solid white;
                          ">

                          <!-- Points Beside Profile -->
                          <h1 class="fw-bold ms-4"><?php echo $fetch['points']; ?>POINTS</h1>
                      </div>


                      <!-- Member Since (Kept in the Bottom Right) -->
                      <div style="
                          position: absolute;
                          bottom: 10px;
                          right: 20px;
                          text-align: right;
                      ">
                          <h6 class="text-uppercase">Member Since:</h6>
                          <h4 class="fw-bold">2025</h4>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>






</body>
</html>
