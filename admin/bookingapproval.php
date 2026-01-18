<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include ("../phpmailer/vendor/autoload.php");

include("../database/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Booking_id'])) {
    $booking_id = $_POST['Booking_id'];

    // Check if booking exists first
    $check = mysqli_query($conn, "SELECT * FROM bookings WHERE Booking_id = '$booking_id'");

    if (!$check || mysqli_num_rows($check) == 0) {
        echo "notfound";  // New case to handle missing record
        exit;
    }

    $row = mysqli_fetch_assoc($check);

    if (strtolower($row['status']) === 'approved') {
        echo "already";
        exit;
    }

    // Start a transaction to ensure both queries are executed together
    mysqli_begin_transaction($conn);

    try {
        // Approve the booking in the bookings table
        $update_booking = mysqli_query($conn, "UPDATE bookings SET status = 'approved' WHERE Booking_id = '$booking_id'");

        if (!$update_booking) {
            throw new Exception("Failed to update booking status: " . mysqli_error($conn));
        }

        // Commit the transaction
        mysqli_commit($conn);

        // Send email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
             $mail->Host = 'mail.bsitucc.com';
                           $mail->SMTPAuth = true;
                            $mail->Host = 'mail.bsitucc.com';
                   $mail->Username = 'alphagrindlab@bsitucc.com'; // SMTP username
                   $mail->Password = 'alphagl2025'; // SMTP password
                   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                   $mail->Port = 587;

                   $mail->setFrom('alphagrindlab@bsitucc.com', 'Alpha Grind Lab');
            $mail->addAddress($row['email'], $row['fullname']); // Make sure 'fullname' exists!

            $mail->isHTML(true);
            $mail->Subject = 'Training Request Approved';
            $mail->Body = "Hi " . htmlspecialchars($row['fullname']) . ",<br><br>Your Training request has been approved.
            <br><br>To know more details please proceed to the Alpha Grind Lab Maypajo Branch.
            <br><br>Thank you!";

            $mail->send();
            echo "success";
        } catch (Exception $e) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        // If any query fails, roll back the transaction
        mysqli_roll_back($conn);
        echo "Error: " . $e->getMessage();
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    echo "invalid";
}
?>
