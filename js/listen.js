function listen()
{
	window.addEventListener("keydown", function(event)
	{
	     if (event.keyCode == 16)
			document.getElementById("preview").style.visibility = "visible";
	});

	window.addEventListener("keyup", function(event)
	{
	     if (event.keyCode == 16)
			document.getElementById("preview").style.visibility = "hidden";
	});
}