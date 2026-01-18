<?php
// $serverName = "localhost";
// $userName = "root";
// $password = "";
// $dbName = "alphagrind";

$serverName = "localhost";
$userName = "bsituccc_alphagl";
$password = "alphagl2025";
$dbName = "bsituccc_alphagl";


// Create connection
$conn = mysqli_connect($serverName, $userName, $password, $dbName);

// Check connection
if (!$conn) {  // Use `!$conn` instead of `$conn->connect_error`
    die("Connection Failed: " . mysqli_connect_error());
} else {
    // Optional: Uncomment to verify the connection works
    // echo "Connected successfully";
}
try {
    // Create a PDO instance
    $pdo = new PDO("mysql:host=$serverName;dbname=$dbName", $userName, $password);
    // Set the PDO error mode to exception for better debugging
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
