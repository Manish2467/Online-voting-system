<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$candidateName = $_POST['name'];
$candidatePhoto = $_FILES['photo']['name'];
$candidatePosition = $_POST['position'];

//Move uploaded photo to a specific directory 
$targetDir = "image/";
$targetFile = $targetDir . basename($_FILES["photo"]["name"]);
move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);
if (isset($_POST['img_submit'])) {
  $temp_img_name = $_FILES['img_upload']['name'];
  $temp_img_name = $_FILES['img_upload']['tmp_name'];
  move_uploaded_file($temp_img_name, $img_name);
}



// Insert candidate into the database
$sql = "INSERT INTO candidates (name,position,image) VALUES ('$candidateName',  '$candidatePosition','$candidatePhoto')";
if ($conn->query($sql) === TRUE) {
  $message = "candidate added successfully!!!";

  echo '<script type="text/javascript">';
  echo 'alert("' . $message . '");';
  echo 'window.location.href = "admin.php";'; // Replace "user.php" with the desired page URL
  echo '</script>';
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>