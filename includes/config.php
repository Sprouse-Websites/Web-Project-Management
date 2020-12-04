<?php
// echo "Config"; // For Dedugging Purposes

// $link = mysqli_connect("localhost:8080", "wpm", "@lAs45678", "wpm");
// $connectDB = "lh8080";
// if ($link === false) {
$link = mysqli_connect("localhost", "wpm", "@lAs45678", "wpm");
$conn = new mysqli("localhost", "wpm", "@lAs45678", "wpm");
$connectDB = "lhwpm";
// } elseif ($link === false) {
// 	$link = mysqli_connect("localhost", "webprent_sproj", "3Js&D@9Tr", "webprent_WPM");
// 	$connectDB = "webPrent";
// }
if ($link === false) {
	$link = "All Failed"; // For Dedugging Purposes
	echo "ERROR: Could not connect. " . mysqli_connect_error();
}
// echo $connectDB;

// define('JiraAPIToken', '1lcobZ5dLIt2GVtUiFfS6A47');

// date_default_timezone_set("Europe/London");

// if ($_SESSION['lang'] == NULL) {
// 	$_SESSION['lang'] = "en-gb";
// 	// include "../includes/lang/en-gb.lang.php";
// }
//
// if ($_SESSION['lang'] == "") {
// 	$_SESSION['lang'] = "en-gb";
// 	// include "../includes/lang/en-gb.lang.php";
// }
//
// if ($_SESSION['lang'] == "en") {
// 	$_SESSION['lang'] = "en-gb";
// 	// include "../includes/lang/en-gb.lang.php";
// }
//
// // What languages do we support
// $available_langs = array('en-gb','en-us','fr','de');
//
// if(isset($_GET['lang']) && $_GET['lang'] != ''){
// 	// check if the language is one we support
// 	if(in_array($_GET['lang'], $available_langs)) {
// 		$_SESSION['lang'] = $_GET['lang']; // Set session
// 	}
// } else {
// 	$_SESSION['lang'] = "en-gb";
// 	include "../includes/lang/en-gb.lang.php";
// }

$WPMversion = "Alpha 0.2";

?>
