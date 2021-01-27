<?php
include 'includes/config.php';
?>
<body>
	<header class="w3-bar">
		<div href="javascript:void(0);" class="w3-bar-item hidden">
			<img src="../../favicon.ico" alt="" height="40pt">
			<br>
			WPM
		</div>
		<a href="/app" class="navbar-item">
			<img src="/fa-icons/solid/home.svg" alt="<?php echo $lang['Home']; ?>" height="30px">
		</a>
		<a href="/app/projects" class="navbar-item">
			<img src="/fa-icons/solid/tasks.svg" alt="<?php echo $lang['Projects']; ?>" height="30px">
		</a>
		<a href="/app/clients" class="navbar-item">
			<img src="/fa-icons/solid/users.svg" alt="<?php echo $lang['Clients']; ?>" height="30px">
		</a>
		<a href="/app/organisation" class="navbar-item">
			<img src="/fa-icons/solid/sitemap.svg" alt="<?php echo $lang['Organisation']; ?>" height="30px">
		</a>
		<div class="w3-dropdown-hover" style="right: 0; position: absolute;">
			<div class="w3-button" style="font-size:16px;">
				<?php echo $_SESSION['Username'] ?>
				<img src="/fa-icons/solid/caret-down.svg" height="30px">
			</div>
			<div class="w3-dropdown-content w3-bar-block w3-card-4" style="right:0">
				<a href="/app/settings" class="navbar-item">
					<img src="/fa-icons/solid/cogs.svg" height="30px">
					<?php echo $lang['Settings']; ?>
				</a>
				<?php
				if ($_SESSION['Username'] !== NULL) {
					echo "<a href=\"/logout.php?url=$URL\" class=\"navbar-item\"><img src=\"/fa-icons/solid/sign-out-alt.svg\" alt=\"\" height=\"30px\">" . $lang['Logout'] . "</a>";
				} else {
					echo "<a href=\"/login.php?url=$URL\" class=\"navbar-item\"><img src=\"/fa-icons/solid/sign-in-alt.svg\" alt=\"\" height=\"30px\">" . $lang['Login'] . "</a>";
				}
				?>
			</div>
		</div>


	</header>

	<main>
