

<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ensure the database connection is included
require './db_connection.php'; // Save the connection code in db_connection.php for reuse

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $location = $_POST['location'];
    $bio = $_POST['bio'];
    $experience = $_POST['experience'];
    $rate = $_POST['rate'];

    $sql = "INSERT INTO guide_profiles (name, location, bio, experience, rate_per_hour) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdi", $name, $location, $bio, $experience, $rate);

    if ($stmt->execute()) {
        echo "Guide details added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
