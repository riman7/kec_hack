<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$host = 'localhost'; // Hostname, usually 'localhost'
$user = 'root';      // Your MySQL username
$password = '';      // Your MySQL password
$database = 'travel_guide'; // Database name

// Create a connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
