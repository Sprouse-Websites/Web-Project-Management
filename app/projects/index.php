<?php
$page_name = "Projects | WPM";
include '../../includes/config.php';
include '../../includes/lang/index.php';
include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';
include '../../includes/auto-text-colour.php';
include 'new.php';
?>


<div>
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
			echo "<th onclick=\"sortTableByProgress()\">Progress</th>";
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
				echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\">".$row['Client']."</a></td>";
				// FIXME: Progress not reciving sql
				$sql2 = "SELECT SUM(TimeTracked) As TimeTrackedCnt, SUM(Duration) As DurationCnt FROM tasks WHERE ProjectId = ".$idInt;
				if($result2 = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result2) > 0){
						while($row2 = mysqli_fetch_array($result2)){
							$TimeTracked = (float)$row2['TimeTrackedCnt'];
							$Duration = (float)$row2['DurationCnt'];
							$progress = $TimeTracked / $Duration;
							$progress = $progress * 100;
							if ($TimeTracked > $Duration) {
								$var1 = "background-color:red !important; text-align:center;";
							} else {
								$var1 = "";
							}
						}
					}
				}
				echo "<td><a class=\"hidden\" href=\"../project?id=" . $idInt . "\"><div class=\"progress-contatiner\"><div class=\"progress-bar\" style=\"width:".(float)$progress."%; ".$var1."\">";

				echo $TimeTracked;
				echo "/";

				echo $Duration;
				echo"</div> </div></a></td>";
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
