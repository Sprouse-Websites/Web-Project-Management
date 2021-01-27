<?php
include '../../includes/config.php';

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

echo "<a href=\"/app/projects\">Back to projects list</a> / ";
echo $ProjectName;
echo $projectClient;

if ($projectId == "") {
	echo "<a href=\"../projects\">Choose Project</a>";
}
include 'new.php';
?>

<script src="../../js/tabs.js" charset="utf-8"></script>

<link rel="stylesheet" href="../../css/rcm_project.css">
<script type="text/javascript" src="../../js/rcm_project.js"></script>

<div class="dropdown">
	<button id="ProjectOptionsShow" type="button" name="button" onclick="dropdown()" class="dropbtn" title="Options">...</button>
	<div id="ProjectOptionList" class="dropdown-content">
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
</div>


<?php
include 'track.php';
include 'content.php';
?>
<!-- Analyticsphp -->

<?php

$sql = "SELECT * FROM projects WHERE ProjectId = ".$projectId." AND CompanyID = ".$_SESSION['CompanyID'].";";
$result = mysqli_query($link, $sql);
if(mysqli_num_rows($result) > 0){
	$projectRow = mysqli_fetch_array($result);

	echo "<style>
	.progress-bar {
		background-color: ".$projectRow['Colour'].";
	}
	</style>";

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
				$idInt = (int)$row['TaskID'];
				// echo "<tr>";
				// echo "<form action=\"edittask.php\" method=\"post\">";
				// echo "<td>" . $idInt . "</td>";
				// echo "<td><input type=\"text\" name=\"Name" . $idInt . "\" value=\"".$row[TaskName]."\" maxlength=\"100\"></td>";
				// echo "<td><input type=\"text\" name=\"Description" . $idInt . "\" value=\"".$row[Description]."\" maxlength=\"300\"></td>";
				// echo "<td><input type=\"number\" name=\"Duration" . $idInt . "\" value=\"".$row[Duration]."\" max=\"100\" min=\"0\"></td>";
				// echo "</tr>";
				echo "<tr>";
				echo "<td>" . $projectRow['ProjectKey'] . "-" . $row['TaskProjectID'] . "</td>";
				echo "<td>".$row['TaskName']."</td>";
				echo "<td>";
				echo preg_replace('!(http|ftp|scp)(s)?:\/\/[a-zA-Z0-9.?%=&_/]+!', "<a href=\"\\0\">\\0</a>", $row['Description']);
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
							echo "<div style=\"width:100%\" class=\"progress-bar overdue\"></div>";
						} else {
							echo "<div style=\"width:".$Ratio."%\" class=\"progress-bar\"></div>";
						}
						echo "<div style=\"position: relative; bottom: 17.5pt;\">";
						if ($durTot == 0) {
							echo "No Time Tracked";
						}
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
					echo "</div>";
				}

				echo "</div>";
				echo "</td>";
				echo "<td>";
				echo "<i style=\"cursor:pointer\" class=\"fad fa-pencil\" onclick='openEdit(\"" . $row['TaskName'] . "\", \"" . $row['Description'] . "\", \"" . $idInt . "\", \"" . $row['TaskPhase'] . "\", ";
				if ($duraWeeks == "") {
					$duraWeeks = 0;
				}
				echo "\"" . $duraWeeks . "\", ";
				if ($duraDays == "") {
					$duraDays = 0;
				}
				echo "\"" . $duraDays . "\", ";
				if ($duraHrs == "") {
					$duraHrs = 0;
				}
				echo "\"" . $duraHrs . "\", ";
				if ($duraMins == "") {
					$duraMins = 0;
				}
				echo "\"" . $duraMins . "\", ";
				if ($duraTot == "") {
					$duraTot = 0;
				}
				echo "\"" . $duraTot . "\",";
				echo "\"" . $row['TaskPhase'] . "\"";
				echo ")'></i>";
				echo "</td>";
				echo "<td></td>";
				echo "</tr>";
				$rowInt++;
			} // End 1st while
			echo "</tbody>";
			echo "</table>";
		} else {
			echo "<table>";
			echo "<tbody>";
			echo "<tr>";
			echo "<td>";
			echo "No tasks to display";
			echo "</td>";
			// ALTER TABLE `projects` ADD UNIQUE( `ProjectKey`, `CompanyID`);
			echo "</tr>";
			echo "</tbody>";
			echo "</table>";
		}
	} else {
		echo "ERROR: Was not able to execute " . $sql . " ." . mysqli_error($link);
	}
	echo "</div>";
} elseif ($_GET['id'] === NULL || $_GET['id'] === "") {
echo "<script type='text/javascript'> window.location.replace('../projects'); </script>";
} else {
	echo "<div>
	Access Forbidden. This project is the property of another company.
	</div>";
}
?>

