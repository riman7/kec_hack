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

// Fetch guides from the database
$sql = "SELECT * FROM guide_profiles";
$result = $conn->query($sql);

// Check if any guides exist
if ($result->num_rows > 0) {
    echo "<h1>Available Guides</h1>";
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Email</th><th>Experience (Years)</th><th>Hire</th></tr>";

    // Output data for each guide
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["experience"]) . "</td>";
        echo "<td><a href='#' onclick='showHireForm(" . $row["id"] . ")'>Hire</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No guides available at the moment.";
}

$conn->close();
?>

<!-- Hidden Hire Form -->
<div id="hireForm" style="display: none;">
    <h2>Hire Guide</h2>
    <form action="hire_guide_action.php" method="POST">
        <input type="hidden" id="guide_id" name="guide_id" value="">
        <label for="traveler_name">Your Name:</label>
        <input type="text" id="traveler_name" name="traveler_name" required><br><br>

        <label for="traveler_email">Your Email:</label>
        <input type="email" id="traveler_email" name="traveler_email" required><br><br>

        <input type="submit" value="Hire Guide">
    </form>
</div>

<script>
    // Function to show the hire form when a traveler clicks 'Hire'
    function showHireForm(guideId) {
        // Set the guide ID in the hidden input field
        document.getElementById('guide_id').value = guideId;
        // Display the hire form
        document.getElementById('hireForm').style.display = 'block';
    }
</script>
