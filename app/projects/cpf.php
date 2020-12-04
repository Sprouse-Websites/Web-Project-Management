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

$sql = "INSERT INTO `Projects` (`ProjectName`,`UsrCompId`, `Colour`,`DateCreated`,`DateModified`) VALUES ('{$_SESSION[project]}', 1, '{$_SESSION[color]}', '$timestamp', '$timestamp')";



if ($conn->query($sql) === TRUE) {
	try {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.toggl.com/api/v8/me');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		curl_setopt($ch, CURLOPT_USERPWD, 'joel.sprouse11@gmail.com' . ':' . 'secret');

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, 'https://www.toggl.com/api/v8/projects');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"project\":{\"name\":\"".$_SESSION["project"]."\",\"wid\":4509272,\"is_private\":false,\"cid\":123397,\"color\":1}}");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_USERPWD, '1971800d4d82861d8f2c1651fea4d212' . ':' . 'api_token');

		$headers = array();
		$headers[] = 'Content-Type: application/json';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		echo "New Project added successfully";
		echo "<a href='index.php'>Go back</a>";
	} catch (\Exception $e) {
		echo "Toggl Project not created";
	}

}
else {
	echo "Data Failed to insert. Error Code: " . $sql . "<br>" . $conn->error;
}

$conn->close();
include '../../includes/footer.php';
include '../../includes/foot.php';


?>
