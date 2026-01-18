<?php
include '../database/connection.php';

header('Content-Type: application/json');

// Only allow POST with JSON body
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Only POST method allowed."]);
    exit;
}

// Get JSON from fetch
$data = json_decode(file_get_contents("php://input"), true);

// If no JSON was sent or decoding failed
if (!$data) {
    echo json_encode(["error" => "No JSON received or invalid JSON."]);
    exit;
}

// Sanitize and extract input
$fullName = $data['fullName'] ?? '';
$email = $data['email'] ?? '';
$phone = $data['contact'] ?? '';
$date = $data['date'] ?? '';
$training = $data['training'] ?? '';
$coach = $data['coach'] ?? '';
$sessions = $data['sessions'] ?? '';
$price = $data['price'] ?? '';
$transactionId = $data['transactionId'] ?? '';

// Validate required fields
if (empty($fullName) || empty($email) || empty($transactionId)) {
    echo json_encode(["error" => "Missing required fields."]);
    exit;
}

// Prepare and execute insert query
$query = "INSERT INTO bookings (fullname, email, contact, date, training, coach, session, price, paymentStatus, paymentMode, transactionID, status)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?,'Paid', 'Paypal', ?, 'pending')";

$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("sssssssss", $fullName, $email, $phone, $date, $training, $coach, $sessions, $price, $transactionId);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Booking saved successfully.", "transactionId" => $transactionId]);
    } else {
        echo json_encode(["error" => "Database error: " . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Database error: " . $conn->error]);
}

$conn->close();
?>
