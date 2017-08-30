<?php

include("image.php");

define("CONF_COL", 4);
define("CONF_MAX", 20);

if (isset($_GET["path"]) && file_exists($_GET["path"]) && substr($_GET["path"], 0, 2) == "./") $directory = $_GET["path"];
else header("Location: ?path=./");

?>
<html>
<head>
<title>Index of <?=$directory?></title>
<link rel="stylesheet" href="css/refer.css" />
<link rel="icon" href="images/icon.ico" />
<script src="js/path.js"></script>
</head>
<body>
<div class="menubar">
<p id="path"><?=$directory?></p>
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
	if ($i == 0) printf("<td>\n<a href=\"?path=".dirname($directory)."/\">\n<div class=\"item\" onmouseout=\"path('".$directory."')\" onmouseover=\"path('".dirname($directory)."/')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/file-symlink-directory.svg\"></img></p>\n<p align=\"center\">[Parent]</p>\n</div>\n</a>\n</td>\n");
	while ($i < $j - 1 && ++$i < $length)
	{
		if (strlen($index[$i]) > CONF_MAX) $name = substr($index[$i], 0, CONF_MAX - 2)."..";
		else $name = $index[$i];
		if (is_dir($directory.$index[$i])) printf("<td>\n<a href=\"?path=".$directory.$index[$i]."/\">\n<div class=\"item\" onmouseout=\"path('".$directory."')\" onmouseover=\"path('".$directory.$index[$i]."/')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/file-directory.svg\"></img></p>\n<p align=\"center\">".$name."</p>\n</div>\n</a>\n</td>\n");
		else printf("<td>\n<a href=\"".$directory.$index[$i]."\">\n<div class=\"item\" onmouseout=\"path('".$directory."')\" onmouseover=\"path('".$directory.$index[$i]."')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/".image(strtolower(strrchr($index[$i], ".")))."\"></img></p>\n<p align=\"center\">".$name."</p>\n</div>\n</a>\n</td>\n");
	}
	if ($length < CONF_COL) for ($i = $length; $i < CONF_COL; $i++) printf("<td>\n</td>\n");
	printf("</tr>\n");
}
else printf("<tr>\n<td>\n<a href=\"?path=".dirname($directory)."/\">\n<div class=\"item\" onmouseout=\"path('".$directory.$index[$i]."')\" onmouseover=\"path('".dirname($directory)."/')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/file-symlink-directory.svg\"></img></p>\n<p align=\"center\">[Parent]</p>\n</div>\n</a>\n</td>\n<td>\n</td>\n<td>\n</td>\n<td>\n</td>\n</tr>\n");

?>
</table>
</div>
</body>
</html>