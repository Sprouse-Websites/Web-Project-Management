<body>
	<header class="w3-bar">
		<div href="javascript:void(0);" class="w3-bar-item hidden">
		<img src="/webprojectmanagement/favicon.ico" alt="" height="40pt">
		<br>
		WPM
	</div>
		<a href="/webprojectmanagement/app" class="w3-bar-item w3-button">Home</a>
		<a href="/webprojectmanagement/app/projects" class="w3-bar-item w3-button">Projects</a>
		<a href="/webprojectmanagement/app/settings" class="w3-bar-item w3-button">Settings</a>
		<?php
		if ($_SESSION['wpm_login_user'] !== NULL) {
			echo "<a href=\"/webprojectmanagement/logout.php\" class=\"w3-bar-item w3-button\">Logout</a>";
		}
		?>
	</header>

	<main>
