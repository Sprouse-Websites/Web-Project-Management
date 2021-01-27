<?php
include '../../includes/config.php';
?>
<link rel="stylesheet" href="../../css/ctf.css">
<link rel="stylesheet" href="../../css/ttf.css">

<button id="opnTTF" type="button" class="w3-button w3-red" name="button" style="cursor:pointer;" title="Track Time">
	<img src="/fa-icons/solid/clock.svg" alt="clock" height="15pt">
</button>


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
			$sql = "SELECT * FROM tasks WHERE ProjectId = ".$projectId." ORDER BY TaskProjectID;";
			// echo $sql;
			if($result = mysqli_query($link, $sql)){
				if(mysqli_num_rows($result) > 0){
					echo "<select class=\"\" name=\"Task\">";

					while($row = mysqli_fetch_array($result)){
						echo "<option value=\"".(int)$row['TaskID']."\">".$projectRow['ProjectKey'] . "-" . $row['TaskProjectID']." ".$row['TaskName']."</option>";
					}
					echo "</select>";
				}
			}
			?>
			<br>
			<label for="">Started</label>
			<input type="datetime-local" name="Started" value="<?php echo date("Y-m-d\TH:i:s"); ?>" max="<?php echo date("Y-m-d\TH:i:s"); ?>">
			<br>
			<label for="">Ended</label>
			<input type="datetime-local" name="Ended" value="<?php echo date("Y-m-d\TH:i:s"); ?>" max="<?php echo date("Y-m-d\TH:i:s"); ?>">

			<script type="text/javascript">
			function secToHMST() {
				var weeks = parseInt(document.getElementById("weekst").value);
				var days = parseInt(document.getElementById("dayst").value);
				var hrs = parseInt(document.getElementById("hourst").value);
				var mins = parseInt(document.getElementById("minutest").value);
				var secs = parseInt(document.getElementById("secondst").value);
				var secout = (weeks * 7 * 24 * 60 * 60) + (days * 24 * 60 * 60) + (hrs * 60 * 60) + (mins * 60) + secs;

				document.getElementById("secondsoutputt").value = secout;
			}

			</script>
<input type="hidden" name="project" value="<?php echo $projectId ?>">


			<br>
			<input type="submit" value="Add Log">
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
