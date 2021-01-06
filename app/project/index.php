<?php
include '../../includes/config.php';
include '../../includes/lang/index.php';
session_start();
include '../../includes/session.php';
$projectId = $_GET['id'];
$sql = "SELECT * FROM projects WHERE ProjectID = '".$projectId."'";
if($result = mysqli_query($link, $sql)){
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$ProjectName = $row['ProjectName'];
			$projectClient = $row['Client'];
		}
	}
}
$page_name = $ProjectName." | WPM";
include '../../includes/head.php';
include '../../includes/app_header.php';
include '../../includes/auto-text-colour.php';
include 'new.php';
?>
<script src="../../js/tabs.js" charset="utf-8"></script>
<?php





echo $ProjectName;
echo $projectClient;


if ($projectId == "") {
	echo "<a href=\"../projects\">Choose Project</a>";
}

?>

<!-- <button id="ProjectOptionsShow" type="button" name="button" onclick="ProjectOptionsShow()">...</button> -->
<button id="ProjectOptionsShow" type="button" name="button" onfocus="menu()" onblur="clsmenu()">...</button>



<?php
include 'track.php';
include 'content.php';
?>
Analyticsphp
<link rel="stylesheet" href="../../css/rcm_project.css">
<script type="text/javascript" src="../../js/rcm_project.js"></script>

<div id="ProjectOptionList">
	<a href="javascript:Delete()">
		<i class="fas fa-trash-alt"></i> Delete Project
		<!-- <span>Ctrl + P</span> -->
	</a>
	<hr/>
	<a href="feedback.php">
		<i class="fas fa-comment"></i> Give Feedback
	</a>
	<a href="about.php">
		<i class="fas fa-question-circle"></i> About
		<!-- <span>Ctrl + ?!</span> -->
	</a>
	<a href="help.php">
		<i class="fas fa-info-circle"></i> Help
		<!-- <span>Ctrl + ?!</span> -->
	</a>
</div>

<?php

$sql = "SELECT * FROM projects WHERE ProjectId = '".$projectId."'";
$result = mysqli_query($link, $sql);
$projectRow = mysqli_fetch_array($result);


$sql = "SELECT * FROM tasks WHERE ProjectId = '".$projectId."'";
// echo $sql;
if($result = mysqli_query($link, $sql)){
	if(mysqli_num_rows($result) > 0){
		echo "<table style=\"width:100%;\">";
		echo "<thead>";
		echo "<th>ID</th>";
		echo "<th>Task</th>";
		echo "<th>Description</th>";
		echo "<th>Progress</th>";
		echo "</thead>";
		echo "<tbody>";
		$rowInt = 1;
		while($row = mysqli_fetch_array($result)){
			$idInt = (int)$row['id'];
			// echo "<tr>";
			// echo "<form action=\"edittask.php\" method=\"post\">";
			// echo "<td>" . $idInt . "</td>";
			// echo "<td><input type=\"text\" name=\"Name" . $idInt . "\" value=\"".$row[TaskName]."\" maxlength=\"100\"></td>";
			// echo "<td><input type=\"text\" name=\"Description" . $idInt . "\" value=\"".$row[Description]."\" maxlength=\"300\"></td>";
			// echo "<td><input type=\"number\" name=\"Duration" . $idInt . "\" value=\"".$row[Duration]."\" max=\"100\" min=\"0\"></td>";
			// echo "</tr>";
			echo "<tr>";
			echo "<td>" . $projectRow['ProjectKey'] . "-" . $row['TaskProjectID']."</td>";
			echo "<td>".$row['TaskName']."</td>";
			echo "<td>".$row['Description']."</td>";
			// if ($_SESSION['TrackedTimeView'] == "Progress") {
			// include 'Ratiophp';
			// } else {
			echo "<td>";
			echo "</td>";
			$logsql = "SELECT * FROM logs WHERE TaskID = '".$idInt."'";
			// echo $sql;
			if($logresult = mysqli_query($link, $logsql)){
				if(mysqli_num_rows($logresult) > 0){
					while ($logrow = mysqli_fetch_array($logresult)) {
						$date1=date_create($logrow['Started']);
						$date2=date_create($logrow['Ended']);
						$diff=date_diff($date1,$date2);
						echo $diff->format("%h Hrs %i Mins %s Secs");
					}
				}
			}
			echo "</tr>";
			$rowInt++;
		} // End 1st while
		echo "</tbody>";
		echo "</table>";
	} else {
		echo "No tasks to display";
	}
} else {
	echo "ERROR: Was not able to execute " . $sql . " ." . mysqli_error($link);
}
echo "</div>";
?>
<script type="text/javascript">
function Delete() {
	var deleteq = confirm('Confirm Deletion of Project \"<?php echo $ProjectName; echo "\" with id \"";
	echo $projectId; ?>\"');
	if (deleteq == true) {
	}
}

</script>
