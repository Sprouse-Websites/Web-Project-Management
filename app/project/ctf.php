<?php
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';

// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}


if ($_POST[Duration] == NULL) {
	$sql = "INSERT INTO `tasks` (`TaskName`, `Description`, `TaskPhase`, `CompanyID`, `ProjectId`) VALUES ('$_POST[task]', '$_POST[description]', '$_POST[TaskPhase]', $_SESSION[CompanyId], '$_POST[project]')";
} else {
	$sql = "INSERT INTO `tasks` (`TaskName`, `Description`, `TaskPhase`, `CompanyID`, `ProjectId`, `Duration`) VALUES ('$_POST[task]', '$_POST[description]', '$_POST[TaskPhase]', $_SESSION[CompanyId], '$_POST[project]', $_POST[Duration])";
}



if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		header("Location: index.php?id=".$_POST[project]);
} else {
		// echo "We seem to have an issue. Please try calling instead and let us know you've had an issue. Sorry for any inconvenice.";
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
