<?php
include '../../includes/config.php';
?>
<link rel="stylesheet" href="../../css/cpf.css">

<!-- <button id="opnCPF" type="button" class="w3-button w3-green" name="button" style="cursor:pointer;">Create Project</button> -->
<button id="opnCPF" type="button" class="w3-button w3-green" name="button" onclick="opnCPF()" style="cursor:pointer;">Create Project</button>


<!-- The Modal -->
<div id="createProjectForm" class="cpf">

	<!-- Modal content -->
	<div class="cpf-content">
		<span id="clsCPF" style="cursor:pointer; font-size:18pt" onclick="closeCPF()">&times;</span>
		<form action="cpf.php" method="post">
			<label for="">Project Name</label>
			<input type="text" name="project" value="" placeholder="Project Name" style="width:70%;" required maxlength="50">
			<label for="">Project Key</label>
			<input type="text" name="projectkey" value="" style="width:12%;" maxlength="4">
			<br>
			<label for="">Project Description</label>
			<textarea name="description" placeholder="Project Description" style="width:100%;" maxlength="200"></textarea>
			<br>
			<label for="">Client</label>
			<select id="clientSelect" class="js-example-basic-single" name="client" required>
				<option value="" disabled selected>Choose a client</option>
				<?php
				// Check connection
				if($link === false){
					echo "<option value=\"\" disabled>Could not get list from Database</option>";
				}
				// Attempt select query execution
				$sql = "SELECT * FROM clients WHERE UserCompanyID =  " . $_SESSION['CompanyID'] . " ORDER BY Company";

				if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							echo "<option value=\"".$row['ClientID']."\">".$row['Company']." - ".$row['FirstName']." ".$row['LastName']."</option>";
						}
					}
				}
				?>
			</select>
<br>
<label for="">State</label>
<select id="stateSelect" class="js-example-basic-single" name="projectstate">
	<option value="Active" selected>Active</option>
	<option value="On Hold">On Hold</option>
	<option value="Archived">Archived</option>
</select>
<label for="">Phase</label>
<select id="phaseSelect" class="js-example-basic-single" name="projectphase">
	<option value="Planning" selected>Planning</option>
	<option value="In Progress">In Progress</option>
	<option value="Complete">Complete</option>
</select>

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
			Billing
			<br/>
			<input type="submit" value="Add Project">
		</form>
	</div>

</div>

<script>
// CPF is Create Project Form

// Get the modal
var cpf = document.getElementById("createProjectForm");

// Get the button that opens the modal
var openCPF = document.getElementById("opnCPF");

// Get the <span> element that closes the modal
var span = document.getElementById("clsCPF");

// When the user clicks the button, open the modal
function opnCPF(){
	cpf.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function closeCPF() {
	cpf.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
	if (event.target == cpf) {
		cpf.style.display = "none";
	}
}
</script>
