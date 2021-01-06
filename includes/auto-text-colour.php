<style>
.light-text {
	color: #efefef;
}

.dark-text {
	color: #111;
}
</style>

<script type="text/javascript">
var element, bgColour, brightness, r, g, b, hsp;

function adjustTextColour() {
	element = document.querySelectorAll('.auto-text-colour');
	var no_profile_classes = document.querySelectorAll('.auto-text-colour').length;
	var i = 0;
	while (no_profile_classes > i) {
		// Get the element's background color
		bgColour = window.getComputedStyle(element[i], null).getPropertyValue('background-color');

		// Call lightOrDark function to get the brightness (light or dark)
		brightness = lightOrDark(bgColour);

		// If the background color is dark, add the light-text class to it
		if (brightness == 'dark') {
			element[i].classList.add('light-text');
		} else {
			element[i].classList.add('dark-text');
		}
		i++;
	}

	function lightOrDark(color) {
		// Check the format of the color, HEX or RGB?
		if (color.match(/^rgb/)) {

			// If HEX --> store the red, green, blue values in separate variables
			color = color.match(/^rgba?\((\d+),\s*(\d+),\s*(\d+)(?:,\s*(\d+(?:\.\d+)?))?\)$/);

			r = color[1];
			g = color[2];
			b = color[3];
		} else {
			// If RGB --> Convert it to HEX: https://gist.github.com/983661
			color = +("0x" + color.slice(1).replace(
				color.length < 5 && /./g, '$&$&'
			));

			r = color >> 16;
			g = color >> 8 & 255;
			b = color & 255;
		}

		// HSP (Highly Sensitive Poo) equation from https://alienryderflex.com/hsp.html
		hsp = Math.sqrt(
			0.299 * (r * r) +
			0.587 * (g * g) +
			0.114 * (b * b)
		);

		// Using the HSP value, determine whether the color is light or dark
		if (hsp > 127.5) {
			return 'light';
		} else {
			return 'dark';
		}
	}
}
$(document).ready(function() {
	adjustTextColour();
});

</script>
