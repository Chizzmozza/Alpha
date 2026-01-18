<?php include("navbar.php");
include("../database/connection.php");
include("../database/query.php");
include("../login/controller.php");
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha Grind Lab</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="styles.css">

</head>
<body>

  <section class="landing-page">
      <div class="container">
          <div class="row align-items-center">
              <!-- Text on the left -->
              <div class="col-lg-5 col-md-6">
                  <div class="landing-text">
                      <h2>Transform your life with  </h2>
                      <h3>exclusive fitness promo</h3>
                      <p>
                      Join now and start your journey!
                    </p>

                    <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#loginModal">Become a member</button>
                  </div>
              </div>
              <!-- Image on the right -->
              <div class="col-lg-7 col-md-6 text-center">
      <img src="../pictures/wow.jpg" alt="Gym Image" class="img-fluid gym-image"
          style="width: 75%; max-width: 960; height: 500px; object-fit: cover; border-radius: 10px;">
  </div>

          </div>
      </div>
  </section>


  <!-- Login Modal -->
  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" >
      <div class="modal-dialog">
        <div class="modal-content login-modal-bg">

              <div class="modal-header border-0">
                  <h5 class="modal-title text-white" id="loginModalLabel">Login</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <form>
                      <div class="mb-3">
                          <label for="username" class="form-label text-white">Username</label>
                          <input type="text" class="form-control" id="username" placeholder="Enter your username">
                      </div>
                      <div class="mb-3">
                          <label for="password" class="form-label text-white">Password</label>
                          <input type="password" class="form-control" id="password" placeholder="Enter your password">
                      </div>

                      <!-- Smaller Login Button -->
                      <button type="submit" class="btn btn-primary btn-sm w-50 d-block mx-auto">Login</button>

                      <!-- Register Link -->
                      <p class="text-center mt-3 text-white">
                          Don't have an account?
                          <a href="../login/register.php" class="register-link">Register</a>
                      </p>
                  </form>
              </div>
          </div>
      </div>
  </div>










  <section class="py-5 membership-section">
      <div class="container text-center">
          <h3 class="fw-bold">MEMBERSHIP PACKAGES</h3><br><br>
          <div class="row justify-content-center">
              <?php if (empty($packages)): ?>
                  <p class="text-danger">No membership packages found.</p>
              <?php else: ?>
                  <?php foreach ($packages as $package): ?>
                      <div class="col-md-4 col-lg-4 d-flex justify-content-center mb-4">
                          <?php
                          // Use the stored image or fallback
                          $bgImage = !empty($package['image']) ? $package['image'] : '../pictures/smokeybg.png';
                          ?>
                          <div class="membership-card">
                              <div class="membership-card-inner">
                                  <!-- Front Side -->
                                  <div class="membership-card-front" style="background: url('<?php echo htmlspecialchars($bgImage); ?>?v=<?php echo time(); ?>') no-repeat center center/cover;">
                                      <p class="fw-bold text-white m-0">
                                          <?php echo htmlspecialchars($package['membership_description']) . " - " . htmlspecialchars($package['price']); ?>
                                      </p>
                                  </div>
                                  <!-- Back Side -->
                                  <div class="membership-card-back">
                                    <p class="fw-bold text-white m-0">BENEFITS</p
                                    <p class="fw-bold text-white m-0">✔ Free Trainer Guidance</p>
                                    <p class="fw-bold text-white m-0">✔ Free Use of Treadmill</p>
                                    <p class="fw-bold text-white m-0">✔ Free Drinking Water</p>
                                    <p class="fw-bold text-white m-0">✔ Free Use of Showers</p>
                                    <p class="fw-bold text-white m-0">✔ Free Use of Lockers</p>
                                    <p class="fw-bold text-white m-0">✔  Free Wifi Access</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
              <?php endif; ?>
          </div>
          <h3 class="fw-bold mt-4">UNLIMITED GYM ACCESS (PLUS PHP500 ANNUAL MEMBERSHIP FEE)</h3>
      </div>
  </section>














<!-- <section id="programs" class="py-5 bg-light">
    <div class="container text-center">
        <h3 class="fw-bold">EXCLUSIVE PROGRAMS</h3>
        <div class="row justify-content-center mt-4">
            <div class="col-md-5 col-lg-3 mb-3">
                <div class="p-4 border bg-white rounded">
                    <img src="../pictures/gymm.png" alt="Yoga" class="img-fluid rounded" style="height: 250px; width: 100%; object-fit: cover;">
                    <p class="fw-bold mt-2">YOGA</p>
                </div>
            </div>
            <div class="col-md-5 col-lg-3 mb-3">
                <div class="p-4 border bg-white rounded">
                    <img src="../pictures/gymm.png" alt="Basketball" class="img-fluid rounded" style="height: 250px; width: 100%; object-fit: cover;">
                    <p class="fw-bold mt-2">BASKETBALL</p>
                </div>
            </div>
            <div class="col-md-5 col-lg-3 mb-3">
                <div class="p-4 border bg-white rounded">
                    <img src="../pictures/gymm.png" alt="Zumba" class="img-fluid rounded" style="height: 250px; width: 100%; object-fit: cover;">
                    <p class="fw-bold mt-2">ZUMBA</p>
                </div>
            </div>
            <div class="col-md-5 col-lg-3 mb-3">
                <div class="p-4 border bg-white rounded">
                    <img src="../pictures/gymm.png" alt="Team Building" class="img-fluid rounded" style="height: 250px; width: 100%; object-fit: cover;">
                    <p class="fw-bold mt-2">TEAM BUILDING</p>
                </div>
            </div>
        </div>
    </div>
