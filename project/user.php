
<!DOCTYPE html>
<html>

<head>
    <title>User Page</title>
    <style>
        
        *{
            font-family: Arial, Helvetica, sans-serif;  
        }
        body {
            background-color: #0F1010;
        }

        .button {
            padding: 10px;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button {
            padding: 10px;
            margin: 5px;
        }

        p {
            color: yellow;
            font-size: 50px;
            text-align: center;
        }

        .form-container {
            text-align: center;
        }
        h1{
            color:white !important;
            text-align:center;
        }

        .logout-button {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
        }
        .username-container {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
        }
    </style>
    <script>
        // JavaScript code to disable back button
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
            history.go(1);
        };
    </script>
</head>

<body bgcolor="#0F1010">
    
    
    <a href="index.php" class="logout-button">Log Out</a>
    <p><b>Welcome to the Online Voting System!</b></p>
    <h1>Please select the post for which you want to vote for. Thank you!!!</h1>
    
    

    

    <?php
    
    // PHP code for handling button clicks
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['president'])) {
            
            header("Location: president_voting.php");
            exit();
        } elseif (isset($_POST['prime_minister'])) {
            
            header("Location: prime_minister_voting.php");
            exit();
        } elseif (isset($_POST['mayor'])) {
            
            header("Location: mayor_voting.php");
            exit();
        }
    }

   
    ?>

    
    <div class="form-container">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="president" value="President" class="button">
            <input type="submit" name="prime_minister" value="Prime Minister" class="button">
            <input type="submit" name="mayor" value="Mayor" class="button">
        </form>
    </div>
    <div class="form-container">
        <img src="4419246-removebg-preview.png" alt="Image description" height:"100%" width:"100%">
    </div>
</body>

</html>
