<?php
session_start();  // Start the session to access session variables

include '../database/connection.php';

$fullName = $_POST['name'];
$email = $_POST['email'];
$membershipType = $_POST['membershipType'];

// Ensure user_id is available in the session
if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$user_id = $_SESSION['user_id']; // Get user_id from the session

// SQL query with a placeholder for user_id
$sql = "INSERT INTO memberships (full_name, email, membership_type, status, user_id)
        VALUES (?, ?, ?, 'pending', ?)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sssi", $fullName, $email, $membershipType, $user_id); // 'i' is for integer (user_id)

// Execute the statement
if ($stmt->execute()) {
    echo "Membership application submitted successfully!";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
