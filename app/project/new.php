<?php
include '../../includes/config.php';
?>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.ctf {
	display: none; /* Hidden by default */
	position: fixed; /* Stay in place */
	z-index: 1; /* Sit on top */
	padding-top: 100px; /* Location of the box */
	left: 0;
	top: 0;
	width: 100%; /* Full width */
	height: 100%; /* Full height */
	overflow: auto; /* Enable scroll if needed */
	background-color: rgb(0,0,0); /* Fallback color */
	background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.ctf-content {
	background-color: #fefefe;
	margin: auto;
	padding: 20px;
	border: 1px solid #888;
	width: 80%;
}

/* The Close Button */
clsCTF {
	color: #aaaaaa;
	float: right;
	font-size: 28px;
	font-weight: bold;
}

clsCTF:hover,
clsCTF:focus {
	color: #000;
	text-decoration: none;
	cursor: pointer;
}
</style>

<button id="opnCTF" type="button" class="w3-button w3-green" name="button" style="cursor:pointer;">Create Task</button>


<!-- The Modal -->
<div id="createTaskForm" class="ctf">

	<!-- Modal content -->
	<div class="ctf-content">
		<span id="clsCTF" style="cursor:pointer; font-size:18pt">&times;</span>
		<form action="ctf.php" method="post">
			<label for="">Task Name</label>
			<input type="text" name="task" value="" placeholder="Task Name" style="width:100%;">
			<br>
			<label for="">Task Description</label>
			<input type="text" name="description" value="" placeholder="Task Description" style="width:100%;">
			<br>
			<label for="">Duration</label>
			<div id="" class="w3-row" style="">


				<div class="sw-fifth">
					<input id="weeks" value="0" size="2" min="0" max="52" type="number" onchange="secToHMS()" />
					Weeks
				</div>
				<div class="sw-fifth">
					<input id="days" value="0" size="2" min="0" max="6" type="number" onchange="secToHMS()" />
					Days
				</div>
				<div class="sw-fifth">
					<input id="hours" value="0" size="2" min="0" max="23" type="number" onchange="secToHMS()" />
					Hours
				</div>
				<div class="sw-fifth">
					<input id="minutes" value="0" size="2" min="0" max="59" type="number" onchange="secToHMS()" />
					Minutes
				</div>
				<div class="sw-fifth">
					<input id="seconds" value="0" size="2" min="0" max="59" type="number" onchange="secToHMS()" />
					Seconds
				</div>
			</div>
			<br>
			<input type="number" disabled id="secondsoutput" name="Duration">

			<script type="text/javascript">
			function secToHMS() {
				var weeks = parseInt(document.getElementById("weeks").value);
				var days = parseInt(document.getElementById("days").value);
				var hrs = parseInt(document.getElementById("hours").value);
				var mins = parseInt(document.getElementById("minutes").value);
				var secs = parseInt(document.getElementById("seconds").value);
				var secout = (weeks * 7 * 24 * 60 * 60) + (days * 24 * 60 * 60) + (hrs * 60 * 60) + (mins * 60) + secs;

				document.getElementById("secondsoutput").value = secout;
			}

			</script>
			<?php
			$sql = 'SELECT * FROM projects WHERE CompanyID = ' . $companyId . ' AND ProjectState = "Active" ORDER BY ProjectName;';
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					echo "<select class=\"\" name=\"\Project\">";

					while($row = mysqli_fetch_array($result)){
						echo "<option value=\"".(int)$row['ProjectId']."\">".$row['ProjectName']."</option>";
					}
					echo "</select>";
				}
			}
			?>

<select class="" name="TaskPhase">
	<option value="To Do">To Do</option>
	<option value="In Progress">In Progress</option>
	<option value="Complete">Complete</option>
</select>


			<br>
			<input type="submit" value="Add Task">
		</form>
	</div>

</div>

<script>
// CTF is Create Task Form

// Get the modal
var ctf = document.getElementById("createTaskForm");

// Get the button that opens the modal
var openCTF = document.getElementById("opnCTF");

// Get the <span> element that closes the modal
var span = document.getElementById("clsCTF");

// When the user clicks the button, open the modal
openCTF.onclick = function() {
	ctf.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	ctf.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == ctf) {
		ctf.style.display = "none";
	}
}
</script>