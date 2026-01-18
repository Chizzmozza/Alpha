<?php include "../guest/navbar.php"; ?>
<?php require_once "controller.php"; ?>

<?php
$email = $_SESSION['email'];
if ($email == false) {
    header('Location: login-user.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Code Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <section class="d-flex align-items-center justify-content-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-container p-4">
                        <form action="user-otp.php" method="POST" autocomplete="off">
                            <h2 class="text-center text-white">Code Verification</h2>
                            <?php if (isset($_SESSION['info'])) : ?>
                                <div class="alert alert-success text-center">
                                    <?= $_SESSION['info']; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (count($errors) > 0) : ?>
                                <div class="alert alert-danger text-center">
                                    <?php foreach ($errors as $showerror) {
                                        echo $showerror;
                                    } ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <input class="form-control" type="number" name="otp" placeholder="Enter verification code" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary btn-block" type="submit" name="check" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