</section> -->





<section id="courses" class="py-5 courses" >
    <div class="container text-center">
        <h3 class="fw-bold text-white">COURSES OFFER</h3>
        <div class="row justify-content-center mt-4">
            <!-- Course 1 -->
            <div class="col-md-3">
                <div class="p-4 border rounded course-card bg-light" data-bs-toggle="modal" data-bs-target="#courseModal1">
                    <div class="bg-light" style="height: 360px; width: 100%;">
                        <img src="../pictures/train1.jpg" alt="Course 1" class="img-fluid rounded" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Course 2 -->
            <div class="col-md-3">
                <div class="p-4 border rounded course-card bg-light" data-bs-toggle="modal" data-bs-target="#courseModal2">
                    <div class="bg-light" style="height: 360px; width: 100%;">
                        <img src="../pictures/train2.jpg" alt="Course 2" class="img-fluid rounded" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Course 3 -->
            <div class="col-md-3">
                <div class="p-4 border rounded course-card bg-light" data-bs-toggle="modal" data-bs-target="#courseModal3">
                    <div class="bg-light" style="height: 360px; width: 100%;">
                        <img src="../pictures/train3.jpg" alt="Course 3" class="img-fluid rounded" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Course 4 -->
            <div class="col-md-3">
                <div class="p-4 border rounded course-card bg-light" data-bs-toggle="modal" data-bs-target="#courseModal4">
                    <div class="bg-light" style="height: 360px; width: 100%;">
                        <img src="../pictures/train4.jpg" alt="Course 4" class="img-fluid rounded" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Bootstrap Modals for Courses -->
<!-- Course 1 Modal -->
<div class="modal fade" id="courseModal1" tabindex="-1" aria-labelledby="courseModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train1.jpg" class="img-fluid rounded mb-3" alt="Course 1">

            </div>
        </div>
    </div>
</div>

<!-- Course 2 Modal -->
<div class="modal fade" id="courseModal2" tabindex="-1" aria-labelledby="courseModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train2.jpg" class="img-fluid rounded mb-3" alt="Course 2">

            </div>
        </div>
    </div>
</div>

<!-- Course 3 Modal -->
<div class="modal fade" id="courseModal3" tabindex="-1" aria-labelledby="courseModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train3.jpg" class="img-fluid rounded mb-3" alt="Course 3">

            </div>
        </div>
    </div>
</div>

<!-- Course 4 Modal -->
<div class="modal fade" id="courseModal4" tabindex="-1" aria-labelledby="courseModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train4.jpg" class="img-fluid rounded mb-3" alt="Course 4">

            </div>
        </div>
    </div>
</div>

<section id="products" class="py-5 products">
    <div class="container">
        <div class="row align-items-center">
            <!-- Left Side: Image -->
            <div class="col-lg-4 text-center text-lg-start mb-4 mb-lg-0">
                <img src="../pictures/weights.png" alt="Dumbbells Display" class="img-fluid">
            </div>

            <!-- Right Side: Products Grid -->
            <div class="col-lg-8">
                <h3 class="fw-bold text-center">PRODUCTS</h3>
                <div class="row justify-content-center mt-4 row-cols-1 row-cols-md-2 g-4">
                    <!-- Product Cards -->
                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <div class="bg-light rounded" style="height: 220px;">
                                <img src="../pictures/gym.png" alt="Water Bottle" class="img-fluid rounded"
                                    style="height: 220px; width: 100%; object-fit: cover;">
                            </div>
                            <p class="fw-bold mt-3 text-center">WATER BOTTLE</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <div class="bg-light rounded" style="height: 220px;">
                                <img src="../pictures/gym.png" alt="Hoodie" class="img-fluid rounded"
                                    style="height: 220px; width: 100%; object-fit: cover;">
                            </div>
                            <p class="fw-bold mt-3 text-center">HOODIE</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <div class="bg-light rounded" style="height: 220px;">
                                <img src="../pictures/gym.png" alt="T-Shirt" class="img-fluid rounded"
                                    style="height: 220px; width: 100%; object-fit: cover;">
                            </div>
                            <p class="fw-bold mt-3 text-center">T-SHIRT</p>
                        </div>
                    </div>

                    <div class="col">
                        <div class="p-4 border rounded shadow-sm">
                            <div class="bg-light rounded" style="height: 220px;">
                                <img src="../pictures/gym.png" alt="Mesh Short" class="img-fluid rounded"
                                    style="height: 220px; width: 100%; object-fit: cover;">
                            </div>
                            <p class="fw-bold mt-3 text-center">MESH SHORT</p>
                        </div>
                    </div>
                </div>

                <!-- <div class="text-center">
                  <a href="products.php" class="btn mt-4" style="background-color: #FFD95F; color: black; border: none;">View Products</a>

                </div> -->
            </div>
        </div>
    </div>
</section>



<section class="py-5 location">
    <div class="map-container text-center">
        <h4 class="fw-bold">We are located at: 237 A. Mabini St, Maypajo, Caloocan, Metro Manila</h4>

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1930.5122437230548!2d120.9729816!3d14.6410179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397b5c530d3bf5d%3A0x27567a8d5078fa4f!2s237%20A.%20Mabini%20St%2C%20Maypajo%2C%20Caloocan%2C%201410%20Metro%20Manila!5e0!3m2!1sen!2sph!4v1700000000000"
            width="50%"
            height="400"
            style="border:0;"
            allowfullscreen
            loading="lazy">
        </iframe>
    </div>
</section>



<?php include("footer.php");  ?>





</body>
</html>
