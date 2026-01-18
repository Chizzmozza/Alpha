<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include ("../phpmailer/vendor/autoload.php"); // If using Composer

include("../database/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['membership_id'])) {
    $membership_id = $_POST['membership_id'];

    // Check if the membership exists
    $check = mysqli_query($conn, "SELECT * FROM memberships WHERE membership_id = '$membership_id'");
    $row = mysqli_fetch_assoc($check);

    if ($row['status'] == 'approved') {
        echo "already";
        exit;
    }

    // Start a transaction to ensure both queries are executed together
    mysqli_begin_transaction($conn);

    try {
        // Approve membership in the memberships table
        $update_membership = mysqli_query($conn, "UPDATE memberships SET status = 'approved' WHERE membership_id = '$membership_id'");

        if (!$update_membership) {
            throw new Exception("Failed to update membership status: " . mysqli_error($conn));
        }

        // Update the user's role in the users table to 'member'
        $user_id = $row['user_id']; // Get user_id from the memberships table
        $update_role = mysqli_query($conn, "UPDATE user SET role = 'member' WHERE user_id = '$user_id'");

        if (!$update_role) {
            throw new Exception("Failed to update user role: " . mysqli_error($conn));
        }

        // Commit the transaction
        mysqli_commit($conn);

        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
             $mail->Host = 'mail.bsitucc.com';
                           $mail->SMTPAuth = true;
                           $mail->Host = 'mail.bsitucc.com';
                   $mail->Username = 'alphagrindlab@bsitucc.com'; // SMTP username
                   $mail->Password = 'alphagl2025'; // SMTP password
                   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                   $mail->Port = 587;

                   $mail->setFrom('alphagrindlab@bsitucc.com', 'Alpha Grind Lab');
            $mail->addAddress($row['email'], $row['full_name']);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Membership Approved';
            $mail->Body    = "Hi " . htmlspecialchars($row['full_name']) . ",<br><br>Your membership request has been approved.
            <br><br>To pay and Claim Keycard Pass please proceed to the Alpha Grind Lab Maypajo Branch.
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
