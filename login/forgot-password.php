<?php include "../guest/navbar.php"; ?>
<?php require_once "controller.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section>
        <div class="login-container">
            <div class="login-card text-center">
                <h2 class="fw-bold">Forgot Password</h2>
                <p class="text-center">Enter your email address</p>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <form action="forgot-password.php" method="POST" autocomplete="off">
                    <div class="mb-3 text-start">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email address" required value="<?php echo $email; ?>">
                    </div>
                    <button type="submit" name="check-email" class="btn btn-primary fw-bold">Continue</button>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
