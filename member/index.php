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
    <!-- Include FullCalendar & Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../user/styles.css">
    <!-- Initialize the JS-SDK -->
    <script
        src="https://www.paypal.com/sdk/js?client-id=test&buyer-country=US&currency=USD&components=buttons&enable-funding=card&disable-funding=venmo,paylater"
        data-sdk-integration-source="developer-studio"
    ></script>
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>
    <script src="app.js"></script>

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
                      Welcome to the Team Alpha!
                    </p>
                      <!-- <p>
                          Welcome to <strong>Alpha Grind Lab Gym</strong>, where discipline meets dedication, and limits are meant to be broken.
                          We are more than just a gym—we are a movement, a mindset, and a community built on the foundation of
                          <strong>hard work, resilience, and relentless self-improvement.</strong>
                      </p> -->
                      <!-- <p>
                          Our gym is designed for those who are ready to embrace the grind and push beyond their limits.
                          With <strong>state-of-the-art equipment, elite-level coaching, and a motivating environment</strong>,
                          we provide everything you need to reach your full potential.
                      </p> -->
                      <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#registerModal">Extend Your Membership</a>

                  </div>
              </div>
              <!-- Image on the right -->
              <div class="col-lg-7 col-md-6 text-center">
      <img src="../pictures/wow.jpg" alt="Gym Image" class="img-fluid gym-image"
          style="width: 75%; max-width: 700px; height: 500px; object-fit: cover; border-radius: 10px;">
  </div>

          </div>
      </div>
  </section>


  <!-- Login Modal -->
  <!-- Login Modal -->
  <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
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
                                    <p class="fw-bold text-white m-0">✔ Free Wifi Access</p>
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




<section id="courses" class="py-5 courses">
    <div class="container text-center">
        <h3 class="fw-bold" style="color: #4a78a6 ">COURSES OFFER</h3>
        <div class="row justify-content-center mt-4">
            <!-- Personal Training -->
            <div class="col-md-3">
                <div class="p-4 border rounded course-card bg-light" data-bs-toggle="modal" data-bs-target="#courseModal1">
                    <div class="bg-light" style="height: 360px; width: 100%;">
                        <img src="../pictures/train1.jpg" alt="Personal Training" class="img-fluid rounded" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Basketball Training -->
            <div class="col-md-3">
                <div class="p-4 border rounded course-card bg-light" data-bs-toggle="modal" data-bs-target="#courseModal2">
                    <div class="bg-light" style="height: 360px; width: 100%;">
                        <img src="../pictures/train2.jpg" alt="Basketball Training" class="img-fluid rounded" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Personal Training -->
            <div class="col-md-3">
                <div class="p-4 border rounded course-card bg-light" data-bs-toggle="modal" data-bs-target="#courseModal3">
                    <div class="bg-light" style="height: 360px; width: 100%;">
                        <img src="../pictures/train3.jpg" alt="Personal Training" class="img-fluid rounded" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Boxing Training -->
            <div class="col-md-3">
                <div class="p-4 border rounded course-card bg-light" data-bs-toggle="modal" data-bs-target="#courseModal4">
                    <div class="bg-light" style="height: 360px; width: 100%;">
                        <img src="../pictures/train4.jpg" alt="Boxing Training" class="img-fluid rounded" style="height: 100%; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Course Modals -->
<!-- Course Booking Modal -->
<div class="modal fade" id="courseModal1" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train1.jpg" class="img-fluid rounded mb-3" alt="Personal Training">
                <button class="btn btn-primary book-now" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#calendarModal" data-course="Personal Training" data-coach="Coach JV">Book Now</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="courseModal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train2.jpg" class="img-fluid rounded mb-3" alt="Basketball Training">
                <button class="btn btn-primary book-now" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#calendarModal" data-course="Basketball Training" data-coach="Coach Darren">Book Now</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="courseModal3" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train3.jpg" class="img-fluid rounded mb-3" alt="Personal Training">
                <button class="btn btn-primary book-now" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#calendarModal" data-course="Personal Training" data-coach="Coach Kyle">Book Now</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="courseModal4" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train4.jpg" class="img-fluid rounded mb-3" alt="Boxing Training">
                <button class="btn btn-primary book-now" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#calendarModal" data-course="Boxing Training" data-coach="Coach Andy">Book Now</button>
            </div>
        </div>
    </div>
