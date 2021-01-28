<?php
session_start();
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';

$_SESSION["project"] = $_POST["project"];
$_SESSION["client"] = $_POST["client"];
$_SESSION["color"] = $_POST["color"];
$timestamp = date("Y-m-d H:i:s");

// Convert Long Strings
// $comments = htmlentities($_SESSION['comments']);


// Check connection
if ($conn->connect_error) {
	echo "Connection failed: " . $conn->connect_error;
}

$sql = "DELETE FROM `projects` WHERE `ProjectID` = ".$_GET['id'].";";



if ($conn->query($sql) === TRUE) {
	echo "Project deleted successfully";
	echo "<a href='../projects'>Go back</a>";
}
else {
	echo "Data Failed to insert. Error Code: " . $sql . "<br>" . $conn->error;
}

$conn->close();
include '../../includes/footer.php';
include '../../includes/foot.php';


?>
