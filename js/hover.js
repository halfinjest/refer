function hover(background, item, path, type)
{
	document.getElementById(item).style.background = background ? "rgba(219, 219, 219, 0.6)" : "transparent";
	document.getElementById("path").innerHTML = path;
	switch (type)
	{
		case '':
			document.getElementById("preview").style.backgroundImage = "";
			break;
		case 'image':
			document.getElementById("preview").style.backgroundImage = "url('" + path + "')";
			break;
		default: break;
	}
}