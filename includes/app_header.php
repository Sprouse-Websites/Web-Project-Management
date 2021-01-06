<?php
include 'https://www.webprojectmanagement.site/includes/config.php';
include 'https://www.webprojectmanagement.site/includes/lang/index.php';
?>
<body>
	<header class="w3-bar">
		<div href="javascript:void(0);" class="w3-bar-item hidden">
		<img src="../../favicon.ico" alt="" height="40pt">
		<br>
		WPM
	</div>
		<a href="/app" class="w3-bar-item w3-button"><?php echo $lang['Home']; ?><i class="fas fa-home"></i></a>
		<a href="/app/projects" class="w3-bar-item w3-button"><?php echo $lang['Projects']; ?><i class="fas fa-tasks"></i></a>
		<a href="/app/clients" class="w3-bar-item w3-button"><?php echo $lang['Clients']; ?><i class="fas fa-users"></i></a>
		<a href="/app/settings" class="w3-bar-item w3-button"><?php echo $lang['Settings']; ?><i class="fas fa-cogs"></i></a>
		<?php
		if ($_SESSION['Username'] !== NULL) {
			echo "<a href=\"/logout.php\" class=\"w3-bar-item w3-button\">" . $lang['Logout'] . "<i class=\"fas fa-sign-out-alt\"></i></a>";
		} else {
			echo "<a href=\"/login.php\" class=\"w3-bar-item w3-button\">" . $lang['Login'] . "<i class=\"fas fa-sign-in-alt\"></i></a>";
		}
		?>
	</header>

	<main>
