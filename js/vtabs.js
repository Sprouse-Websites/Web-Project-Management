function openSetting(evt, setting) {
  var i, vtabcontent, vtablinks;
  vtabcontent = document.getElementsByClassName("vtabcontent");
  for (i = 0; i < vtabcontent.length; i++) {
    vtabcontent[i].style.display = "none";
  }
  vtablinks = document.getElementsByClassName("vtablinks");
  for (i = 0; i < vtablinks.length; i++) {
    vtablinks[i].className = vtablinks[i].className.replace(" active", "");
  }
  document.getElementById(setting).style.display = "block";
  evt.currentTarget.className += " active";
}
