$(document).ready(function() {
		
		$("html,body").scrollTop(1300);
		$("html,body").scrollLeft(1400);
		
	var theUser = document.querySelector(".user");
	var map = document.querySelector(".map");

	map.addEventListener("click", function(event) {
		var xPosition = event.clientX - map.getBoundingClientRect().left - (theUser.clientWidth / 2);
		var yPosition = event.clientY - map.getBoundingClientRect().top - (theUser.clientHeight / 2);
		theUser.style.left = xPosition + "px";
		theUser.style.top = yPosition + "px";
	});

});