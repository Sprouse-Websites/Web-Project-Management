<?php
$page_name = "Projects | WPM";
include '../../includes/privconfig.php';
include '../../includes/config.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';
include '../../includes/auto-text-colour.php';
include 'new.php';
?>
<style media="screen">
tr {
	height: 40pt;
}

.progress-contatiner {
    width: 100%;
    background-color: #ddd;
    text-align: center;
    height: 40pt;
    /* display: flex; */
}

.progress-bar {
    color: white;
    background-color: green;
    height: 100%;
}
</style>
<script src="../../js/tabs.js" charset="utf-8"></script>


<div class="tabs">
	<div class="tab">
		<button class="tablinks active" onclick="openTab(event, 'Active')" id="defaultOpen">Active</button>
		<button class="tablinks" onclick="openTab(event, 'On Hold')">On Hold</button>
		<button class="tablinks" onclick="openTab(event, 'Complete')">Complete</button>
	</div>


	<div id="Active" class="tabcontent active">
		<?php
		$sql = 'SELECT * FROM projects WHERE CompanyID = ' . $_SESSION['CompanyID'] . ' AND ProjectState = "Active";';
		// echo $sql; // For Dedugging Purposes
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) > 0){
				echo "<table class=\"no-borders\" cellspacing=\"0\" cellpadding=\"0\" id=\"ProjectsTable\" width=\"100%\">";
				echo "<thead>";
				echo "<th onclick=\"sortTableByKey()\" title=\"Unique Project ID code\">Key</th>";
				echo "<th onclick=\"sortTableByProject()\">Project Name</th>";
				echo "<th>Description</th>";
				echo "<th onclick=\"sortTableByClient()\">Client</th>";
				// echo "<th onclick=\"sortTableByProgress()\">Progress</th>";
				echo "</thead>";
				echo "<tbody>";
				while($row = mysqli_fetch_array($result)){
					$idInt = (int)$row['ProjectID'];
					$Colour = $row['Colour'];
					if ($row['Colour'] == NULL) {
						$Colour = "white";
						echo "<tr class=\"row-hover-opaque  auto-text-colour\" style=\"background-color:".$Colour.";\">";
					} else {
						echo "<tr class=\"row-hover-opaque  auto-text-colour\" style=\"background-color:".$Colour.";\">";
					}

					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['ProjectKey']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['ProjectName']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['Description']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">";
					$sql3 = "SELECT * FROM clients WHERE ClientID = ".$row['ClientID'];
					$result3 = mysqli_query($link, $sql3);
					$client = mysqli_fetch_array($result3);
					echo $client['Company'];
					echo "</a></td>";

					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
			}
		} else {
			echo "ERROR: Was not able to execute SQL: " . $sql . ".";
			echo "<br/>";
			echo mysqli_error($link);

			echo (string)$link; // For Dedugging Purposes
		}

		?>
	</div>

	<script type="text/javascript">
	openTab(event, 'Active');
	</script>

	<div id="On Hold" class="tabcontent">
		<?php
		$sql = 'SELECT * FROM projects WHERE CompanyID = ' . $_SESSION['CompanyID'] . ' AND ProjectState = "On Hold";';
		// echo $sql; // For Dedugging Purposes
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) > 0){
				echo "<table class=\"no-borders\" cellspacing=\"0\" cellpadding=\"0\" id=\"ProjectsTable\" width=\"100%\">";
				echo "<thead>";
				echo "<th onclick=\"sortTableByKey()\" title=\"Unique Project ID code\">Key</th>";
				echo "<th onclick=\"sortTableByProject()\">Project Name</th>";
				echo "<th>Description</th>";
				echo "<th onclick=\"sortTableByClient()\">Client</th>";
				// echo "<th onclick=\"sortTableByProgress()\">Progress</th>";
				echo "</thead>";
				echo "<tbody>";
				while($row = mysqli_fetch_array($result)){
					$idInt = (int)$row['ProjectID'];
					$Colour = $row['Colour'];
					if ($row['Colour'] == NULL) {
						$Colour = "white";
						echo "<tr class=\"row-hover-opaque  auto-text-colour\" style=\"background-color:".$Colour.";\">";
					} else {
						echo "<tr class=\"row-hover-opaque  auto-text-colour\" style=\"background-color:".$Colour.";\">";
					}

					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['ProjectKey']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['ProjectName']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['Description']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">";
					$sql3 = "SELECT * FROM clients WHERE ClientID = ".$row['ClientID'];
					$result3 = mysqli_query($link, $sql3);
					$client = mysqli_fetch_array($result3);
					if ($client['Company'] === NULL && $client['Company'] == "") {
						echo $client['FirstName']." ".$client['LastName'];
					} else {
						$client['Company'];
					}
					echo "</a></td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
			}
		} else {
			echo "ERROR: Was not able to execute SQL: " . $sql . ".";
			echo "<br/>";
			echo mysqli_error($link);

			echo (string)$link; // For Dedugging Purposes
		}

		?>
	</div>
	<div id="Complete" class="tabcontent">
		<?php
		$sql = 'SELECT * FROM projects WHERE CompanyID = ' . $_SESSION['CompanyID'] . ' AND ProjectState = "Complete";';
		// echo $sql; // For Dedugging Purposes
		if($result = mysqli_query($link, $sql)){
			if(mysqli_num_rows($result) > 0){
				echo "<table class=\"no-borders\" cellspacing=\"0\" cellpadding=\"0\" id=\"ProjectsTable\" width=\"100%\">";
				echo "<thead>";
				echo "<th onclick=\"sortTableByKey()\" title=\"Unique Project ID code\">Key</th>";
				echo "<th onclick=\"sortTableByProject()\">Project Name</th>";
				echo "<th>Description</th>";
				echo "<th onclick=\"sortTableByClient()\">Client</th>";
				// echo "<th onclick=\"sortTableByProgress()\">Progress</th>";
				echo "</thead>";
				echo "<tbody>";
				while($row = mysqli_fetch_array($result)){
					$idInt = (int)$row['ProjectID'];
					$Colour = $row['Colour'];
					if ($row['Colour'] == NULL) {
						$Colour = "white";
						echo "<tr class=\"row-hover-opaque  auto-text-colour\" style=\"background-color:".$Colour.";\">";
					} else {
						echo "<tr class=\"row-hover-opaque  auto-text-colour\" style=\"background-color:".$Colour.";\">";
					}

					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['ProjectKey']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['ProjectName']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['Description']."</a></td>";
					echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">";
					$sql3 = "SELECT * FROM clients WHERE ClientID = ".$row['ClientID'];
					$result3 = mysqli_query($link, $sql3);
					$client = mysqli_fetch_array($result3);
					if ($client['Company'] === NULL && $client['Company'] == "") {
						echo $client['FirstName']." ".$client['LastName'];
					} else {
						$client['Company'];
					}
					echo "</a></td>";
					echo "</tr>";
				}
				echo "</tbody>";
				echo "</table>";
			}
		} else {
			echo "ERROR: Was not able to execute SQL: " . $sql . ".";
			echo "<br/>";
			echo mysqli_error($link);

			echo (string)$link; // For Dedugging Purposes
		}

		?>
	</div>
</div>
