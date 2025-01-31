<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$citizenship = $_POST['citizenship'];
$gender = $_POST['gender'];

// SQL query to insert data into the "user" table
$sql = "INSERT INTO user (email, username, password, citizenship_no, gender) 
        VALUES ('$email', '$username', '$password', '$citizenship', '$gender')";

if ($conn->query($sql) === TRUE) {
    $message = "You have successfully registered.";

            echo '<script type="text/javascript">';
            echo 'alert("' . $message . '");';
            echo 'window.location.href = "index.php";'; // Replace "index.php" with the desired page URL
            echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
