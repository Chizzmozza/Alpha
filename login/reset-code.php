<?php include "../guest/navbar.php"; ?>
<?php require_once "controller.php"; ?>
<?php
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        /* body {
            font-family: sans-serif;
            font-weight: bold;
        }
        .navbar {
            background-color: #055c9d;
            height: 20%;
        }
        .navbar-brand img {
            height: 70px;
            width: 70px;
            border-radius: 50%;
            object-fit: cover;
        }
        .nav-link {
            color: black !important;
            font-weight: bold;
        }
        .nav-link:hover {
            color: white !important;
        }
        section {
            background: url('../pictures/gyymmm.png') no-repeat center center/cover;
            height: 100vh;
        }
        .verification-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .verification-card {
            background: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        } */
        /* .btn-primary {
            width: 100%;
            border-radius: 10px;
        } */
    </style>
</head>
<body>
  <section>
    <div class="verification-container">
        <div class="verification-card text-center">
            <h2 class="fw-bold">Code Verification</h2>
            <?php if (isset($_SESSION['info'])): ?>
                <div class="alert alert-success text-center" style="padding: 0.4rem 0.4rem">
                    <?php echo $_SESSION['info']; ?>
                </div>
            <?php endif; ?>
            <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger text-center">
                    <?php foreach ($errors as $showerror): ?>
                        <p><?php echo $showerror; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="reset-code.php" method="POST" autocomplete="off">
                <div class="mb-3 text-start">
                    <label class="form-label">Enter Code</label>
                    <input class="form-control" type="number" name="otp" placeholder="Enter code" required>
                </div>
                <button type="submit" name="check-reset-otp" class="btn btn-primary fw-bold">Submit</button>
            </form>
        </div>
    </div>
  </section>
</body>
</html>