</div>


<?php
$select = mysqli_query($conn, "SELECT * FROM `user` WHERE user_id = '$user_id'") or die('Query failed');
if (mysqli_num_rows($select) > 0) {
    $fetch = mysqli_fetch_assoc($select);
}
 ?>
 <!-- Calendar Modal with Booking Form -->
 <div class="modal fade" id="calendarModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
   <div class="modal-dialog modal-lg">
     <div class="modal-content rounded-5 shadow p-4" style="border: none; background: #f9f9f9;">
       <div class="modal-header border-0 pb-0">
         <h5 class="modal-title fw-semibold">April 2025</h5>
         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>

       <div class="modal-body">
         <!-- Calendar -->
         <div id="calendar-container" class="text-center mb-4">
           <div id="calendar" class="calendar-style"></div>
         </div>

         <div class="text-center mb-4">
           <h5 id="selectedDateDisplay" class="text-muted">Select a date</h5>
           <button id="confirmBooking" class="btn btn-primary rounded-pill px-4" disabled>Confirm Date</button>
         </div>

         <!-- Booking Form -->
         <form id="bookingForm">
           <div class="row g-3">
             <div class="col-md-6 fw-bold">
               <label for="Full name" class="form-label">Full Name:</label>
               <input type="text" class="form-control form-control-lg rounded-4" id="name" placeholder="Full Name" value= "<?php echo $fetch['Fname'] . ' ' . $fetch['Lname']; ?>" disabled>
             </div>
             <div class="col-md-6 fw-bold">
               <label for="email" class="form-label">Email:</label>
               <input type="email" class="form-control form-control-lg rounded-4" id="email" placeholder="Email" value= "<?php echo $fetch['email']?>"  disabled>
             </div>
             <div class="col-md-6 fw-bold">
               <label for="contact" class="form-label">Contact:</label>
               <input type="tel" class="form-control form-control-lg rounded-4" id="contact" placeholder="contact Number" value= "<?php echo $fetch['contact']?>" disabled>
             </div>
             <!-- <div class="col-md-6">
               <input type="tel" class="form-control form-control-lg rounded-4" id="contact" placeholder="contact Number" value= "<?php echo $fetch['price']?>" disabled>
             </div> -->
             <div class="col-md-6 fw-bold">
               <label for="date" class="form-label">Date:</label>
               <input type="date" class="form-control form-control-lg rounded-4" id="date" required>
             </div>
             <div class="col-md-6 fw-bold">
               <label for="training" class="form-label">Course:</label>
               <select class="form-select form-select-lg rounded-4" id="training" required disabled>
                 <option value="">Select Training</option>
                 <option value="Personal Training">1 ON 1 PERSONAL TRAINER</option>
                 <option value="Basketball Training">1 ON 1 BASKETBALL TRAINING</option>
                 <option value="Personal Training">1 ON 1 PERSONAL TRAINER</option>
                 <option value="Boxing Training">1 ON 1 BOXING TRAINING</option>
               </select>
             </div>

             <div class="col-md-6 fw-bold">
               <label for="coach" class="form-label">Coaches:</label>
               <select class="form-select form-select-lg rounded-4" id="coach" disabled>
                 <option value=""></option>
               </select>
             </div>

             <!-- Sessions Dropdown -->
             <div class="col-md-6 d-none fw-bold" id="sessionsGroup">
               <label for="session" class="form-label">Sessions:</label>
               <select class="form-select form-select-lg rounded-4" id="sessions">
                 <option value="">Select Sessions</option>
               </select>
             </div>

             <!-- Price Placeholder -->
             <div class="col-md-6 d-none fw-bold" id="priceGroup">
               <label for="price" class="form-label">Price:</label>
               <input type="text" class="form-control form-control-lg rounded-4" id="price" placeholder="Price" disabled>
             </div>

             <div class="mt-4">
               <button type="submit" class="btn btn-primary w-100 rounded-pill py-2" id="submitBooking">Submit Booking</button>
             </div>
         </form>

         <!-- PayPal Button Container (inside the same modal) -->
         <div id="paypal-button-container" class="mt-4 d-none"></div>
         <p id="result-message" class="mt-3 text-success text-center d-none"></p>

       </div>
     </div>
   </div>
 </div>
