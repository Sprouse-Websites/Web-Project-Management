<?php
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';


// Check connection
if ($conn->connect_error) {
	echo "Connection failed: " . $conn->connect_error;
}

$sql = "UPDATE `users` SET Theme=\"$_POST[Theme]\" WHERE UserID = " . $_SESSION['UserID'] . ";";



if ($conn->query($sql) === TRUE) {
	echo "<script type=\"text/javascript\"> window.location.replace(\"https://www.webprojectmanagement.site/app/settings/\"); </script>";
}
else {
	echo "Data Failed to insert. Error Code: " . $sql . "<br>" . $conn->error;
}

$conn->close();
include '../../includes/footer.php';
include '../../includes/foot.php';


?>
