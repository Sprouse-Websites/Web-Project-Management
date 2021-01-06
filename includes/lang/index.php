<?php
if ($_SESSION['lang'] === NULL || $_SESSION['lang'] == "" || $_SESSION['lang'] == "en") {
	$_SESSION['lang'] = "en-gb";
	include "https://www.webprojectmanagement.site/includes/lang/en-gb.lang.php";
}

// // Array of languages we support
$available_langs = array('en-gb');
echo "lang";

 ?>
