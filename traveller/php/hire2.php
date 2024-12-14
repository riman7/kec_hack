<?php
// Error reporting for debugging (optional, remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'travel_guide';
$conn = new mysqli($host, $user, $password, $database);

// Check for database connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the ID parameter is passed in the POST request
if (isset($_POST['id'])) {
    $guideId = $_POST['id'];

    // Prepare the SQL query to update the 'Hiring' column with "Nirwan"
    $sql = "UPDATE guides SET Hiring = 'Nirwan' WHERE id = $guideId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Guide has been hired successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "No guide ID specified.";
}

// Close the database connection
$conn->close();
?>
