var slideIndex = 1;
showSlides(slideIndex);
window.onload = scorriLink(); slide(); hideGalleria();
function slide(){
  const links = Array.from(document.getElementsByTagName("span"));
  for (var i=0; i<links.length; i++) {
  if (links[i].getAttribute("id") == "dot1") {
    links[i].onclick = function() {
      currentSlide(1);
      return false;}
  }
  if (links[i].getAttribute("id") == "dot2") {
    links[i].onclick = function() {
      currentSlide(2);
      return false;}
  }
  if (links[i].getAttribute("id") == "dot3") {
    links[i].onclick = function() {
      currentSlide(3);
      return false;}
  }
  if (links[i].getAttribute("id") == "dot4") {
    links[i].onclick = function() {
      currentSlide(4);
      return false;}
  }
	if (links[i].getAttribute("id") == "dot5") {
    links[i].onclick = function() {
      currentSlide(5);
      return false;}
  }
	if (links[i].getAttribute("id") == "dot6") {
    links[i].onclick = function() {
      currentSlide(6);
      return false;}
  }
	if (links[i].getAttribute("id") == "dot7") {
    links[i].onclick = function() {
      currentSlide(7);
      return false;}
  }
	if (links[i].getAttribute("id") == "dot8") {
    links[i].onclick = function() {
      currentSlide(8);
      return false;}
  }
	if (links[i].getAttribute("id") == "dot9") {
    links[i].onclick = function() {
      currentSlide(9);
      return false;}
  }
	if (links[i].getAttribute("id") == "dot10") {
    links[i].onclick = function() {
      currentSlide(10);
      return false;}
  }
  }
	
	
	const links_preview = Array.from(document.getElementsByClassName("anteprima"));
	for (i=0; i<links_preview.length; i++) {
  if (links_preview[i].getAttribute("id") == "anteprima1") {
    links_preview[i].onclick = function() {
      currentSlide(1);
      return false;}
  }
  if (links_preview[i].getAttribute("id") == "anteprima2") {
    links_preview[i].onclick = function() {
      currentSlide(2);
      return false;}
  }
  if (links_preview[i].getAttribute("id") == "anteprima3") {
    links_preview[i].onclick = function() {
      currentSlide(3);
      return false;}
  }
  if (links_preview[i].getAttribute("id") == "anteprima4") {
    links_preview[i].onclick = function() {
      currentSlide(4);
      return false;}
  }
	if (links_preview[i].getAttribute("id") == "anteprima5") {
    links_preview[i].onclick = function() {
      currentSlide(5);
      return false;}
  }
	if (links_preview[i].getAttribute("id") == "anteprima6") {
    links_preview[i].onclick = function() {
      currentSlide(6);
      return false;}
  }
	if (links_preview[i].getAttribute("id") == "anteprima7") {
    links_preview[i].onclick = function() {
      currentSlide(7);
      return false;}
  }
	if (links_preview[i].getAttribute("id") == "anteprima8") {
    links_preview[i].onclick = function() {
      currentSlide(8);
      return false;}
  }
	if (links_preview[i].getAttribute("id") == "anteprima9") {
    links_preview[i].onclick = function() {
      currentSlide(9);
      return false;}
  }
	if (links_preview[i].getAttribute("id") == "anteprima10") {
    links_preview[i].onclick = function() {
      currentSlide(10);
      return false;}
  }
  
}
}
function scorriLink(){
const links = Array.from(document.getElementsByTagName("a"));
for (var i=0; i<links.length; ++i) {
  if (links[i].getAttribute("class") == "next") {
    links[i].onclick = function() {
      plusSlides(+1);
      return false;}

  }
  if (links[i].getAttribute("class") == "prev") {
    links[i].onclick = function() {
      plusSlides(-1);
      return false;}
}
}
}

// JavaScript Document
// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}
// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}
function showSlides(n) {
  var i;
  const slides = Array.from(document.getElementsByClassName("mySlides"));
  const dots = Array.from(document.getElementsByClassName("dot"));
  if (n > slides.length) {slideIndex = 1} 
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"; 
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block"; 
  dots[slideIndex-1].className += " active";
}

//SE JAVASCRIPT è DISABILITATO VISUALIZZA LE IMMAGINI UNA DOPO L'ALTRA, ALTRIMENTI VISUALIZZA SOLO LO SLIDESHOW
function hideGalleria() {
	const mediaQuery = window.matchMedia("handheld, screen and (max-width:640px), only screen and (max-device-width:640px)")
	
	if (mediaQuery.matches) {
		document.getElementById("galleriaAnteprime").style.display = 'none';
		document.getElementById("galleriaSlidePunti").style.display = 'block';
	}
}
