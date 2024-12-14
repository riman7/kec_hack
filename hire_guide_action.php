<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'travel_guide';

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $guide_id = $_POST['guide_id'];
    $traveler_name = $_POST['traveler_name'];
    $traveler_email = $_POST['traveler_email'];

    // Insert hiring record into hires table
    $sql = "INSERT INTO hires (guide_id, traveler_name, traveler_email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $guide_id, $traveler_name, $traveler_email);
    $stmt->execute();

    // Confirm hire success
    echo "<h2>Success!</h2>";
    echo "<p>You have successfully hired the guide.</p>";
    echo "<p>Traveler Name: " . htmlspecialchars($traveler_name) . "</p>";
    echo "<p>Traveler Email: " . htmlspecialchars($traveler_email) . "</p>";
    echo "<p>Guide ID: " . htmlspecialchars($guide_id) . "</p>";
} else {
    echo "Invalid request method.";
}

// Close the database connection
$conn->close();
?>
