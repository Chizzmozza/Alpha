<?php include "../guest/navbar.php"; ?>
<?php require_once "controller.php"; ?>
<?php
$email = $_SESSION['email'];
if($email == false){
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a New Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <div class="login-container">
            <div class="login-card text-center">
                <h2 class="fw-bold">New Password</h2>

                <?php if(isset($_SESSION['info'])): ?>
                    <div class="alert alert-success text-center">
                        <?php echo $_SESSION['info']; ?>
                    </div>
                <?php endif; ?>

                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger text-center">
                        <?php foreach($errors as $showerror): ?>
                            <p><?php echo $showerror; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="new-password.php" method="POST" autocomplete="off">
                    <div class="mb-3 text-start">
                        <label class="form-label">New Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Create new password" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm your password" required>
                    </div>
                    <button type="submit" name="change-password" class="btn btn-primary fw-bold">Change</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
