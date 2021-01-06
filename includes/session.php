<?php
$URL = "$_SERVER[REQUEST_URI]";


// echo $URL;
if (strpos($URL, 'login.php') === false) {
	echo "Not login page ";
	if ($_SESSION['Username'] === NULL) {
		echo "Not Logged in ";
		echo "<script type=\"text/javascript\">
		window.location.replace(\"https://www.webprojectmanagement.site/login.php\");
		</script>";
		exit;
	}
}


?>
