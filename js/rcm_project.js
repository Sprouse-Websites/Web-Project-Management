function rcm_project_menu_func(event){
  event.preventDefault();
	document.getElementById("ProjectOptionList").style.visibility = "visible";
	document.getElementById("ProjectOptionList").style.opacity = "1";
	document.getElementById("ProjectOptionList").style.left = event.x + 10;
	document.getElementById("ProjectOptionList").style.top = event.y + 10;
};
function rcm_project_cls_menu_func(event) {
	document.getElementById("ProjectOptionList").style.visibility = "hidden";
	document.getElementById("ProjectOptionList").style.opacity = "0";
}

/* When the user clicks on the button,
toggle between hiding and showing the dropdown content */
function dropdown() {
	document.getElementById("ProjectOptionList").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
	if (!event.target.matches('.dropbtn')) {
		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
			var openDropdown = dropdowns[i];
			if (openDropdown.classList.contains('show')) {
				openDropdown.classList.remove('show');
			}
		}
	}
}
