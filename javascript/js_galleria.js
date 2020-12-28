var slideIndex = 1;
showSlides(slideIndex);
window.onload = scorriLink(); slide();
function slide(){
  var links = document.getElementsByTagName("span");
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
  }
}
function scorriLink(){
var links = document.getElementsByTagName("a");
for (var i=0; i<links.length; i++) {
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
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
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

