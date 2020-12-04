<?php
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';

// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

$_SESSION['TaskName'] = $_POST['task'];
$_SESSION['TaskDescription'] = $_POST['description'];
$_SESSION['Duration'] = $_POST['Duration'];
$_SESSION['colour'] = $_POST['colour'];
$_SESSION['project'] = $_POST['project'];
$_SESSION['TaskPhase'] = $_POST['TaskPhase'];

if ($_POST[Duration] == NULL) {
	$sql = "INSERT INTO `tasks` (`TaskName`, `Description`, `TaskPhase`, `CompanyID`, `ProjectId`) VALUES ('$_POST[task]', '$_POST[description]', '$_POST[TaskPhase]', '$_SESSION[CompanyId]'), $_POST[project]";
} else {
	$sql = "INSERT INTO `tasks` (`TaskName`, `Description`, `TaskPhase`, `CompanyID`, `ProjectId`, `Duration`) VALUES ('$_POST[task]', '$_POST[description]', '$_POST[TaskPhase]', '$_SESSION[CompanyId]', $_POST[project], $_POST[Duration])";
}



if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		header("Location: index.php");
} else {
		// echo "We seem to have an issue. Please try calling instead and let us know you've had an issue. Sorry for any inconvenice.";
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
