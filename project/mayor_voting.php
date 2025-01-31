<!DOCTYPE html>
<html>

<head>
    <title>Voting Page</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background-color: #0F1010;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: yellow;
            text-align: center;
            font-size: 50px;
            margin: 30px 0;
        }

        p {
            color: white;
            text-align: center;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .back-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #45a049;
        }

        .candidates-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: left;
            margin-bottom: 30px;
            margin-left: 400px;
        }

        .candidate {
            display: flex;
            flex-direction: row;
            /* align-items: center; */
            /* margin: 10px; */
            padding: 20px;
            background-color: #333333;
            border-radius: 10px;
            width:600px;
            margin-bottom: 30px;
            margin-right: 100px;
        }

        .candidate img {
            height: 300px;
            width: 250px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
            
        }
            

        .candidate-details {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-top: 10px;   
            margin-left:30px;
        }

        .candidate-name {
            font-weight: bold;
            font-size: 24px;
            color: white;
            text-align: center;
        }

        .vote-button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            margin-top: 10px;
            width:150px;
        }

        .vote-button:hover {
            background-color: #45a049;
        }

        .vote-count {
            color: white;
            text-align: right;
            margin-top: 10px;
        }

        .no-candidates {
            text-align: center;
            color: white;
            font-size: 24px;
        }
    </style>
</head>

<body>
    <h1>Online Voting System</h1>
    <p>Mayor</p>

    <button class="back-button" onclick="goBack()">Back</button>

    <div class="candidates-container">
        <?php
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voting";

        
        $conn = new mysqli($servername, $username, $password, $dbname);

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Fetch data from the candidates table for the position "mayor"
        $sql = "SELECT name, votes, image FROM candidates WHERE position = 'mayor'";
        $result = $conn->query($sql);

        // Check if any rows were returned
        if ($result->num_rows > 0) {
            $counter = 0;
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($counter % 2 == 0) {
                    // Start a new row for every even counter value
                    echo "<div class='candidates-row'>";
                }

                echo "<div class='candidate'>";
                if (isset($row['image'])) {
                    echo "<img src='image/" . $row['image'] . "'>";
                } else {
                    echo "<p style='color: white;'>Image not available</p>";
                }
                echo "<div class='candidate-details'>";
                echo "<h3 class='candidate-name'>" . $row["name"] . "</h3>";
                echo '<form method="POST" action="store_vote.php">
                        <input type="hidden" name="candidate_name" value="' . $row["name"] . '">';
                if (isset($_POST['candidate_name']) && $_POST['candidate_name'] === $row["name"]) {
                    echo '<button type="submit" class="vote-button" style="background-color: white; color: #0F1010;">Voted</button>';
                } else {
                    echo '<button type="submit" class="vote-button">Vote</button>';
                }
                echo '</form>';

                echo "<p class='vote-count'>Votes: " . $row["votes"] . "</p>";
                echo "</div>";
                echo "</div>";

                if ($counter % 2 != 0 || $counter == $result->num_rows - 1) {
                    // Close the row for every odd counter value or when it's the last candidate
                    echo "</div>";
                }

                $counter++;
            }
        } else {
            echo "<p class='no-candidates'>No candidates found for the position of mayor.</p>";
        }

        
        $conn->close();
        ?>
    </div>

    <script>
        function goBack() {
            window.location.href = "user.php";
        }
    </script>
</body>

</html>
