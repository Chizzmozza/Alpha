<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include "../database/connection.php";

$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
   header('location:../guest/index.php');
   exit();
}

if (isset($_GET['Logout'])) {
   session_unset();
   session_destroy();
   header('location:../guest/index.php');
   exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Gym Coach</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('../pictures/gym.png') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .booking-form {
            max-width: 700px;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            height: 38px;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function validateInput(input, messageId, pattern, message) {
            const value = input.value;
            const messageElement = document.getElementById(messageId);
            if (!value.match(pattern)) {
                messageElement.textContent = message;
                messageElement.style.color = "red";
            } else {
                messageElement.textContent = "";
            }
        }

        function validatePhone(input) {
            const value = input.value;
            const messageElement = document.getElementById("phone-error");
            if (!/^[0-9]*$/.test(value)) {
                messageElement.textContent = "Only numbers are allowed.";
                messageElement.style.color = "red";
            } else if (value.length > 0 && value.length < 10) {
                messageElement.textContent = "Minimum of 10 digits are allowed.";
                messageElement.style.color = "red";
            } else {
                messageElement.textContent = "";
            }
        }

        function validateForm(event) {
            const requiredFields = document.querySelectorAll("input[required], select[required]");
            let isValid = true;

            requiredFields.forEach(field => {
                if (field.value.trim() === "") {
                    isValid = false;
                    field.style.border = "2px solid red"; // Highlight empty fields
                } else {
                    field.style.border = ""; // Reset border if filled
                }
            });

            if (!isValid) {
                event.preventDefault();
                alert("⚠️ Please fill in all required fields before booking.");
            }
        }
    </script>
</head>
<body>
    <div class="booking-form">
        <h3 class="text-center">Book a Gym Coach</h3>
        <form action="booking_process.php" method="POST" onsubmit="validateForm(event)">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="username" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="username" name="username" required
                            pattern="^[A-Za-z ]+$" title="Only letters and spaces are allowed."
                            oninput="validateInput(this, 'username-error', /^[A-Za-z ]+$/, 'Only letters and spaces are allowed.')">
                        <small id="username-error" class="form-text"></small>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required
                            oninput="validatePhone(this)">
                        <small id="phone-error" class="form-text"></small>
                    </div>
                    <div class="mb-3">
                        <label for="membership_status" class="form-label">Membership Status</label>
                        <select class="form-control" id="membership_status" name="membership_status" required>
                            <option value="">-- Select --</option>
                            <option value="Member">Member</option>
                            <option value="Non-Member">Non-Member</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="coach_id" class="form-label">Select Coach</label>
                        <select class="form-control" id="coach_id" name="coach_id" required>
                            <option value="">-- Select --</option>
                            <option value="Coach JV">Coach JV</option>
                            <option value="Coach Darren">Coach Darren</option>
                            <option value="Coach Kyle">Coach Kyle</option>
                            <option value="Coach Andy">Coach Andy</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Booking Date</label>
                        <input type="date" class="form-control" id="booking_date" name="booking_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="booking_time" class="form-label">Booking Time</label>
                        <input type="time" class="form-control" id="booking_time" name="booking_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="payment_status" class="form-label">Payment Status</label>
                        <select class="form-control" id="payment_status" name="payment_status" required>
                            <option value="">-- Select --</option>
                            <option value="Pending">Pending</option>
                            <option value="Paid">Paid</option>
                            <option value="Cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Book Now</button>
        </form>
    </div>
</body>
</html>