</div>






<!-- Style -->

<!-- Include FullCalendar JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

<style>
    #calendar-container {
        max-width: 900px;
        margin: 0 auto;
    }
    #calendar {
        width: 100%;
    }
</style>
<script
    src="https://www.paypal.com/sdk/js?client-id=AX_USvi6E079i7lb6gbFnx872LUcrNZZ4gws-57mhU17HDBe-VMJv2wvwxpBB1Bqp32XOA3H3pRcBzLw&currency=PHP&components=buttons&enable-funding=card&disable-funding=venmo,paylater"
    data-sdk-integration-source="developer-studio"
></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const bookingForm = document.getElementById("bookingForm");
  const confirmBookingButton = document.getElementById("confirmBooking");
  const paypalButtonContainer = document.getElementById("paypal-button-container");
  const resultMessage = document.getElementById("result-message");

  bookingForm.addEventListener("submit", function (e) {
    e.preventDefault();
    const selectedDate = document.getElementById("date").value;

    if (!selectedDate) {
      alert("Please select a date.");
      return;
    }

    // Show PayPal button inside the modal
    paypalButtonContainer.classList.remove('d-none');

    // Render PayPal Buttons
    if (typeof paypal !== 'undefined') {
      paypal.Buttons({
        style: {
          layout: 'vertical',
          color: 'gold',
          shape: 'rect',
          label: 'paypal'
        },
        createOrder: function (data, actions) {
          const rawPrice = document.getElementById("price").value;
          const numericPrice = parseFloat(rawPrice.replace(/[^\d.]/g, '')) || 0;

          return actions.order.create({
            purchase_units: [{
              amount: {
                value: numericPrice.toFixed(2)
              }
            }]
          });
        },
        onApprove: function (data, actions) {
          return actions.order.capture().then(function (details) {
            const transactionId = details.id;
            const payerName = details.payer.name.given_name;

            const fullName = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const contact = document.getElementById("contact").value;
            const date = document.getElementById("date").value;
            const training = document.getElementById("training").value;
            const coach = document.getElementById("coach").value;
            const sessions = document.getElementById("sessions").value;
            const price = document.getElementById("price").value;

            fetch('../user/submitBooking.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                fullName: fullName,
                email: email,
                contact: contact,
                date: date,
                training: training,
                coach: coach,
                sessions: sessions,
                price: price,
                transactionId: transactionId
              })
            })
            .then(response => response.text())
            .then(result => {
              console.log(result);
              resultMessage.innerText = `Transaction completed by ${payerName}!`;
              resultMessage.classList.remove('d-none');
              setTimeout(() => {
                resultMessage.classList.add('d-none');
                alert("Booking submitted successfully!");
                // Redirect to schedules.php
                window.location.href = "schedules.php";
              }, 2000);
            })
            .catch(error => {
              console.error('Error submitting booking:', error);
              alert("There was an error submitting your booking.");
            });
          });
        }
      }).render('#paypal-button-container'); // 🟢 This line was missing!
    }

    // Show the modal
    const calendarModal = new bootstrap.Modal(document.getElementById('calendarModal'));
    calendarModal.show();
  });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const trainingInput = document.getElementById("training");
  const sessionsGroup = document.getElementById("sessionsGroup");
  const sessionsDropdown = document.getElementById("sessions");
  const priceGroup = document.getElementById("priceGroup");
  const priceField = document.getElementById("price");

  const courseOptions = {
    "Personal Training": { showSessions: true },
    "Basketball Training": {
      showSessions: false,
      fixedOptions: [
        { label: "12 Sessions", price: "₱5,500" },
        { label: "24 Sessions", price: "₱9,000" },
      ]
    },
    "Personal Training": { showSessions: true },
    "Boxing Training": { showSessions: true }
  };

  document.querySelectorAll('.book-now').forEach(button => {
    button.addEventListener('click', function () {
      const course = this.getAttribute('data-course');
      trainingInput.value = course;

      // Reset and hide all initially
      sessionsDropdown.innerHTML = `<option value="">Select Sessions</option>`;
      sessionsGroup.classList.add("d-none");
      priceGroup.classList.add("d-none");
      priceField.value = "";

      const config = courseOptions[course];
      if (config) {
        if (config.showSessions) {
          // For Personal Training, 3, 4 (10/20/30 sessions)
          sessionsGroup.classList.remove("d-none");
          sessionsDropdown.innerHTML += `
            <option value="10">10 Sessions</option>
            <option value="20">20 Sessions</option>
            <option value="30">30 Sessions</option>
          `;
        } else if (config.fixedOptions) {
          // For Basketball Training (fixed dropdown with 12 & 24 sessions)
          sessionsGroup.classList.remove("d-none");
          config.fixedOptions.forEach(opt => {
            const option = document.createElement("option");
            option.text = opt.label;
            option.value = opt.label;
            option.setAttribute("data-price", opt.price);
            sessionsDropdown.appendChild(option);
          });
        }
      }
    });
  });

  sessionsDropdown.addEventListener("change", function () {
    const selectedCourse = trainingInput.value;
    const value = this.value;

    let price = "";

    if (["Personal Training", "Personal Training", "Boxing Training"].includes(selectedCourse)) {
      if (value === "10") price = "₱8,500";
      else if (value === "20") price = "₱15,500";
      else if (value === "30") price = "₱20,500";
    } else if (selectedCourse === "Basketball Training") {
      const selectedOption = this.options[this.selectedIndex];
      price = selectedOption.getAttribute("data-price") || "";
    }

    if (price) {
      priceGroup.classList.remove("d-none");
      priceField.value = price;
    } else {
      priceGroup.classList.add("d-none");
      priceField.value = "";
    }
  });
});
</script>
<?php
// Fetch every booked date in the table
$res = mysqli_query($conn, "SELECT date FROM bookings");
$allDates = [];
while ($r = mysqli_fetch_assoc($res)) {
    $allDates[] = $r['date'];
}
$bookedDatesJson = json_encode($allDates);
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var bookedDates = <?php echo $bookedDatesJson; ?>;
    var selectedDate = null;
    var calendarEl = document.getElementById('calendar');
    var selectedDateDisplay = document.getElementById('selectedDateDisplay');
    var confirmBookingButton = document.getElementById('confirmBooking');
    var dateInput = document.getElementById('date');
    var trainingInput = document.getElementById('training');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 500,
        contentHeight: 400,
        selectable: true,
        dateClick: function(info) {
            if (bookedDates.includes(info.dateStr)) {
                alert('This date is already booked.');
            } else {
                selectedDate = new Date(info.dateStr);
                var options = { month: 'short', day: '2-digit', year: 'numeric' };
                selectedDateDisplay.textContent = selectedDate.toLocaleDateString('en-US', options);
                dateInput.value = info.dateStr;
                confirmBookingButton.disabled = false;
            }
        },
        events: bookedDates.map(date => ({
            title: 'Booked',
            start: date,
            color: 'red'
        }))
    });

    document.getElementById('calendarModal').addEventListener('shown.bs.modal', function () {
        calendar.render();
    });

    document.querySelectorAll('.book-now').forEach(button => {
        button.addEventListener('click', function() {
            trainingInput.value = this.getAttribute('data-course');
        });
    });
});
</script>




