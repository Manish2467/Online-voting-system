<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting";

// Check if the candidate_name value is received
if (isset($_POST["candidate_name"])) {
    $candidateName = $_POST["candidate_name"];

    
    $conn = new mysqli($servername, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve the ID of the user who is voting
    $checkUserIdQuery = "SELECT id, voted_mayor FROM user WHERE id = (SELECT MAX(id) FROM user)";
    $checkUserIdResult = $conn->query($checkUserIdQuery);

    if ($checkUserIdResult === FALSE) {
        echo "Error retrieving user information: " . $conn->error;
    } elseif ($checkUserIdResult->num_rows > 0) {
        $row = $checkUserIdResult->fetch_assoc();
        $userId = $row["id"];
        $votedMayor = $row["voted_mayor"];

        if ($votedMayor == 1) {
            echo "";
            $message = "You have already voted for mayor. Voting is not allowed.";

                    echo '<script type="text/javascript">';
                    echo 'alert("' . $message . '");';
                    echo 'window.location.href = "user.php";'; // Replace "user.php" with the desired page URL
                    echo '</script>';
        } else {
            // Update the votes column for the selected candidate
            $updateVoteQuery = "UPDATE candidates SET votes = votes + 1 WHERE name = '$candidateName' AND position = 'mayor'";
            $updateVoteResult = $conn->query($updateVoteQuery);

            if ($updateVoteResult === TRUE) {
                // Update the voted_mayor column for the user
                $updateVotedMayorQuery = "UPDATE user SET voted_mayor = 1 WHERE id = $userId";
                $updateVotedMayorResult = $conn->query($updateVotedMayorQuery);

                if ($updateVotedMayorResult === TRUE) {
                    
                    $message = "You voted successfully.";

                    echo '<script type="text/javascript">';
                    echo 'alert("' . $message . '");';
                    echo 'window.location.href = "user.php";'; // Replace "user.php" with the desired page URL
                    echo '</script>';
                } else {
                    echo "Error updating voted_mayor column: " . $conn->error;
                }
            } else {
                echo "Error updating vote: " . $conn->error;
            }
        }
    } else {
        echo "Invalid user.";
    }

    
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
