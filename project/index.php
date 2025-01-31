<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted email and password
    $email = $_POST['email'];
    $submittedPassword = $_POST['password'];

    // Check if it's admin login
    if ($email === 'admin' && $submittedPassword === 'admin') {
        // Redirect to the admin page
        header('Location: admin.php');
        exit;
    } else {
       
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "voting";

        
        $conn = new mysqli($servername, $username, $password, $dbname);

        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $query = "SELECT * FROM user WHERE email='$email' AND password='$submittedPassword'";
        $result = $conn->query($query);

        // Check if any rows are returned
        if ($result && $result->num_rows > 0) {
            // Valid user credentials, redirect to the user page
            header('Location: user.php');
            exit;
        } else {
            // Invalid email or password, redirect back to the login page with an error flag
            header('Location: index.php?error=1');
            exit;
        }
    }
}

?>


<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>login</title>
    <script src="login.js"></script>
    <style>
       
        * {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        h1 {
            color: #62B246;
            text-align: center;
            margin-top: 60px;
            font-size: 70px;
        }

        h2 {
            color: white;
            font-size: 40px;
            text-align: center;
        }

        .login {
            margin-left: 100px;
            margin-top: 150px;
        }

        h5 {
            color: white;
            font-size: 15px;
            margin-bottom: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
        }

        b {
            color: #4CAF50;
        }

        p {
            color: white;
            size: 20px;
            text-align: center;
            margin-top: 15px;
        }

        .image {
            margin-left: 12%;
        }

        .main {
            display: flex;
            flex-direction: row;
        }

        a:link {
            color: red;
            background-color: transparent;
            text-decoration: solid white;
        }

        a:hover {
            color: #4CAF50;
            background-color: transparent;
            text-decoration: none;
        }

        .login-submit {
            width: 430px;
            height: 40px;
            background: #4CAF50;
            transition: background-color 0.3s ease;
        }

        .login-submit:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body bgcolor="#0F1010">
    <h1>Voting System</h1><br><br>
    <div class="main">
        <div class="image">
            <img src="4116834-removebg.png" width="800px" height="800px">
        </div>
        <div class="login">
            <h2>Welcome Back</h2><br><br>

            <form name="myform" action="" method="POST" onsubmit="return formvalidate()">
                <h5>Email</h5>
                <input name="email" placeholder="Email" type="text" required style="height:40px; margin-bottom: 30px; "
                    size="60">
                <h5>Password</h5>
                <input name="password" placeholder="****" type="password" required
                    style="height:40px ; margin-bottom: 10px; " size="60"><br>
                <input type="submit" value="Continue" class="login-submit"
                    style="height:40px ; margin-bottom: 10px; " size="60">
                <p>Don't have an account? <a href="register.php">Register now</a></p>
            </form>
            <?php
            if (isset($_GET['error'])) {
                echo '<p>Invalid username or password.</p>';
            }
            ?>
        </div>
    </div>
    <footer>
        <p>© 2023 Online Voting System</p>
    </footer>
    <script>
      
        var submitButton = document.querySelector('.login-submit');
        submitButton.addEventListener('mouseover', function () {
            this.style.backgroundColor = '#45a049';
        });
        submitButton.addEventListener('mouseout', function () {
            this.style.backgroundColor = '#4CAF50';
        });
    </script>
</body>

</html>
