<?php
session_start();
include '../includes/config.php';
include '../includes/session.php';
include '../includes/head.php';
include '../includes/app_header.php';

$_SESSION["project"] = $_POST["project"];
$_SESSION["client"] = $_POST["client"];
$_SESSION["color"] = $_POST["color"];
$timestamp = date("Y-m-d H:i:s");

// Convert Long Strings
// $comments = htmlentities($_SESSION['comments']);


// Create connection
$conn = mysqli_connect(db_server, db_username, db_password, db_database);

// Check connection
if ($conn->connect_error) {
echo "Connection failed: " . $conn->connect_error;
}

$sql = "INSERT INTO `projects` (`ProjectName`,`CompanyId`, `Client`,`Colour`,`DateCreated`,`DateModified`) VALUES ('{$_SESSION[project]}', 1, '{$_SESSION[client]}', '{$_SESSION[color]}', '$timestamp', '$timestamp')";



if ($conn->query($sql) === TRUE) {
echo "New Project added successfully";
echo "<a href='index.php'>Go back</a>";
}
else {
echo "Data Failed to insert. Error Code: " . $sql . "<br>" . $conn->error;
}

$conn->close();
include '../includes/footer.php';
include '../includes/foot.php';


?>