<!-- Bootstrap Modals for Courses -->
<!-- Personal Training Modal -->
<div class="modal fade" id="courseModal1" tabindex="-1" aria-labelledby="courseModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train1.jpg" class="img-fluid rounded mb-3" alt="personal Training">

            </div>
        </div>
    </div>
</div>

<!-- Basketball Training Modal -->
<div class="modal fade" id="courseModal2" tabindex="-1" aria-labelledby="courseModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train2.jpg" class="img-fluid rounded mb-3" alt="Basketball Training">

            </div>
        </div>
    </div>
</div>

<!-- Personal Training Modal -->
<div class="modal fade" id="courseModal3" tabindex="-1" aria-labelledby="courseModalLabel3" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train3.jpg" class="img-fluid rounded mb-3" alt="Personal Training">

            </div>
        </div>
    </div>
</div>

<!-- Boxing Training Modal -->
<div class="modal fade" id="courseModal4" tabindex="-1" aria-labelledby="courseModalLabel4" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="../pictures/train4.jpg" class="img-fluid rounded mb-3" alt="Boxing Training">

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
            height="350"
            style="border:0;"
            allowfullscreen
            loading="lazy">
        </iframe>
    </div>
</section>


<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Renew Your Membership</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="membershipSelection">
                <div class="row text-center">
                    <!-- Package 1 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Membership for 3 months</h5>
                                <p class="fw-bold">P4,500</p>
                                <button class="btn btn-primary select-btn" data-membership="3 Months">Select</button>
                            </div>
                        </div>
                    </div>
                    <!-- Package 2 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Membership for 6 months</h5>
                                <p class="fw-bold">P7,500</p>
                                <button class="btn btn-primary select-btn" data-membership="6 Months">Select</button>
                            </div>
                        </div>
                    </div>
                    <!-- Package 3 -->
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Membership for 9 months</h5>
                                <p class="fw-bold">P12,500</p>
                                <button class="btn btn-primary select-btn" data-membership="9 Months">Select</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Membership Form (Initially Hidden) -->
            <div class="modal-body d-none" id="membershipForm">
    <h5 class="text-center">Fill Out Your Details</h5>
    <form id="membershipFormElement">
        <div class="mb-3">
            <label for="name" class="form-label">Full Name (for keycard purposes)</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $fetch['Fname'] . ' ' . $fetch['Lname']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $fetch['email']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="membershipType" class="form-label">Selected Membership</label>
            <input type="text" class="form-control" id="membershipType" name="membershipType" readonly>
        </div>
        <div class="d-flex justify-content-between">
            <button type="button" class="btn btn-primary" id="backButton">Back</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
        </div>
     </div>
  </div>
