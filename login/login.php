<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("controller.php");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <section>
        <div class="login-container">
            <div class="login-card text-center">
                <h2 class="fw-bold">Login</h2>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="mb-3 text-start">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" required>
                        <div class="text-end text-small mt-1">
                            <a href="forgot-password.php" class="text-decoration-none">Forgot password?</a>
                        </div>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary fw-bold">Login</button>
                </form>
                <p class="text-small mt-3">Don't have an account? <a href="register.php" class="fw-bold text-decoration-none">Register</a></p>
            </div>
        </div>
    </section>
</body>
</html>
