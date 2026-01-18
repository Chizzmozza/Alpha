<?php include "../guest/navbar.php"; ?>

<?php require_once "controller.php"; ?>
<?php
if($_SESSION['info'] == false){
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <div class="login-container">
            <div class="login-card text-center">
                <h2 class="fw-bold">Login</h2>

                <?php if(isset($_SESSION['info'])): ?>
                    <div class="alert alert-success text-center">
                        <?php echo $_SESSION['info']; ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <button type="submit" name="login-now" class="btn btn-primary fw-bold">Login Now</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