</div>
<!-- SweetAlert2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.css" rel="stylesheet">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.5.0/dist/sweetalert2.min.js"></script>

<div id="successAlert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
  Form submitted successfully!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<script>
document.getElementById('membershipFormElement').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('../user/submit_membership.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Use SweetAlert to show a success message
        Swal.fire({
            icon: 'success',
            title: 'Submitted Successfully!',
            text: 'wait for the renewal approval ',
            confirmButtonText: 'OK',
            willClose: () => {
                // Reload the page after closing the alert
                location.reload();
            }
        });
    })
    .catch(error => {
        console.error('Error:', error);
        // Show an error message if the submission fails
        Swal.fire({
            icon: 'error',
            title: 'Something went wrong!',
            text: 'Please try again.',
        });
    });
});
</script>





<script>
    document.querySelectorAll('.select-btn').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('membershipSelection').classList.add('d-none');
            document.getElementById('membershipForm').classList.remove('d-none');
            document.getElementById('membershipType').value = this.getAttribute('data-membership');
        });
    });

    document.getElementById('backButton').addEventListener('click', function () {
        document.getElementById('membershipForm').classList.add('d-none');
        document.getElementById('membershipSelection').classList.remove('d-none');
    });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const calendarModal = document.getElementById('calendarModal');

    calendarModal.addEventListener('hidden.bs.modal', function () {
      // Remove Bootstrap's modal-open class
      document.body.classList.remove('modal-open');

      // Remove any lingering backdrops
      document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());

      // Optional: Clear calendar content or reset form if needed
      // document.getElementById('calendar').innerHTML = ''; // if you're regenerating the calendar
    });

    // OPTIONAL SAFETY: Prevent stacking event listeners if you're binding them in modal
    if (window.modalAlreadyBound !== true) {
      window.modalAlreadyBound = true;

      // Example: clear form or re-bind listeners only once
      calendarModal.addEventListener('show.bs.modal', function () {
        console.log("Modal is opening cleanly");
      });
    }
  });
</script>




<script>
  document.querySelectorAll('.book-now').forEach(button => {
    button.addEventListener('click', function () {
      const coach = this.getAttribute('data-coach');

      // Set coach dropdown
      const coachDropdown = document.getElementById('coach');
      coachDropdown.innerHTML = `<option value="${coach}">${coach}</option>`;
      coachDropdown.value = coach;

      // Enable both if you want them visible (even though they’re static)
      trainingDropdown.disabled = false;
      coachDropdown.disabled = false;
    });
  });
</script>






<?php include("footer.php");  ?>


</body>
</html>
