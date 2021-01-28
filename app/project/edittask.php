<?php
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

if ($_POST['type'] == "edit") {
	$sql = "UPDATE `tasks` SET `TaskName` = '$_POST[task]', `Description` = '$_POST[description]', `TaskPhase` = '$_POST[TaskPhase]', `CompanyID` = $_SESSION[CompanyID], `Duration` = '$_POST[Duration]' WHERE `TaskID` = $_POST[taskID];";

	if ($conn->query($sql) === TRUE) {
		echo "Task Updated successfully";
		echo "<script type=\"text/javascript\"> window.location.replace(\"index.php?id=$_POST[project]\"); </script>";
	} else {
		// echo "We seem to have an issue. Please try calling instead and let us know you've had an issue. Sorry for any inconvenice.";
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
} elseif ($_POST['type'] == "new") {
	$tempTblSQL = "SELECT count(*) + 1 as seq FROM tasks WHERE ProjectID = ".$_POST['project'].";";

	$tempResult = mysqli_query($link, $tempTblSQL);
	$tempOutput = mysqli_fetch_array($tempResult);

	if ($_POST[Duration] == NULL) {
		$sql = "INSERT INTO `tasks` (`TaskName`, `Description`, `TaskPhase`, `CompanyID`, `ProjectId`, `TimeTracked`, `TaskProjectID`) VALUES ('$_POST[task]', '$_POST[description]', '$_POST[TaskPhase]', $_SESSION[CompanyID], '$_POST[project]', 0, $tempOutput[seq])";
	} else {
		$sql = "INSERT INTO `tasks` (`TaskName`, `Description`, `TaskPhase`, `CompanyID`, `ProjectId`, `Duration`, `TimeTracked`, `TaskProjectID`) VALUES ('$_POST[task]', '$_POST[description]', '$_POST[TaskPhase]', $_SESSION[CompanyID], '$_POST[project]', $_POST[Duration], 0, $tempOutput[seq])";
	}

	if ($conn->query($sql) === TRUE) {
		echo "New task created successfully";
		echo "<script type=\"text/javascript\"> window.location.replace(\"index.php?id=$_POST[project]\"); </script>";
	} else {
		// echo "We seem to have an issue. Please try calling instead and let us know you've had an issue. Sorry for any inconvenice.";
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

}

$conn->close();
