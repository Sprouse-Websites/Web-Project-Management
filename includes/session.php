<?php
// include '../config.php';
session_start();

// if ($link -> connect_errno) {
// 	echo "ERROR: Could not connect. " . mysqli_connect_errno() . mysqli_connect_error();
// 	exit();
// }

// $link -> real_query("SELECT Username FROM users WHERE Username = '$user_check';");

// if ($link -> field_count) {
// 	$result = $link -> store_result();
// 	$row = $result -> fetch_row();
// 	$result -> free_result();
// }

// $link -> close();
$URL = "$_SERVER[REQUEST_URI]";

// function ForceLogin() {
// 	echo "<script>window.location.href = '/webprojectmanagement/login.php?redirect=".$URL."';</script>";
// }


// echo $URL;
if ($URL !== "/webprojectmanagement/login.php") {
	if ($_SESSION['wpm_login_user'] == "") {
		ForceLogin();
	} elseif ($_SESSION['wpm_login_user'] == NULL) {
		ForceLogin();
	}
}


?>
