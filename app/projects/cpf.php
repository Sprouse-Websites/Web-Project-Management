<?php
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';

$_SESSION["project"] = $_POST["project"];
$_SESSION["client"] = $_POST["client"];
$_SESSION["clientname"] = $_POST["clientname"];
$clientname = $_POST["clientname"];
$_SESSION["color"] = $_POST["color"];
$timestamp = date("Y-m-d H:i:s");

// Convert Long Strings
// $comments = htmlentities($_SESSION['comments']);

if ($_SESSION["client"] == "New") {
	$client = $_SESSION["clientname"];
}


// Check connection
if ($conn->connect_error) {
	echo "Connection failed: " . $conn->connect_error;
}

$sql = "INSERT INTO `projects` (`ProjectName`,`ProjectKey`,`CompanyId`, `Colour`,`ProjectPhase`,`ProjectState`) VALUES ('{$_SESSION[project]}', '$_POST[projectkey]', '$_SESSION[CompanyId]', '{$_SESSION[color]}','$_POST[projectphase]','$_POST[projectstate]')";



if ($conn->query($sql) === TRUE) {
// FIXME: create project folder
	header("Location: index.php");
}
else {
	echo "Data Failed to insert. Error Code: " . $sql . "<br>" . $conn->error;
}

$conn->close();
include '../../includes/footer.php';
include '../../includes/foot.php';


?>