<div id="EditTask" class="ctf" style="">

	<!-- Modal content -->
	<div class="ctf-content">
		<span id="clsCTF" style="cursor:pointer; font-size:18pt" onclick="clsEdit()">&times;</span>
		<form action="edittask.php" method="post">
			<input type="text" name="project" value="<?php echo $projectId; ?>" style="display:none;">
			<input type="text" id="taskid" name="taskID" value="" style="display:none;">
			<input id="formType" type="hidden" name="type" value="">
			<label for="task">Task Name</label>
			<input type="text" id="task" name="task" value="" placeholder="Task Name" style="width:100%;" required>
			<br>
			<label for="description">Task Description</label>
			<textarea id="description" name="description" rows="2" style="width:100%;" placeholder="Description"></textarea>
			<br>
			<label for="">Duration</label>
			<div class="w3-row" style="">
				<div class="sw-fifth">
					<input id="weeks" value="0" size="2" min="0" max="52" type="number" onchange="secToHMS()" oninput="secToHMS()" onkeyup="secToHMS()"/>
					Weeks
				</div>
				<div class="sw-fifth">
					<input id="days" value="0" size="2" min="0" max="6" type="number" onchange="secToHMS()" oninput="secToHMS()" onkeyup="secToHMS()"/>
					Days
				</div>
				<div class="sw-fifth">
					<input id="hours" value="0" size="2" min="0" max="23" type="number" onchange="secToHMS()" oninput="secToHMS()" onkeyup="secToHMS()"/>
					Hours
				</div>
				<div class="sw-fifth">
					<input id="minutes" value="0" size="2" min="0" max="59" type="number" onchange="secToHMS()" oninput="secToHMS()" onkeyup="secToHMS()"/>
					Minutes
				</div>
				<div class="sw-fifth">
					<input id="seconds" value="0" size="2" min="0" max="59" type="number" onchange="secToHMS()" oninput="secToHMS()" onkeyup="secToHMS()"/>
					Seconds
				</div>
			</div>
			<br>
			<input type="number" id="secondsoutput" name="Duration" style="visibility:hidden;">
			<br/>
			<label for="due">Due Date</label>
			<br/>
			<input type="datetime-local" name="due">

			<script type="text/javascript">
			function secToHMS() {
				console.log("secToHMS");
				var weeks = parseInt(document.getElementById("weeks").value);
				var days = parseInt(document.getElementById("days").value);
				var hrs = parseInt(document.getElementById("hours").value);
				var mins = parseInt(document.getElementById("minutes").value);
				var secs = parseInt(document.getElementById("seconds").value);
				var secout = (weeks * 7 * 24 * 60 * 60) + (days * 24 * 60 * 60) + (hrs * 60 * 60) + (mins * 60) + secs;

				document.getElementById("secondsoutput").value = secout;
			}

			</script>

			<select id="TaskPhase" class="" name="TaskPhase">
				<option id="TaskPhaseOptionToDo" value="To Do">To Do</option>
				<option id="TaskPhaseOptionInProgress" value="In Progress">In Progress</option>
				<option id="TaskPhaseOptionComplete" value="Complete">Complete</option>
			</select>


			<br>
			<input id="submit" type="submit" value="Save Task">
		</form>
	</div>


	<script>

	</script>

</div>

<script type="text/javascript">
function Delete() {
	var deleteq = confirm('Confirm Deletion of Project "<? echo $ProjectName;?>" with id "<? echo $projectId;	?>"');
	if (deleteq == true) {
		window.location.replace("delete.php?id=<? echo $projectId ?>");
	}
}

// CTF is Create Task Form

// Get the modal
var ctf = document.getElementById("EditTask");

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == ctf) {
		clsEdit();
	}
}

function clsEdit() {
	ctf.style.display = "none";
}

function openEdit(name, description, taskid, taskphase, weeks, days, hours, mins, secs) {
	document.getElementById("task").value = name;
	document.getElementById("description").value = description;
	document.getElementById("taskid").value = taskid;
	document.getElementById("hours").value = hours;
	document.getElementById("minutes").value = mins;
	document.getElementById("seconds").value = secs;
	document.getElementById("formType").value = "edit";
	document.getElementById("submit").value = "Save Task";
	ctf.style.display = "block";
	document.getElementById("days").value = days;
	document.getElementById("weeks").value = weeks;
	if (taskphase == "To Do") {
		document.getElementById("TaskPhaseOptionToDo").selected = true;
		document.getElementById("TaskPhaseOptionInProgress").selected = false;
		document.getElementById("TaskPhaseOptionComplete").selected = false;
	}
	if (taskphase == "In Progress") {
		document.getElementById("TaskPhaseOptionInProgress").selected = true;
		document.getElementById("TaskPhaseOptionToDo").selected = false;
		document.getElementById("TaskPhaseOptionComplete").selected = false;
	}
	if (taskphase == "Complete") {
		document.getElementById("TaskPhaseOptionComplete").selected = true;
		document.getElementById("TaskPhaseOptionToDo").selected = false;
		document.getElementById("TaskPhaseOptionInProgress").selected = false;
	}
}

function newTask() {
	document.getElementById("task").value = "";
	document.getElementById("description").value = "";
	document.getElementById("hours").value = "0";
	document.getElementById("minutes").value = "0";
	document.getElementById("seconds").value = "0";
	document.getElementById("submit").value = "Create Task";
	document.getElementById("formType").value = "new";
	document.getElementById("weeks").value = "0";
	document.getElementById("days").value = "0";
	ctf.style.display = "block";
}



</script>
