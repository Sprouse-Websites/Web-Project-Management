<?php
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';


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

$sql = "INSERT INTO `clients` (`FirstName`,`MiddleNames`,`LastName`,`PhoneNumber1`,`PhoneNumber2`, `Email`,`Company`,`Notes`,`UserCompanyID`) VALUES ( '$_POST[FirstName]', '$_POST[MiddleNames]','$_POST[LastName]', '$_POST[PhoneNumber1]', '$_POST[PhoneNumber2]', '$_POST[Email]','$_POST[Company]', '$_POST[Notes]',  '$_SESSION[CompanyID]')";



if ($conn->query($sql) === TRUE) {
echo "<script type=\"text/javascript\"> window.location.replace(\"index.php\"); </script>";
}
else {
	echo "Data Failed to insert. Error Code: " . $sql . "<br>" . $conn->error;
}

$conn->close();
include '../../includes/footer.php';
include '../../includes/foot.php';


?>
