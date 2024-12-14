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

// Handle hiring action if an ID is passed via POST
if (isset($_POST['id'])) {
    $guideId = $_POST['id'];

    // Prepare the SQL query to update the 'Hiring' column with "Nirwan"
    $sql = "UPDATE guide_profiles SET Hiring = 'Nirwan' WHERE id = $guideId";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "Guide has been hired successfully.";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    exit; // End the script after processing the request
}

// Fetch the list of guides from the database
$sql = "SELECT * FROM guide_profiles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Guides</title>
    <style>
        /* General Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }

        /* Table Header Styling */
        th {
            background-color: #4CAF50;
            color: white;
            padding: 12px;
            text-align: left;
        }

        /* Table Row Styling */
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        /* Hover Effect on Table Rows */
        tr:hover {
            background-color: #f2f2f2;
        }

        /* Styling for Hire Button */
        a {
            padding: 8px 12px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
        }

        a:hover {
            background-color: #0056b3;
        }

        /* Styling for Table Container */
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Responsive Design: For smaller screens */
        @media screen and (max-width: 600px) {
            table, th, td {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            a {
                padding: 6px 10px;
                font-size: 14px;
            }
        }
    </style>
    <script>
        // JavaScript function to handle hiring
        function hireGuide(guideId) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '', true); // Sending to the same page
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            
            // Send the guide ID to the same page
            xhr.send('id=' + guideId);

            // Handle the response
            xhr.onload = function() {
                if (xhr.status == 200) {
                    alert('Guide has been hired successfully!');
                    location.reload(); // Reload the page to show the updated status
                } else {
                    alert('Error: Could not hire the guide.');
                }
            };
        }
    </script>
</head>
<body>

<div class="container">
    <h1>Available Guides</h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone No</th>
            <th>Rate per Day</th>
            <th>Experience (Years)</th>
            <th>Hire</th>
        </tr>

        <?php
        // Output data for each guide
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["Phone no"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["rate_per_day"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["experience"]) . "</td>";
                // "Hire" link with guide ID passed to JavaScript
                echo "<td><a href='#' onclick='hireGuide(" . $row["id"] . ")'>Hire</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No guides available.</td></tr>";
        }
        ?>
    </table>
</div>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
