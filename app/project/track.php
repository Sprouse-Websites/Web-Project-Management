<?php
include '../../includes/config.php';
?>
<link rel="stylesheet" href="../../css/ctf.css">
<link rel="stylesheet" href="../../css/ttf.css">

<button id="opnTTF" type="button" class="w3-button w3-red" name="button" style="cursor:pointer;"><i class="fas fa-clock"></i></button>


<!-- The Modal -->
<div id="TrackTimeForm" class="ttf">

	<!-- Modal content -->
	<div class="ttf-content">
		<span id="clsTTF" style="cursor:pointer; font-size:18pt">&times;</span>
		<form action="cttf.php" method="post">
			<label for="">Description</label>
			<input type="text" name="description" value="" placeholder="Description" style="width:100%;">
			<br>
			<label for="">Task</label>
			<?php
			$sql = 'SELECT * FROM projects WHERE CompanyID = ' . $_SESSION['CompanyID'] . ' AND ProjectID = "Active" ORDER BY ProjectName;';
			$sql = "SELECT * FROM tasks WHERE ProjectId = ".$projectId." ORDER BY TaskProjectID;";
			echo $sql;
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					echo "<select class=\"\" name=\"\Task\">";

					while($row = mysqli_fetch_array($result)){
						echo "<option value=\"".(int)$row['ProjectId']."\">".$row['TaskName']."</option>";
					}
					echo "</select>";
				}
			}
			?>
			<br>
			<label for="">Duration</label>
			<div class="w3-row" style="">


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
			<input type="number" id="secondsoutput" name="Duration">

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
			$sql = 'SELECT * FROM projects WHERE CompanyID = ' . $_SESSION['CompanyID'] . ' AND ProjectState = "Active" ORDER BY ProjectName;';
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
// TTF is Track Time Form

// Get the modal
var ttf = document.getElementById("TrackTimeForm");

// Get the button that opens the modal
var openTTF = document.getElementById("opnTTF");

// Get the <span> element that closes the modal
var span = document.getElementById("clsTTF");

// When the user clicks the button, open the modal
openTTF.onclick = function() {
	ttf.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	ttf.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == ttf) {
		ttf.style.display = "none";
	}
}
</script>
