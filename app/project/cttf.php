<?php
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}


$sql = "INSERT INTO `logs` (`TaskID`, `Description`, `UserID`, `Started`, `Ended`) VALUES ($_POST[Task], '$_POST[description]', $_SESSION[UserID], '$_POST[Started]', '$_POST[Ended]')";



if ($conn->query($sql) === TRUE) {
	echo "New log created successfully";
	// header("Location: index.php?id=".$_POST[project]);
	echo "<script type=\"text/javascript\"> window.location.replace(\"index.php?id=$_POST[project]\"); </script>";
} else {
	// echo "We seem to have an issue. Please try calling instead and let us know you've had an issue. Sorry for any inconvenice.";
	echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
