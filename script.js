let apercu = document.getElementsByClassName("apercu");

for (var i = 0; i < apercu.length; i++) {
  apercu[i].onclick = affichageSlide;
}

document.getElementById("photo").setAttribute("src", apercu[0].getAttribute("src"));

function affichageSlide() {
  document.getElementById("photo").setAttribute("src", this.getAttribute("src"));
}
