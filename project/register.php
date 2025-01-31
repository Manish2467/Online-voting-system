<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Now</title>
    <style>
        
        * {
            margin: 0px;
            padding: 0px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            display: flex;
            flex-direction: row;
            color: white;
        }

        .register {
            margin-left: 100px;
            margin-top: 150px;
        }

        .image {
            margin-left: 12%;
        }

        h1 {
            color: #62B246;
            text-align: center;
            margin-top: 60px;
            font-size: 70px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            margin-top: 5px;
        }

        h2 {
            margin-bottom: 5px;
            text-align: center;
        }

        h4 {
            margin-bottom: 5px;
        }

        p {
            margin-top: 10px;
            text-align: center;
        }

        a:link {
            color: green;
            background-color: transparent;
            text-decoration: solid green;
        }

        a:hover {
            color: #4CAF50;
            background-color: transparent;
            text-decoration: none;
        }
    </style>
</head>

<body bgcolor="#0F1010">
    <script type="text/javascript">
        // JavaScript form validation function
        function formvalidate() {
            var x = document.forms["myform"]["email"].value;
            var y = document.forms["myform"]["username"].value;
            var z = document.forms["myform"]["password"].value;

            if (x == "") {
                alert("Please enter your email.");
                return false;
            } else if (y == "") {
                alert("Please enter a valid username");
                return false;
            } else if (z.length < 8 || z == "") {
                alert("Please enter a valid password with at least 8 characters");
                return false;
            }
        }
    </script>
    <h1>Voting System</h1>
    <div class="container">
        <div class="image">
            <img src="4116834-removebg.png" width="800px" height="800px">
        </div>
        <div class="register">
            <h2>Create an account</h2>
            <form name="myform" onsubmit="return formvalidate()" action="store_registration.php" method="POST">
                <h4>Email</h4>
                <input type="email" name="email" id="email" placeholder="Email"
                    style="height:40px; margin-bottom: 30px;" size="60">
                <h4>Username</h4>
                <input type="text" name="username" id="username" placeholder="Username"
                    style="height:40px; margin-bottom: 30px;" size="60">
                <h4>Password</h4>
                <input type="password" name="password" id="password" placeholder="********"
                    style="height:40px; margin-bottom: 30px;" size="60">
                <h4>Citizenship Number</h4>
                <input type="text" name="citizenship" id="citizenship" placeholder="00-00-00-00000"
                    style="height:40px; margin-bottom: 30px;" size="60">
                <h4>I am</h4>
                <input type="radio" id="male" name="gender" value="Male">
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="Female">
                <label for="female">Female</label><br>
                <button type="submit" class="btn btn-primary" style="width: 457px; height: 40px;">Continue</button>
            </form>
            <h5>By continuing you agree to our Terms & Conditions and Privacy Policy</h5>
            <p>Login to your account <b><a href="index.php">Click Here</a></b></p>
        </div>
    </div>
</body>

</html>