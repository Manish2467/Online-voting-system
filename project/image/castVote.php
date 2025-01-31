<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the vote value from the request
    $vote = $_POST["vote"];

    // Update the votes column in the voting table
    $sql = "UPDATE voting SET votes = votes + 1 WHERE name = '$vote'";

    if ($conn->query($sql) === TRUE) {
        echo "Vote recorded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
