<?php
require "includes/config.php";
require "includes/session.php";
$error = "";
$page_name = "Login";
include 'includes/head.php';

// username and password sent from form
$myusername = $_POST['username'];
$mypassword = $_POST['password'];

$sql = "SELECT * FROM users WHERE Username = '$myusername' AND Password = '$mypassword';";
$result = mysqli_query($link,$sql);
if (mysqli_connect_errno()){
	$error = "Failed to connect to MySQL: " . mysqli_connect_error();
}
if (mysqli_num_rows($result) == 1) {
	$row = mysqli_fetch_array($result);
	// $active = $row['active'];
	$_SESSION['CompanyID'] = $row['CompanyID'];
	$_SESSION['UserID'] = $row['UserID'];
	$_SESSION['FirstName'] = $row['FirstName'];
	$_SESSION['LastName'] = $row['LastName'];
	$_SESSION['Username'] = $row['Username'];
	$_SESSION['Lang'] = $row['Lang'];
	$timestamp = date("Y-m-d h:i:s");
	$sql = "UPDATE `users` SET `LastLogin`='$timestamp' WHERE `Username` = '$_SESSION[Username]'";
	mysqli_query($link,$sql);
	if ($_GET['url'] == "") {
		$echo = "<script type=\"text/javascript\">
		window.location.replace(\"https://www.webprojectmanagement.site/app\");
		</script>";
	} else {
		$echo = "<script type=\"text/javascript\">
		window.location.replace(\"https://www.webprojectmanagement.site".$_GET['url']."\");
		</script>";
	}

	echo $echo;
} else {
	$sql = "SELECT * FROM users WHERE Username = '$myusername';";
	// echo $sql;
	$result = mysqli_query($link,$sql);
	if (mysqli_num_rows($result) > 0) {
		$error = "Wrong Password for this account";
	} else {
		if ($myusername == "") {
			// code...
		} else {
			$error = "There is no account with this username on this server.";
		}

	}
}

$sql = "SELECT * FROM companies where CompanyID = ".$_SESSION['CompanyID'].";";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);
$_SESSION['AdminID'] = $row['AdminID'];
if ($_SESSION["UserID"] == $_SESSION["AdminID"]) {
	$_SESSION['Admin'] = true;
}
$_SESSION['TogglAPI'] = $row['TogglAPI'];
$_SESSION['TogglWID'] = $row['TogglWID'];
if ($_SESSION['TogglWID'] !== NULL) {
	$_SESSION['Toggle'] = True;
}

?>

<style type = "text/css">
body {
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
}

.login {
	width: 400px;
	background-color: #ffffff;
	box-shadow: 0 0 9px 0 rgba(0, 0, 0, 0.3);
	margin: 100px auto;
}

.login h1 {
	text-align: center;
	color: #5b6574;
	font-size: 24px;
	padding: 20px 0 20px 0;
	border-bottom: 1px solid #dee0e4;
}

.login form {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	padding-top: 20px;
}

.login form label {
	display: flex;
	justify-content: center;
	align-items: center;
	width: 50px;
	height: 50px;
	background-color: #3274d6;
	color: #ffffff;
}

.login form input[type="password"],
.login form input[type="text"] {
	width: 310px;
	height: 50px;
	border: 1px solid #dee0e4;
	margin-bottom: 20px;
	padding: 0 15px;
}

.login form input[type="submit"] {
	width: 100%;
	padding: 15px;
	margin-top: 20px;
	background-color: #3274d6;
	border: 0;
	cursor: pointer;
	font-weight: bold;
	color: #ffffff;
	transition: background-color 0.2s;
}

.login form input[type="submit"]:hover {
	background-color: #2868c7;
	transition: background-color 0.2s;
}
</style>

<body>

	<div align = "center">
		Please Login
		<div style="width:300px; border: solid 1px #333333; " align = "left">
			<div style = "background-color:#3333ee; color:#FFFFFF; padding:3px;"><b>Login</b></div>

			<div style = "margin:30px">

				<form action="login.php?url=<?php echo $_GET[url]; ?>" method="post">
					<label for="username">
						<i class="fas fa-user"></i>
					</label>
					<input type="text" name="username" placeholder="Username" id="username" required>
					<label for="password">
						<i class="fas fa-lock"></i>
					</label>
					<input type="password" name="password" placeholder="Password" id="password" required>
					<input type="submit" value="Login">
				</form>

				<div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error;?></div>

				<div id="" class="" style="">
					Don't have an account? <a href="signup">Signup Here</a>
				</div>

			</div>

		</div>

	</div>

	<?php
	include 'includes/footer.php';
	include 'includes/foot.php';
	?>
