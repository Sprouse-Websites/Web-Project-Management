<?php
include '../../includes/config.php';
?>
<link rel="stylesheet" href="../../css/ccf.css">

<!-- <button id="opnCCF" type="button" class="w3-button w3-green" name="button" style="cursor:pointer;">Create Project</button> -->
<button id="opnCCF" type="button" class="w3-button w3-green" name="button" onclick="opnCCF()" style="cursor:pointer;">Add Client</button>


<!-- The Modal -->
<div id="createProjectForm" class="ccf">

	<!-- Modal content -->
	<div class="ccf-content">
		<span id="clsCCF" style="cursor:pointer; font-size:18pt" onclick="closeCCF()">&times;</span>
		<?php // FIXME: Create client form ?>
		<form action="ccf.php" method="post">
			<label for=""><i class="fas fa-id-card"></i> Name</label>
			<div id="" class="w3-row" style="">
				<div id="" class="w3-third" style="">
					<input type="text" name="FirstName" value="" placeholder="First Name" style="width:98%;" required maxlength="50">
				</div>
				<div id="" class="w3-third" style="">
					<input type="text" name="MiddleNames" value="" placeholder="Middle Names" style="width:98%;" maxlength="50">
				</div>
				<div id="" class="w3-third" style="">
					<input type="text" name="LastName" value="" placeholder="Last Name" style="width:98%;" required maxlength="50">
				</div>

			</div>

			<label for="">
				<i class="fas fa-building"></i> Company
			</label>
			<input type="text" name="Company" style="width:100%;">

			<div id="" class="w3-row" style="">
				<div id="" class="w3-half" style="">
					<label for="">
						<i class="fas fa-phone">1</i> Primary Phone Number
					</label>
					<input type="text" name="PhoneNumber1" value="" style="width:98%;">
				</div>
				<div id="" class="w3-half" style="">
					<label for="">
						<i class="fas fa-phone">2</i> Secondary Phone Number
					</label>
					<input type="text" name="PhoneNumber2" value="" style="width:98%;">
				</div>
			</div>
			<br>
			<label for=""><i class="fas fa-envelope"></i> Email Address</label>
			<input type="text" name="EmailAddress" placeholder="Email Address" style="width:100%;">
			<br>
			<label for=""><i class="fas fa-sticky-note"></i> Notes</label>
			<textarea name="Notes" rows="8" style="width:100%" maxlength="250"></textarea>

			<script>
			// In your Javascript (external .js resource or <script> tag)
			$(document).ready(function() {
				$('.js-example-basic-single').select2();
			});
			</script>

			<br>
			<label for="">Colour</label>
			<input type="color" name="color" required>
			<br>
			<input type="submit" value="Add Project">
		</form>
	</div>

</div>

<script>
// CCF is Create Project Form

// Get the modal
var ccf = document.getElementById("createProjectForm");

// Get the button that opens the modal
var openCCF = document.getElementById("opnCCF");

// Get the <span> element that closes the modal
var span = document.getElementById("clsCCF");

// When the user clicks the button, open the modal
function opnCCF(){
	ccf.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closeCCF() {
	ccf.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == ccf) {
		ccf.style.display = "none";
	}
}
</script>
