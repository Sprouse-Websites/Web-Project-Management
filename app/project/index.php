<?php
include '../../includes/config.php';
// include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';
include '../../includes/auto-text-colour.php';
include 'new.php';
?>
<script src="../../js/tabs.js" charset="utf-8"></script>
<?php
$sql = "SELECT * FROM Projects WHERE ProjectID = '".$projectId."'";
// echo $sql;
if($result = mysqli_query($link, $sql)){
	if(mysqli_num_rows($result) > 0){
		while($row = mysqli_fetch_array($result)){
			$ProjectName = $row['ProjectName'];
		}
	}
}

$projectId = $_GET['id'];
$projectName = $_GET['name'];
$projectClient = $_GET['client'];


echo $ProjectName;
echo $projectClient;


if ($projectId == "") {
	echo "<a href=\"../projects\">Choose Project</a>";
}

?>

<!-- <button id="ProjectOptionsShow" type="button" name="button" onclick="ProjectOptionsShow()">...</button> -->
<button id="ProjectOptionsShow" type="button" name="button" onfocus="menu()" onblur="clsmenu()">...</button>

<style>
/* This CSS file is for the right click menu */
#ProjectOptionList {
	visibility: hidden;
	opacity: 0;
	position: fixed;
	background: #fff;
	color: #555;
	font-family: sans-serif;
	font-size: 11px;
	-webkit-transition: opacity .5s ease-in-out;
	-moz-transition: opacity .5s ease-in-out;
	-ms-transition: opacity .5s ease-in-out;
	-o-transition: opacity .5s ease-in-out;
	transition: opacity .5s ease-in-out;
	/* -webkit-transition: visibility .5s ease-in-out; */
	/* -moz-transition: visibility .5s ease-in-out; */
	/* -ms-transition: visibility .5s ease-in-out; */
	/* -o-transition: visibility .5s ease-in-out; */
	/* transition: visibility .5s ease-in-out; */
	-webkit-box-shadow: 2px 2px 2px 0px rgba(143, 144, 145, 1);
	-moz-box-shadow: 2px 2px 2px 0px rgba(143, 144, 145, 1);
	box-shadow: 2px 2px 2px 0px rgba(143, 144, 145, 1);
	padding: 0px;
	border: 1px solid #C6C6C6;
}

#ProjectOptionList a {
	display: block;
	color: #555;
	text-decoration: none;
	padding: 6px 8px 6px 30px;
	position: relative;
}

#ProjectOptionList a img,
#ProjectOptionList a i.fas {
	height: 20px;
	font-size: 17px;
	width: 20px;
	position: absolute;
	left: 5px;
	top: 2px;
}

#ProjectOptionList a span {
	color: #BCB1B3;
	float: right;
	padding-left: 2pt;
}

#ProjectOptionList a:hover {
	color: #fff;
	background: #3879D9;
}

#ProjectOptionList hr {
	border: 1px solid #EBEBEB;
	border-bottom: 0;
	margin: 0pt !important;
}

.progress-bar {
	background-color: #<?php echo $_GET['colour']; ?>;
}

</style>
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

<script type="text/javascript">
function Delete() {
	var deleteq = confirm('Confirm Deletion of Project \"<?php echo $ProjectName; echo "\" with id \"";
	echo $projectId; ?>\"');
	if (deleteq == true) {
	}
}
</script>

<script type="text/javascript">
var ProjectOptionList = document.getElementById("ProjectOptionList").style;

function menu() {
	ProjectOptionList.visibility = "visible";
	ProjectOptionList.opacity = "1";
	ProjectOptionList.left = "91pt";
	ProjectOptionList.top = "87pt";
}
function clsmenu() {
	ProjectOptionList.visibility = "hidden";
	ProjectOptionList.opacity = "0";
}
</script>

<?php

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
			echo "<td>" . $_GET['key'] . "-" . $row['TaskProjectID']."</td>";
			echo "<td>".$row['TaskName']."</td>";
			echo "<td>".$row['Description']."</td>";
			echo "<td>";
			echo "<div class=\"progress-contatiner\">";
			$TimeTracked = $row['TimeTracked'];
			$Duration = $row['Duration'];
			$Ratio = ($TimeTracked / $Duration) * 100;



			$TimeTrackedHr = $TimeTracked / 3600;
			$TimeTrackedMin = $TimeTracked % 3600 / 60;
			$TimeTrackedSec = $TimeTracked % 3600 % 60;
			if ((int)$TimeTrackedHr == 0) {

			}
			elseif ((int)$TimeTrackedHr == 1) {
				echo (int)$TimeTrackedHr." Hr ";
			}
			else {
				echo (int)$TimeTrackedHr." Hrs ";
			}
			if ((int)$TimeTrackedMin == 0) {
			}
			elseif ((int)$TimeTrackedMin == 1) {
				echo (int)$TimeTrackedMin." Min ";
			}
			else {
				echo (int)$TimeTrackedMin." Mins ";
			}
			if ((int)$TimeTrackedSec == 0) {

			}
			elseif ((int)$TimeTrackedSec == 1) {
				echo (int)$TimeTrackedSec." Sec";
			}
			else {
				echo (int)$TimeTrackedSec." Secs";
			}

			echo "/";

			$DurationHr = $Duration / 3600;
			$DurationMin = $Duration % 3600 / 60;
			$DurationSec = $Duration % 3600 % 60;
			if ((int)$DurationHr == 0) {

			}
			elseif ((int)$DurationHr == 1) {
				echo (int)$DurationHr." Hr ";
			}
			else {
				echo (int)$DurationHr." Hrs ";
			}
			if ((int)$DurationMin == 0) {
			}
			elseif ((int)$DurationMin == 1) {
				echo (int)$DurationMin." Min ";
			}
			else {
				echo (int)$DurationMin." Mins ";
			}
			if ((int)$DurationSec == 0) {

			}
			elseif ((int)$DurationSec == 1) {
				echo (int)$DurationSec." Sec";
			}
			else {
				echo (int)$DurationSec." Secs";
			}
			if ($Ratio > 100) {
				echo "<div style=\"width:100%\" class=\"overdue progress-bar\">Overdue";
			} else {
				echo "<div style=\"width:".$Ratio."%\" class=\"progress-bar\">";
			}
			echo "</div></td>";
			echo "</div>";
			echo "</tr>";
			$rowInt++;
		}
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
