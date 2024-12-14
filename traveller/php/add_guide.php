<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$host = 'localhost';
$user = 'root';      // Your MySQL username
$password = '';      // Your MySQL password
$database = 'travel_guide'; // Database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission if the method is GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    // Retrieve form data from $_GET
    $name = $_GET['name'];
    $email = $_GET['email'];
    $experience = $_GET['experience'];

    // Prepare and execute the INSERT query to insert data into the database
    $sql = "INSERT INTO guides (name, email, experience) VALUES ('$name', '$email', '$experience')";

    if ($conn->query($sql) === TRUE) {
        echo "New guide added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

// Close connection
$conn->close();
?>
