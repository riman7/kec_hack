<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require './db_connection.php'; // Include the database connection

$location = isset($_GET['location']) ? $_GET['location'] : '';
$sql = "SELECT name, location, bio, experience, rate_per_hour FROM guide_profiles WHERE location LIKE ?";
$stmt = $conn->prepare($sql);
$search = "%" . $location . "%";
$stmt->bind_param("s", $search);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div>";
            echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";
            echo "<p>Location: " . htmlspecialchars($row['location']) . "</p>";
            echo "<p>Bio: " . htmlspecialchars($row['bio']) . "</p>";
            echo "<p>Experience: " . htmlspecialchars($row['experience']) . " years</p>";
            echo "<p>Rate: $" . htmlspecialchars($row['rate_per_hour']) . "/hour</p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>No guides found for this location.</p>";
    }
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
