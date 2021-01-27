<?php
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';

$_SESSION["project"] = $_POST["project"];
$_SESSION["clientname"] = $_POST["clientname"];
$clientname = $_POST["clientname"];
$_SESSION["color"] = $_POST["color"];
$timestamp = date("Y-m-d H:i:s");

$error = 0;

// Convert Long Strings
$description = htmlentities($_POST['description']);

if ($_POST["client"] == "New") {
	$client = $_SESSION["clientname"];
}


// Check connection
if ($conn->connect_error) {
	$error++;
	echo "Connection failed: " . $conn->connect_error;
}

$sql = "INSERT INTO `projects` (`ProjectName`,`ProjectKey`,`CompanyID`, `Colour`,`ProjectPhase`,`ProjectState`,`Description`,`ClientID`) VALUES ('{$_SESSION[project]}','$_POST[projectkey]','$_SESSION[CompanyID]','{$_SESSION[color]}','$_POST[projectphase]','$_POST[projectstate]','$description',$_POST[client])";


if ($conn->query($sql) === FALSE) {
	echo "Data Failed to insert. Error Code: " . $sql . "<br>" . $conn->error;
	$error++;
}

$conn->close();

// FIXME: create project folder

// TOGGL

// if ($_SESSION['Toggl'] == TRUE) {
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.toggl.com/api/v8/projects');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"project\":{\"name\":\"".$_SESSION['project']."\",\"wid\":".$_SESSION['TogglWID'].",\"is_private\":false}}");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERPWD, $_SESSION['TogglAPI'] . ':' . 'api_token');

$headers = array();
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
	echo 'Error:' . curl_error($ch);
	$error++;
}
$resArr = json_decode($result);
curl_close ($ch);
echo "echo ". $result;
echo $resArr['name'];
print_r($resArr);

// All user data exists in 'data' object
$user_data = $resArr->data;

// Traverse array and print employee data
foreach ($user_data as $user) {
	echo "id: ".$user->id;
	echo "<br />";
	echo "name: ".$user->name;
	echo "<br />";
}

echo "VAR Dump";
$errors = curl_error($ch);
$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
var_dump($errors);
var_dump($response);
// }

echo "Error int: ".$error;
if ($error != 1) {
	// echo "<script type=\"text/javascript\"> window.location.replace(\"index.php\"); </script>";
}


include '../../includes/footer.php';
include '../../includes/foot.php';


?>
