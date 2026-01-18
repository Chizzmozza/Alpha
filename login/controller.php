<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require "../database/connection.php";
$username = "";
$contact = "";
$email = "";
$fname = "";
$errors = array();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include ("../phpmailer/vendor/autoload.php"); // If using Composer

$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']); // Clear errors after use

if (isset($_POST['register'])) {
    // Escape user inputs to prevent SQL injection
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = isset($_POST['cpassword']) ? mysqli_real_escape_string($conn, $_POST['cpassword']) : '';


    // Password validation
    if ($password !== $cpassword) {
        $errors[] = "Passwords do not match!";
    }

    // Check if email already exists
    $email_check_query = "SELECT * FROM user WHERE email = '$email'";
    $email_check_result = mysqli_query($conn, $email_check_query);

    if (mysqli_num_rows($email_check_result) > 0) {
        $errors[] = "The email is already in use!";
    }

    // If no errors, insert user data
    if (count($errors) === 0) {
        $encpass = password_hash($password, PASSWORD_DEFAULT);
        $code = rand(999999, 111111);
        $status = "notverified";

        $default_image = '../pictures/userlogo.png'; // Path to default image
        $insert_query = "INSERT INTO user (Fname, Lname, contact, address, email, password, code, status, image)
                   VALUES ('$fname', '$lname', '$contact', '$address', '$email', '$encpass', '$code', '$status', '$default_image')";

                   if (mysqli_query($conn, $insert_query)) {
                       // Send email using PHPMailer
                       $mail = new PHPMailer(true);
                       try {
                           $mail->isSMTP();
                           $mail->SMTPAuth = true;
                           $mail->Host = 'mail.bsitucc.com';
                            $mail->Username = 'alphagrindlab@bsitucc.com'; // SMTP username
                            $mail->Password = 'alphagl2025'; // SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->Port = 587;

                            $mail->setFrom('alphagrindlab@bsitucc.com', 'Alpha Grind Lab');
                           $mail->addAddress($email);
                           $mail->isHTML(true);
                           $mail->Subject = 'Email Verification Code';
                           $mail->Body = "Your verification code is $code";

                           $mail->send();

                           $_SESSION['info'] = "Verification code sent to $email.";
                           $_SESSION['email'] = $email;
                           header('location: ../login/user-otp.php');
                           exit();
                       } catch (Exception $e) {
                           $errors['mail'] = "Email could not be sent. Error: {$mail->ErrorInfo}";
                       }
                   } else {
                       $errors['db'] = "Database insertion failed: " . mysqli_error($conn);
                   }
    }


    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;

        // Determine which modal to show
        if (isset($_POST['register'])) {
            $_SESSION['show_modal'] = 'registerModal';
        } elseif (isset($_POST['login'])) {
            $_SESSION['show_modal'] = 'loginModal';
        }

        header('Location: ../guest/index.php'); // Make sure this is correct
        exit();
    }


}



    //if user click verification code submit button
    if (isset($_POST['check'])) {
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);

        $check_code = "SELECT * FROM user WHERE code = '$otp_code'";
        $code_res = mysqli_query($conn, $check_code);

        if (!$code_res) {
            die("Database error: " . mysqli_error($conn)); // Debugging: Check if query fails
        }

        if (mysqli_num_rows($code_res) > 0) {
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $fname = $fetch_data['Fname'];
            $username = isset($fetch_data['username']) ? $fetch_data['username'] : '';

            // Update the database to mark email as verified
            $update_otp = "UPDATE user SET code = 0, status = 'verified' WHERE email = '$email'";
            $update_res = mysqli_query($conn, $update_otp);

            if ($update_res) {
                $_SESSION['fname'] = $fname;
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $username;

                // Debugging output
                echo "Redirecting to profile...";
                header('Location: ../user/profile.php');
                exit();
            } else {
                die("Failed to update user verification status: " . mysqli_error($conn));
            }
        } else {
            $errors['otp-error'] = "You've entered an incorrect OTP!";
        }
    }



    // if user clicks login button
    if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $check_email = "SELECT password, status, role, user_id FROM user WHERE email = '$email'";
    $res = mysqli_query($conn, $check_email);

    // Check if the query succeeded
    if ($res === false) {
        die("Database query failed: " . mysqli_error($conn)); // Debugging (optional)
    }

    // Check if rows exist
    if (mysqli_num_rows($res) > 0) {
        $fetch = mysqli_fetch_assoc($res);
        $fetch_pass = $fetch['password'];

        if (password_verify($password, $fetch_pass)) {
            $status = $fetch['status'];
            $role = $fetch['role'];
            $user_id = $fetch['user_id'];

            $_SESSION['email'] = $email;
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = $user_id;

            if ($status == 'verified') {
                if ($role === 'admin') {
                    header('Location: ../admin/admin.php');
                } elseif ($role === 'member'){
                    header('Location: ../member/index.php');
                }else {
                    header('Location: ../user/index.php');
                }
                exit();
            } else {
                $info = "It looks like you haven't verified your email - $email";
                $_SESSION['info'] = $info;
                header('Location:../login/user-otp.php');
                exit();
            }
        } else {
            $errors['email'] = "Incorrect email or password!";
        }
    } else {
        $errors['email'] = "It looks like you're not yet a member! Click on the bottom link to signup.";
    }


        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;

            // Determine which modal to show
            if (isset($_POST['register'])) {
                $_SESSION['show_modal'] = 'registerModal';
            } elseif (isset($_POST['login'])) {
                $_SESSION['show_modal'] = 'loginModal';
            }

            header('Location: ../guest/index.php'); // Make sure this is correct
            exit();
        }

    }


    //if user click continue button in forgot password form
  if (isset($_POST['check-email'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $check_email = "SELECT * FROM user WHERE email='$email'";
      $run_sql = mysqli_query($conn, $check_email);

      if (mysqli_num_rows($run_sql) > 0) {
          $code = rand(999999, 111111);
          $insert_code = "UPDATE user SET code = $code WHERE email = '$email'";
          $run_query = mysqli_query($conn, $insert_code);

          if ($run_query) {
              // Use PHPMailer for sending the password reset email
              $mail = new PHPMailer(true);

              try {
                  //Server settings
                  $mail->isSMTP();
                  $mail->SMTPAuth = true;
                   $mail->Host = 'mail.bsitucc.com';
                   $mail->Username = 'alphagrindlab@bsitucc.com'; // SMTP username
                   $mail->Password = 'alphgl2025'; // SMTP password
                   $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                   $mail->Port = 587;

                   $mail->setFrom('alphagrindlab@bsitucc.com', 'Alpha Grind Lab');
                  $mail->addAddress($email); // Add a recipient

                  // Content
                  $mail->isHTML(true);
                  $mail->Subject = 'Password Reset Code';
                  $mail->Body = "Your password reset code is $code";

                  $mail->send();

                  $info = "We've sent a password reset OTP to your email – $email";

                  $_SESSION['info'] = $info;
                  $_SESSION['email'] = $email;
                  header('location: reset-code.php');
                  exit();
              } catch (Exception $e) {
                  $errors['otp-error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }
          } else {
              $errors['db-error'] = "Something went wrong!";
          }
      } else {
          $errors['email'] = "This email address does not exist!";
      }
  }


    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($conn, $_POST['otp']);
        $check_code = "SELECT * FROM user WHERE code = $otp_code";
        $code_res = mysqli_query($conn, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $email = $fetch_data['email'];
            $_SESSION['email'] = $email;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);
        if($password !== $cpassword){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $email = $_SESSION['email']; //getting this email using session
            $encpass = password_hash($password, PASSWORD_DEFAULT);
            $update_pass = "UPDATE user SET code = $code, password = '$encpass' WHERE email = '$email'";
            $run_query = mysqli_query($conn, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

    ob_end_flush();

?>
