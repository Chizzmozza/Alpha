<?php
include 'connection.php';  // Ensure this file sets up $conn

if (isset($_GET['SerialCard'])) {
    $uid = $_GET['SerialCard'];

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT Fname FROM user WHERE SerialCard = ?");
    if (!$stmt) {
        die(json_encode(["error" => "SQL Prepare Error: " . $conn->error]));
    }

    $stmt->bind_param("s", $uid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Return a JSON response with Fname
        echo json_encode(["name" => $row['Fname']]);
    } else {
        echo json_encode(["name" => "Unauthorized"]);  // If no user is found
    }

    $stmt->close();
} else {
    echo json_encode(["error" => "Invalid Request"]);
}
?>
