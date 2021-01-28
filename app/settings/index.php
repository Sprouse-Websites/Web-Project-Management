<?php
include '../../includes/privconfig.php';
include '../../includes/config.php';
$page_name = "Settings | WPM";
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';
?>
<script src="../../js/vtabs.js" charset="utf-8"></script>

</head>
<body>

	<h2>Settings</h2>

	<div class="tabs">
		<div class="vtab">
			<?php
			if ($_SESSION['Admin']) {
				echo "<button class=\"vtablinks\" onclick=\"openSetting(event, 'Admin')\" id=\"defaultOpen\">Admin</button>";
				echo "<button class=\"vtablinks\" onclick=\"openSetting(event, 'Account')\">Profile & Account</button>";
			} else {
				echo "<button class=\"vtablinks\" onclick=\"openSetting(event, 'Account')\" id=\"defaultOpen\">Profile & Account</button>";
			}
			?>
			<button class="vtablinks" onclick="openSetting(event, 'Appearance')">Appearance</button>
			<button class="vtablinks" onclick="openSetting(event, 'About')">About</button>
		</div>

		<div id="Admin" class="vtabcontent">
			<form method="POST" action="/create_customer_portal_session">
				<button type="submit">Manage billing</button>
				<label for="">Toggl Workspace ID</label>
				<input type="text" name="TogglWID" value="<?php echo $_SESSION['TogglWID'];?>">
			</form>
		</div>

		<div id="Account" class="vtabcontent">
			<h3>Profile & Account</h3>
			<p>Edit account and security details</p>
			<h4>Change Personal Details</h4>
			<?php // FIXME: Add Personal details form ?>

			<?php
			// echo "<tr>";
			// echo "<td>CompanyID</td>";
			// echo "<td>".$_SESSION['CompanyID']."</td>";
			// echo "</tr>";

			echo "<form action=\"chngPerDet.php\" method=\"post\">
			<label>Name</label>
			<br/>
			<input type=\"text\" name=\"\" value=\"".$_SESSION['FirstName']."\" style=\"width:50% !important;\"><input type=\"text\" name=\"\" value=\"".$_SESSION['LastName']."\" style=\"width:50% !important;\">
			<br>
			<label>Username</label>
			<input type=\"text\" name=\"\" value=\"".$_SESSION['Username']."\">
			<br/>
			<label>Company</label>
			".$_SESSION['CompanyID']."
			</form>";

			?>
			<hr>
			<h4>Change Password</h4>
			<form class="" action="chngPswd.php" method="post">
				<label for="">Current Password</label>
				<input type="password" id="pswd" name="pswd" oninput="validateNewPswd()">
				<br>
				<label for="">New Password</label>
				<input type="password" name="newpswd" id="newpswd" oninput="validateNewPswd()">
				<br>
				<label for="">Confirm New Password</label> <input type="password" id="cnfpswd" name="cnfpswd" oninput="validateNewPswd()">
				<br>
				<div id="chngPswdErrors">

				</div>
				<br>
				<input id="chngPswdSubmit" type="submit" value="Change Password" disabled>
			</form>
			<script type="text/javascript">

			$(document).ready(function() {
				$("#defaultOpen").trigger("click");
				$("#defaultOpen").addClass("active");
			});

			function validateNewPswd() {
				var pswd = document.getElementById("pswd");
				var newpswd = document.getElementById("newpswd");
				var cnfpswd = document.getElementById("cnfpswd");
				var pswderrorMessage = "";
				var pswdErrors = 0;
				var pswdCorrect = 0;
				if (pswd.value == newpswd.value) {
					pswderrorMessage = pswderrorMessage + "The old password and the new password can not match. ";
					pswdErrors++;
				}
				if (newpswd.value.length < 8) {
					pswderrorMessage = pswderrorMessage + "The new password is not long enough. ";
					pswdErrors++;
					console.log("Password not long enough");
				}
				var lowerCaseLetters = /[a-z]/g;
				if(newpswd.value.match(lowerCaseLetters)) {
					pswdCorrect++;
				} else {
					pswdErrors++;
					pswderrorMessage = pswderrorMessage + "The new password does not contain a lowercase letter. ";
					console.log("Password does not include lowercase");
				}
				var upperCaseLetters = /[A-Z]/g;
				if(newpswd.value.match(upperCaseLetters)) {
					pswdCorrect++;
				} else {
					pswdErrors++;
					pswderrorMessage = pswderrorMessage + "The new password does not contain an uppercase letter. ";
					console.log("Password not include uppercase");
				}
				var numbers = /[0-9]/g;
				if(newpswd.value.match(numbers)) {
					pswdCorrect++;
				} else {
					pswdErrors++;
					pswderrorMessage = pswderrorMessage + "The new password does not contain a number. ";
					console.log("Password not include numbers");
				}
				if (newpswd.value !== cnfpswd.value) {
					pswderrorMessage = pswderrorMessage + "The new password does not match the confirm password. ";
					pswdErrors++;
					console.log("New and Confirm do not match");
				}
				if (pswdErrors == 0) {
					document.getElementById("chngPswdSubmit").disabled = false;
					pswderrorMessage = "Password is suitable";
					document.getElementById("chngPswdErrors").style.color = "green";
				} else {
					document.getElementById("chngPswdSubmit").disabled = true;
					document.getElementById("chngPswdErrors").style.color = "red";
				}
				console.log(pswdErrors);
				document.getElementById("chngPswdErrors").innerHTML = pswderrorMessage;
			}
			</script>
		</div>

		<div id="Appearance" class="vtabcontent">
			<h3>Appearance</h3>
			<h4>Theme</h4>
			<form action="change.php" name="theme" method="post">
				<input type="hidden" name="form" value="Theme">
				<?php
				$sql = 'SELECT Theme, CompanyID FROM users WHERE UserID = ' . $_SESSION['UserID'];
				// echo $sql;
				if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							if ($row['Theme'] == "white") {
								echo '<label>
								<input type="radio" name="Theme" value="white" checked>
								<img src="https://placehold.it/60x60/fff/fff">
								</label>
								<label>
								<input type="radio" name="Theme" value="blue">
								<img src="http://placehold.it/60x60/01f/01f">
								</label>
								<label>
								<input type="radio" name="Theme" value="orange">
								<img src="http://placehold.it/60x60/e90/e90">
								</label>';
							} elseif ($row['Theme'] == "blue") {
								echo '<label>
								<input type="radio" name="Theme" value="white">
								<img src="https://placehold.it/60x60/fff/fff">
								</label>
								<label>
								<input type="radio" name="Theme" value="blue" checked>
								<img src="http://placehold.it/60x60/01f/01f">
								</label>
								<label>
								<input type="radio" name="Theme" value="orange">
								<img src="http://placehold.it/60x60/e90/e90">
								</label>';
							}
							elseif ($row['Theme'] == "orange") {
								echo '<label>
								<input type="radio" name="Theme" value="white">
								<img src="https://placehold.it/60x60/fff/fff">
								</label>
								<label>
								<input type="radio" name="Theme" value="blue">
								<img src="http://placehold.it/60x60/01f/01f">
								</label>
								<label>
								<input type="radio" name="Theme" value="orange" checked>
								<img src="http://placehold.it/60x60/e90/e90">
								</label>';
							} else {
								echo '<label>
								<input type="radio" name="Theme" value="white" required>
								<img src="https://placehold.it/60x60/fff/fff">
								</label>
								<label>
								<input type="radio" name="Theme" value="blue">
								<img src="http://placehold.it/60x60/01f/01f">
								</label>
								<label>
								<input type="radio" name="Theme" value="orange">
								<img src="http://placehold.it/60x60/e90/e90">
								</label>';
							}
						}
					}
				}
				?>

				<br>
				<input type="submit" value="Submit">
			</form>
			<hr>
			<h4>Language</h4>
			<form action="change.php" name="language" method="post">
				<input type="hidden" name="form" value="Lang">
				<?php
				$sql = 'SELECT Lang FROM users WHERE UserID = ' . $_SESSION['UserID'];
				// echo $sql;
				if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							if ($row['Lang'] == "en-gb") {
								echo "<select name=\"Lang\">
									<option value=\"en-gb\" selected>English (UK)</option>
									<option value=\"en-us\">English (US)</option>
								</select>";
							}
							if ($row['Lang'] == "en-us") {
								echo "<select name=\"Lang\">
									<option value=\"en-us\" selected>English (US)</option>
									<option value=\"en-gb\">English (UK)</option>
								</select>";
							}
						}
					}
				}
				?>


				<br>
				<input type="submit" value="Submit">
			</form>
		</div>

		<div id="About" class="vtabcontent">
			<h3>About</h3>
			<p>Web Project Management (WPM) is an <a href="https://github.com/Sprouse-Websites/Web-Project-Management/">open-source</a>, web-based project management system for website developers. It is available under the GNU General Public License v3.0.</p>

			Version <?php echo $WPMversion; ?>

			<h4>Credits</h4>
			<h5>Developers</h5>
			<textarea disabled rows="8" style="width:100%;">
				Joel Sprouse
			</textarea>
			<h5>Designers</h5>
			<textarea disabled rows="8" style="width:100%;">
				Joel Sprouse
			</textarea>

			<h4>How to support us</h4>
			<ul>
				<li>We are a Brave Verified Creator. This means you can support us just by using this site with the <a target="_blank" href="https://brave.com/">https://brave.com/</a></li>
			</ul>

			<h4>Connect With Us</h4>
			<a href="">
<img src="/fa-icons/brands/facebook.svg" alt="" height="35px">

			</a>
		</div>
	</div>
