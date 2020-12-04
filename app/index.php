<?php
$page_name = "WPM App";
include '../includes/config.php';
include '../includes/session.php';
include '../includes/head.php';
include '../includes/app_header.php';
?>
App Main Menu
<div id="" class="w3-row-padding" style="text-align:center;">
	<div id="" class="w3-quarter w3-red app-widget" style="">
		Active Projects
		<div style="font-size:50pt;text-align:center;">
			<?php
			$sql = 'SELECT COUNT(ProjectName) As Output FROM projects WHERE CompanyID = ' . $_SESSION['CompanyId'] . ' AND ProjectState = "Active";';
			// echo $sql;
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					while($row = mysqli_fetch_array($result)){
						echo $row['Output'];
					}
				}
			}
			?>
		</div>
	</div>
	<div id="" class="w3-third w3-gray app-widget" style="">
		Tasks
		<div id="" class="w3-row" style="">
			<div id="" class="w3-third w3-blue" style="">
				To Do
				<div style="font-size:50pt;text-align:center;">
					<?php
					$sql = 'SELECT COUNT(TaskID) As ToDoTasksCnt FROM tasks WHERE CompanyID = ' . $_SESSION['CompanyId'] . ' AND TaskPhase = "To Do";';
					// echo $sql;
					if($result = mysqli_query($link, $sql)){
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_array($result)){
								echo $row['ToDoTasksCnt'];
							}
						}
					}
					?>
				</div>
			</div>
			<div id="" class="w3-third w3-yellow" style="">
				In Progress
				<div style="font-size:50pt;text-align:center;">
					<?php
					$sql = 'SELECT COUNT(TaskID) As InProgTasksCnt FROM tasks WHERE CompanyID = ' . $_SESSION['CompanyId'] . ' AND TaskPhase = "In Progress";';
					// echo $sql;
					if($result = mysqli_query($link, $sql)){
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_array($result)){
								echo $row['InProgTasksCnt'];
							}
						}
					}
					?>
				</div>
			</div>
			<div id="" class="w3-third w3-green" style="">
				Completed
				<div style="font-size:50pt;text-align:center;">
					<?php
					$sql = 'SELECT COUNT(TaskID) As ComplTasksCnt FROM tasks WHERE CompanyID = ' . $_SESSION['CompanyId'] . ' AND TaskPhase = "Completed";';
					// echo $sql;
					if($result = mysqli_query($link, $sql)){
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_array($result)){
								echo $row['ComplTasksCnt'];
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>