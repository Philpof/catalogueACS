let apercu = document.getElementsByClassName("apercu");

for (var i = 0; i < apercu.length; i++) {
  apercu[i].onclick = affichageSlide;
}

function affichageSlide() {
  document.getElementById("photo").setAttribute("src", this.getAttribute("src"));
}
