<?php
include '../../includes/privconfig.php';
include '../../includes/config.php';
$page_name = "Clients | WPM";

include '../../includes/session.php';
include '../../includes/head.php';
include '../../includes/app_header.php';
include '../../includes/auto-text-colour.php';
include 'new.php';
?>


<div>
	<?php

	$sql = 'SELECT * FROM clients WHERE UserCompanyID = ' . $_SESSION['CompanyID'] . ';';
	// echo $sql; // For Dedugging Purposes
	if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			echo "<table class=\"no-borders banded-rows\" cellspacing=\"0\" cellpadding=\"0\" id=\"ProjectsTable\" width=\"100%\">";
			echo "<thead>";
			echo "<th>Contact Name</th>";
			echo "<th>Company</th>";
			echo "<th>Contact</th>";
			echo "</thead>";
			echo "<tbody>";
			while($row = mysqli_fetch_array($result)){
				echo "<tr class=\"row-hover-opaque auto-text-colour\">";
				echo "<td>" .$row['FirstName'] . " " . $row['LastName']."</td>";
				echo "<td>".$row['Company']."</td>";
				echo "<td>";
				if ($row['PhoneNumber1'] !== NULL && $row['PhoneNumber1'] !== "") {
					echo "<a href=\"tel:".$row['PhoneNumber1']."\" title=\"Phone Number 1\" class=\"hidden\">
					<span class=\"fas fa-phone-square fa-2x\"></span>
					</a>";
				}
				if ($row['PhoneNumber2'] !== NULL && $row['PhoneNumber2'] !== "") {
					echo "<a href=\"tel:".$row['PhoneNumber2']."\" title=\"Phone Number 2\" class=\"hidden\">
					<span class=\"fas fa-phone-square fa-2x\"></span>
					</a>";
				}
				if ($row['Email'] !== NULL && $row['Email'] !== "") {
					echo "<a href=\"mailto:".$row['Email']."\" title=\"Email\" class=\"hidden\">
					<span class=\"fas fa-envelope-square fa-2x\"></span>
					</a>";
				}
				echo "</td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";
		}
	} else {
		echo "ERROR: Was not able to execute SQL: " . $sql . ".";
		echo "<br/>";
		echo mysqli_error($link);

		echo $link; // For Dedugging Purposes
	}


	?>
</div>
