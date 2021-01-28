<?php
include '../../includes/config.php';

include '../../includes/session.php';

$page_name = "All Tasks | WPM";
include '../../includes/head.php';
include '../../includes/app_header.php';
include '../../includes/auto-text-colour.php';
// include 'new.php';
?>
<script src="../../js/tabs.js" charset="utf-8"></script>
<?php




?>

<!-- <button id="ProjectOptionsShow" type="button" name="button" onclick="ProjectOptionsShow()">...</button> -->
<button id="ProjectOptionsShow" type="button" name="button" onfocus="menu()" oncontextmenu="preventDefault();menu()" onblur="clsmenu()">...</button>

<?php
$projectId = $_GET['id'];
$projectsql = "SELECT * FROM projects WHERE CompanyID = '".$_SESSION[CompanyID]."'";
if($projectresult = mysqli_query($link, $projectsql)){
	if(mysqli_num_rows($projectresult) > 0){
		echo "<table style=\"width:100%;\">";
		echo "<thead>";
		echo "<th>ID</th>";
		echo "<th>Task</th>";
		echo "<th>Description</th>";
		echo "<th>Progress</th>";
		echo "</thead>";
		echo "<tbody>";
		while($projectrow = mysqli_fetch_array($projectresult)){
			$ProjectID = $projectrow['ProjectID'];
			$sql = "SELECT * FROM tasks WHERE ProjectId = '".$ProjectID."'";
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					$rowInt = 1;
					while($row = mysqli_fetch_array($result)){
						$idInt = (int)$row['TaskID'];
						echo "<tr>";
						echo "<td><Task-Key>" . $projectrow['ProjectKey'] . "-" . $row['TaskProjectID']."</Task-Key></td>";
						echo "<td>".$row['TaskName']."</td>";
						echo "<td>";
echo preg_replace("!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?%=&_/]+!", ' ', $row['Description']);
						preg_match_all("!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?%=&_/]+!", $row['Description'],$descriptionURL,PREG_OFFSET_CAPTURE,0);
						foreach($descriptionURL[0] as $result) {
							$descriptionDisp = preg_replace('!\/!', "/<wbr>", $result[0]);
							echo "<a href=\"",$result[0], "\">", $descriptionDisp, "</a>";
						}
						echo "</td>";
						// if ($_SESSION['TrackedTimeView'] == "Progress") {
						echo "<td>
						<div class=\"progress-contatiner\">";
						// include 'Ratio.php';
						// DUR is TimeTracked; DURA is Duration
						$durTot = $durHrs = $durMins = $duraHrs = $duraTot = $duraMins = 0;
						$logsql = "SELECT * FROM logs WHERE TaskID = '".$idInt."';";
						if($logresult = mysqli_query($link, $logsql)){
							if(mysqli_num_rows($logresult) > 0){
								$durTot = 0;
								while ($logrow = mysqli_fetch_array($logresult)) {
									$date1 = date_parse($logrow['Started']);
									$date1sec = $date1[second];
									$date1sec = $date1sec + ($date1[minute] * 60);
									$date1sec = $date1sec + ($date1[hour] * 60 * 60);

									$date2 = date_parse($logrow['Ended']);
									$date2sec = $date2[second];
									$date2sec = $date2sec + ($date2[minute] * 60);
									$date2sec = $date2sec + ($date2[hour] * 60 * 60);

									$dur = $date2sec - $date1sec;

									$durTot = $durTot + $dur;
								}
								// echo(strtotime($dur) . "<br>");
								$duraTot = $row['Duration'];
								$Ratio = ($durTot / $duraTot) * 100;
								// echo $Ratio;
								echo "<div class=\"progress-contatiner\">";
								if ($Ratio > 100) {
									echo "<div style=\"width:100%\" class=\"progress-bar\"></div>";
								} else {
									echo "<div style=\"width:".$Ratio."%\" class=\"progress-bar\"></div>";
								}
								echo "<div style=\"position: relative; bottom: 17.5pt;\">";

								if ($durTot >= 604800) {
									$durWeeks = $durTot / 604800;
									$durWeeks = (int)$durWeeks;
									if ($durWeeks == 1) {
										echo $durWeeks . " Wk ";
									} else {
										echo $durWeeks . " Wks ";
									}
									$durTot = $durTot - (604800 * $durWeeks);
								}
								if ($durTot >= 86400) {
									$durDays = $durTot / 86400;
									$durDays = (int)$durDays;
									if ($durDays == 1) {
										echo $durDays . " Day ";
									} else {
										echo $durDays . " Days ";
									}
									$durTot = $durTot - (86400 * $durDays);
								}
								if ($durTot >= 3600) {
									$durHrs = $durTot / 3600;
									$durHrs = (int)$durHrs;
									if ($durHrs == 1) {
										echo $durHrs . " Hr ";
									} else {
										echo $durHrs . " Hrs ";
									}
									$durTot = $durTot - (3600 * $durHrs);
								}
								if ($durTot >= 60) {
									$durMins = $durTot / 60;
									$durMins = (int)$durMins;
									if ($durMins == 1) {
										echo $durMins . " Min ";
									} else {
										echo $durMins . " Mins ";
									}
									$durTot = $durTot - (60 * $durMins);
								}

								if ($durTot > 1) {
									echo $durTot . " Secs ";
								} elseif ($durTot == 1) {
									echo $durTot . " Sec ";
								}
								echo "/ ";
								if ($duraTot >= 604800) {
									$duraWeeks = $duraTot / 604800;
									$duraWeeks = (int)$duraWeeks;
									if ($duraWeeks == 1) {
										echo $duraWeeks . " Wk ";
									} else {
										echo $duraWeeks . " Wks ";
									}
									$duraTot = $duraTot - (604800 * $duraWeeks);
								}
								if ($duraTot >= 86400) {
									$duraDays = $duraTot / 86400;
									$duraDays = (int)$duraDays;
									if ($duraDays == 1) {
										echo $duraDays . " Day ";
									} else {
										echo $duraDays . " Days ";
									}
									$duraTot = $duraTot - (86400 * $duraDays);
								}
								if ($duraTot >= 3600) {
									$duraHrs = $duraTot / 3600;
									$duraHrs = (int)$duraHrs;
									if ($duraHrs == 1) {
										echo $duraHrs . " Hr ";
									} else {
										echo $duraHrs . " Hrs ";
									}
									$duraTot = $duraTot - (3600 * $duraHrs);
								}
								if ($duraTot >= 60) {
									$duraMins = $duraTot / 60;
									$duraMins = (int)$duraMins;
									if ($duraMins == 1) {
										echo $duraMins . " Min ";
									} else {
										echo $duraMins . " Mins ";
									}
									$duraTot = $duraTot - (60 * $duraMins);
								}

								if ($duraTot > 1) {
									echo $duraTot . " Secs";
								} elseif ($duraTot == 1) {
									echo $duraTot . " Sec";
								}

							}
						}
						echo "</div>";

						echo "</div>";
						echo "</td>";
						echo "<td>
						<a href=\"/app/project?id=".$projectrow['ProjectID']."\">
						<img src=\"/fa-icons/solid/eye.svg\" height=\"12px\">
						</a>
						</td>";
						echo "</tr>";
						$rowInt++;
					} // End 1st while

				}
			} else {
				echo "ERROR: Was not able to execute " . $sql . " ." . mysqli_error($link);
			}
			echo "</div>";
		}
	}
	echo "</tbody>";
	echo "</table>";
}


?>
<script type="text/javascript">
function Delete() {
	var deleteq = confirm('Confirm Deletion of Project \"<?php echo $ProjectName; echo "\" with id \"";
	echo $projectId; ?>\"');
	if (deleteq == true) {
	}
}

</script>
<style>
.progress-bar {
	background-color: #<?php echo $_GET['colour']; ?>;
}
</style>
