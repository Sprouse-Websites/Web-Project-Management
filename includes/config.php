<?php
session_start();
include 'includes/privconfig.php';
include '../includes/privconfig.php';
include '../../includes/privconfig.php';
include '../../../includes/privconfig.php';
include 'https://www.webprojectmanagement.site/includes/lang/index.php';

$URL = "$_SERVER[REQUEST_URI]";

// echo $URL;
if (strpos($URL, 'localhost') === true) {
	echo "Do not use this site. Please goto <a href=\"https://www.webprojectmanagement.site\">https://www.webprojectmanagement.site</a>";
}

$webRoot = "/"; // The location of the files on the server.

date_default_timezone_set("Europe/London");

$WPMversion = "Alpha 0.2.5";

?>
