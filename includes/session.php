<?php
$URL = "$_SERVER[REQUEST_URI]";

if (strpos($URL, 'login.php') === false) {
	// Not login page
	if ($_SESSION['Username'] === NULL) {
		// Not Logged in
		echo "<script type=\"text/javascript\">
		window.location.replace(\"https://www.webprojectmanagement.site/login.php?url=$URL\");
		</script>";
		exit;
	}
}


?>
