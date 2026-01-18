<?php include "../login/controller.php"; ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$showModal = $_SESSION['show_modal'] ?? '';
$errors = $_SESSION['errors'] ?? [];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha Grind Lab</title>

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Bootstrap 5.3.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Styles -->
    <link rel="stylesheet" href="../guest/navbar.css">

</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 fixed-top">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="../pictures/alphalogonew.png" alt="Logo" class="img-fluid" style="max-height: 50px;">
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="fa-solid fa-bars"></i>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="../guest/index.php#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="../guest/index.php#courses">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="../guest/index.php#products">Products</a></li>
                <li class="nav-item"><a class="nav-link" href="../guest/aboutus.php">About Us</a></li>
            </ul>

            <!-- Join Us Button -->
            <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#loginModal">JOIN US</button>

        </div>
    </nav>
    <!-- Register Modal -->
    <?php
    $showRegisterModal = ($_SESSION['show_modal'] ?? '') === 'registerModal';
    $showLoginModal = ($_SESSION['show_modal'] ?? '') === 'loginModal';
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['errors'], $_SESSION['show_modal']);

    ?>


  <!-- Register Modal -->
  <div class="modal fade <?= $showModal === 'registerModal' ? 'show' : '' ?>" id="registerModal" tabindex="-1" aria-hidden="true" style="<?= $showModal === 'registerModal' ? 'display:block;' : '' ?>">
      <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-0">
                  <div class="register-container">
                      <div class="register-image">
                          <img src="../pictures/motivation.png" alt="Motivational Poster">
                      </div>
                      <div class="register-form">
                          <h2 class="fw-bold text-center">Register</h2>
                          <?php if (!empty($errors)) { ?>
                              <div class="alert alert-danger">
                                  <?php foreach ($errors as $error) { echo "<p>$error</p>"; } ?>
                              </div>
                          <?php } ?>
                          <form action="../login/controller.php" method="POST">

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
                          <p class="text-small mt-3 text-center">Already have an account? <a href="#" class="fw-bold text-decoration-none" id="openLoginModal">Click here</a></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Login Modal -->
  <div class="modal fade <?= $showModal === 'loginModal' ? 'show' : '' ?>" id="loginModal" tabindex="-1" aria-hidden="true" style="<?= $showModal === 'loginModal' ? 'display:block;' : '' ?>">
      <div class="modal-dialog modal-md modal-dialog-centered">
          <div class="modal-content" style="background: rgba(255, 255, 255, 0.95); border-radius: 12px; padding: 20px;">
              <div class="modal-header border-0">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body text-center">
                  <h2 class="fw-bold">Login</h2>
                  <?php if (!empty($errors)) { ?>
                      <div class="alert alert-danger">
                          <?php foreach ($errors as $error) { echo "<p>$error</p>"; } ?>
                      </div>
                  <?php } ?>
                  <form action="../login/controller.php" method="POST" autocomplete="off">
                      <div class="mb-3 text-start">
                          <label class="form-label">Email</label>
                          <input type="email" class="form-control rounded-pill" name="email" required>
                      </div>
                      <div class="mb-3 text-start">
                          <label class="form-label">Password</label>
                          <input type="password" class="form-control rounded-pill" name="password" required>
                          <div class="text-end text-small mt-1">
                              <a href="../login/forgot-password.php" class="text-decoration-none text-primary">Forgot password?</a>
                          </div>
                      </div>
                      <button type="submit" name="login" class="btn btn-primary fw-bold w-100 rounded-pill">Login</button>
                  </form>
                  <p class="text-small mt-3">Don't have an account? <a href="#" class="fw-bold text-decoration-none" id="openRegisterModal">Register</a></p>
              </div>
          </div>
      </div>
  </div>

  <script>
  document.addEventListener("DOMContentLoaded", function () {
      const showModal = "<?= $showModal ?>";

      if (showModal === "registerModal") {
          var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
          registerModal.show();
      } else if (showModal === "loginModal") {
          var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
          loginModal.show();
      }

      // Switch to Login Modal
      document.getElementById('openLoginModal').addEventListener('click', function (e) {
          e.preventDefault();
          var registerModal = bootstrap.Modal.getInstance(document.getElementById('registerModal'));
          if (registerModal) registerModal.hide();
          var loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
          loginModal.show();
      });

      // Switch to Register Modal
      document.getElementById('openRegisterModal').addEventListener('click', function (e) {
          e.preventDefault();
          var loginModal = bootstrap.Modal.getInstance(document.getElementById('loginModal'));
          if (loginModal) loginModal.hide();
          var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
          registerModal.show();
      });
  });
  </script>





</body>
</html>
