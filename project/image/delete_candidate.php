<?php
// Check if the form was submitted for deleting a candidate
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-candidate"])) {
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

    // Get the candidate's name and position from the form
    $candidateName = $_POST["candidate-name"];
    $candidatePosition = $_POST["candidate-position"];

    // Delete the candidate from the database
    $sql = "DELETE FROM votes WHERE name = '$candidateName' AND position = '$candidatePosition'";
    if ($conn->query($sql) === TRUE) {
        echo "Candidate deleted successfully.";
    } else {
        echo "Error deleting candidate: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
