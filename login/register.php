<?php
include ("controller.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section>
    <div class="register-container">
        <div class="register-card">
            <!-- Image Section -->
            <!-- <div class="register-image">
                <img src="../pictures/motivation.png" alt="Motivational Poster">
            </div> -->

            <!-- Form Section -->
            <div class="register-form">
                <h2 class="fw-bold text-center">Register</h2><br>

                <!-- Display Errors -->
                <?php if (!empty($errors)) { ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error) { echo "<p>$error</p>"; } ?>
                    </div>
                <?php } ?>

                <form action="register.php" method="POST" autocomplete="">
                    <div class="mb-2">
                        <input type="text" class="form-control" name="fname" placeholder="First Name" required value="<?= isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : '' ?>">
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="lname" placeholder="Last Name" required value="<?= isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : '' ?>">
                    </div>
                    <div class="mb-2">
                        <input type="email" class="form-control" name="email" placeholder="Email" required value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                    </div>
                    <div class="mb-2">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-2">
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="address" placeholder="Address" required value="<?= isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '' ?>">
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" name="contact" placeholder="Contact" required value="<?= isset($_POST['contact']) ? htmlspecialchars($_POST['contact']) : '' ?>">
                    </div>
                    <button type="submit" name="register" value="register" class="btn btn-primary fw-bold">Register</button>
                </form>
                <p class="text-small mt-3 text-center">Already have an account? <a href="../login/login.php" class="fw-bold text-decoration-none">Click here</a></p>
            </div>
        </div>
    </div>
</section>
</body>
</html>
