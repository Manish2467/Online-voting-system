<?php
// Check if the form was submitted for deleting a candidate
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete-candidate"])) {
  
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "voting";

 
    $conn = new mysqli($servername, $username, $password, $dbname);

   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the candidate's name and position from the form
    $candidateName = $_POST["candidate-name"];
    $candidatePosition = $_POST["candidate-position"];

    // Delete the candidate from the database
    $sql = "DELETE FROM candidates WHERE name = '$candidateName' AND position = '$candidatePosition'";
    if ($conn->query($sql) === TRUE) {
        echo "Candidate deleted successfully.";
    } else {
        echo "Error deleting candidate: " . $conn->error;
    }

    
    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        .candidate-form {
            display: none;
            margin-bottom: 20px;
        }

        .candidate-form input[type="text"],
        .candidate-form input[type="file"] {
            margin-bottom: 10px;
        }

        .button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }

        .candidate-form {
            display: none;
            margin-bottom: 20px;
        }

        .form-container {
            text-align: center;
        }

        .candidate-form input[type="text"],
        .candidate-form input[type="file"] {
            margin-bottom: 10px;
        }

        .button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        h1 {
            text-align: center;
            color: white;
        }

        h2 {
            color: white;
        }
    </style>
    <script>
        function logout() {
            window.location.href = "index.php";
            window.location.replace("index.php");
        }
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</head>

<body bgcolor="#0F1010">
    <h1 style="color:yellow;">Admin Panel</h1>

    <div class="form-container">
        <h2>Add Candidate</h2>
        <form method="POST" action="add_candidate.php" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Candidate Name" style="height:30px; width:20%;background-color:#f5f5f5;" required><br>
            <input type="file" name="photo" style="height:30px; width:20%; background-color: #f5f5f5;" required><br>

            <input type="text" name="position" placeholder="Position for Vote" style="height:30px; width:20%"
                required><br><br>
            <input type="submit" value="Submit" class="button">
        </form>
    </div>

    <div class="form-container">
        <h2>Delete Candidate</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="candidate-name" placeholder="Candidate Name" style="height:30px; width:20%;"
                required><br>
            <input type="text" name="candidate-position" placeholder="Candidate Position"
                style="height:30px; width:20%;" required><br><br>
            <input type="hidden" name="delete-candidate" value="1">
            <input type="submit" value="Delete" class="button">
        </form>
    </div>

    <div class="form-container">
        <h2 style="color:yellow;">Candidates and Votes</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voting";

       
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the candidates table
        $sql = "SELECT name, votes, position FROM candidates";
        $result = $conn->query($sql);

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            // Define categories
            $categories = array(
                'president' => array(),
                'prime minister' => array(),
                'mayor' => array()
            );

            // Process the data and categorize names
            while ($row = $result->fetch_assoc()) {
                $category = strtolower($row['position']);
                if (array_key_exists($category, $categories)) {
                    $categories[$category][] = $row;
                }
            }

            // Display the categorized names and vote bars
            foreach ($categories as $category => $candidates) {
                echo "<h2 style='color:yellow;'>{$category}</h2>";
                foreach ($candidates as $candidate) {
                    $name = $candidate['name'];
                    $votes = $candidate['votes'];

                    // Calculate vote percentage
                    $totalVotes = array_sum(array_column($candidates, 'votes'));
                    $percentage = ($totalVotes > 0) ? round(($votes / $totalVotes) * 100) : 0;

                    // Display the name, vote number, and vote bar
                    echo "<p style='color: white;'>{$name} ({$votes} votes)</p>";
                    echo "<div style='background-color: white; height: 20px; width: {$votes}%;margin-left:500px;'></div>";
                    echo "<br>";
                }
            }
        } else {
            echo "No candidates found.";
        }

        $conn->close();
        ?>
    </div>

    <div class="form-container">
        <button onclick="logout()" class="button">Log Out</button>
    </div>

</body>

</html>