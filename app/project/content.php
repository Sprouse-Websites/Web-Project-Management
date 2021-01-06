<?php
include '../../includes/config.php';
?>
<link rel="stylesheet" href="../../css/acf.css">

<button id="opnACF" type="button" class="w3-button w3-yellow" name="button" style="cursor:pointer;"><i class="fas fa-file-upload"></i></button>


<!-- The Modal -->
<div id="addContentForm" class="acf">

	<!-- Modal content -->
	<div class="acf-content">
		<h3><span id="clsACF" style="cursor:pointer; font-size:18pt">&times;</span> Add Document</h3>
		<form action="acf.php" method="post" enctype="multipart/form-data">
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="hidden" name="ProjectID" value="<?php echo $projectId; ?>">
			<input type="hidden" name="CompanyID" value="<?php echo $_SESSION['CompanyID']; ?>">

			<br><br/>

			<input type="submit" value="Add Task">
		</form>
	</div>

</div>

<script>
// ACF is Create Task Form

// Get the modal
var acf = document.getElementById("addContentForm");

// Get the button that opens the modal
var openACF = document.getElementById("opnACF");

// Get the <span> element that closes the modal
var span = document.getElementById("clsACF");

// When the user clicks the button, open the modal
openACF.onclick = function() {
	acf.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
	acf.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == acf) {
		acf.style.display = "none";
	}
}
</script>
