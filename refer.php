<?php

include("get_type.php");

define("CONF_COL", 4);
define("CONF_MAX", 20);

function get_image($extension)
{
	switch (get_type($extension))
	{
		case "code": return "file-code.svg";
		case "image":
		case "media": return "file-media.svg";
		case "other": return "file.svg";
		case "pdf": return "file-pdf.svg";
		case "text": return "file-text.svg";
	}
}

function get_item($directory, $id, $image, $name, $path, $prefix, $suffix)
{
	return "<td>\n<a href=\"".$prefix.$path.$suffix."\">\n<div class=\"item\" id=\"".$id."\" onmouseout=\"hover(0, '".$id."', '".$directory."', '')\" onmouseover=\"hover(1, '".$id."', '".$path."', '".(is_dir($path) ? "directory" : get_type(strtolower(strrchr($path, "."))))."')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/".$image."\"></img></p>\n<p align=\"center\">".$name."</p>\n</div>\n</a>\n</td>\n";
}

function get_safe_path($path)
{
	return str_replace("//", "/", str_replace("..", "", $path));
}

if (!isset($_GET["path"]) || !file_exists($_GET["path"]) || !substr($_GET["path"], 0, 1) == "." || !substr($_GET["path"], 1, 2) == "/") header("Location: ?path=./");
$directory = get_safe_path($_GET["path"]);
if ($directory != $_GET["path"]) header("Location: ?path=".$directory);
if (isset($_GET["theme"]) && $_GET["theme"] == "dark")
{
	$suffix = "&theme=dark";
	$change = "";
	$theme = "dark";
}
else
{
	$suffix = "";
	$change = "&theme=dark";
	$theme = "light";
}

?>
<html>
<head>
<title>Index of <?=$directory?></title>
<link rel="stylesheet" href="css/<?=$theme?>-style.css" />
<link rel="icon" href="images/icon.ico" />
<script src="js/hover.js"></script>
<script src="js/listen.js"></script>
</head>
<body onload="listen()">
<div class="menubar">
<div class="menu-left"><p id="path"><?=$directory?></p></div>
<div class="menu-right"><p><a href="?path=<?=$directory.$change?>">change theme</a></p></div>
</div>
<div class="listing">
<table border="0" cellspacing="0px">
<?php

$i = 0;
$j = 0;
$index = array_slice(scandir($directory), 1);
$directories = [];
$files = [];
$length = count($index);
for ($i = 0; $i < $length; $i++)
{
	if (is_dir($directory.$index[$i])) $directories[] = $index[$i];
	else $files[] = $index[$i];
}
$i = 0;
$index = array_merge($directories, $files);
if ($length > 1) while ($i < $length - 1)
{
	$j += CONF_COL;
	printf("<tr>\n");
	if ($i == 0) printf(get_item($directory, $i, "file-symlink-directory.svg", "[parent]", dirname($directory)."/", "?path=", $suffix));
	while ($i < $j - 1 && ++$i < $length)
	{
		$path = $directory.$index[$i];
		if (strlen($index[$i]) > CONF_MAX) $name = substr($index[$i], 0, CONF_MAX - 2)."..";
		else $name = $index[$i];
		if (is_dir($path)) printf(get_item($directory, $i, "file-directory.svg", $name, $path."/", "?path=", $suffix));
		else printf(get_item($directory, $i, get_image(strtolower(strrchr($path, "."))), $name, $path, "", $suffix));
	}
	if ($length < CONF_COL) for ($i = $length; $i < CONF_COL; $i++) printf("<td>\n</td>\n");
	printf("</tr>\n");
}
else printf(get_item($directory, $i, "file-symlink-directory.svg", "[parent]", dirname($directory)."/", "?path=", $suffix)."<td>\n</td>\n<td>\n</td>\n<td>\n</td>\n</tr>\n");

?>
</table>
</div>
<div class="preview" id="preview"></div>
</body>
</html>