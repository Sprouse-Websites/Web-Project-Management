
<td>
	<div class=\"progress-contatiner\">
		<?
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
			echo "<div style=\"width:100%\" class=\"overdue progress-bar\">Overdue</div>";
		} else {
			echo "<div style=\"width:".$Ratio."%\" class=\"progress-bar\"></div>";
		}
		?>
</div>
