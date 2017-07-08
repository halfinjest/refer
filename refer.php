<?php

if (isset($_GET["path"]) && file_exists($_GET["path"]) && substr($_GET["path"], 0, 2) == "./") $directory = $_GET["path"];
else header("Location: ?path=./");
define("CONF_COLS", 4);

?>
<html>
<head>
<title>Index of <?=$directory?></title>
<link rel="stylesheet" href="css/refer.css" />
<link rel="icon" href="images/icon.ico" />
<script src="js/name.js"></script>
</head>
<body>
<div class="menubar">
<p id="path"><?=$directory?></p>
</div>
<div class="listing">
<table border="0" cellspacing="0px">
<?php

$i = 0;
$index = array_slice(scandir($directory), 1);
$j = 0;
$length = count($index);
if ($length > 1) while ($i < $length - 1)
{
	$j += CONF_COLS;
	echo "<tr>\n";
	if ($i == 0) echo "<td>\n<a href=\"?path=".dirname($directory)."/\">\n<div class=\"item\" onmouseout=\"path('".$directory."')\" onmouseover=\"path('".dirname($directory)."/')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/file-symlink-directory.svg\"></img></p>\n<p align=\"center\">[Parent]</p>\n</div>\n</a>\n</td>\n";
	while ($i < $j - 1 && ++$i < $length)
	{
		if (strlen($index[$i]) > 20) $name = substr($index[$i], 0, 18)."..";
		else $name = $index[$i];
		if (is_dir($directory.$index[$i])) echo "<td>\n<a href=\"?path=".$directory.$index[$i]."/\">\n<div class=\"item\" onmouseout=\"path('".$directory."')\" onmouseover=\"path('".$directory.$index[$i]."/')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/file-directory.svg\"></img></p>\n<p align=\"center\">".$name."</p>\n</div>\n</a>\n</td>\n";
		else
		{
			switch (strtolower(strrchr($index[$i], ".")))
			{
				case ".bmp":
				case ".gif":
				case ".jpg":
				case ".jpeg":
				case ".ico";
				case ".png":
				case ".psd":
				case ".svg";
				case ".xcf":
					$image = "file-media.svg";
					break;
				case ".doc":
				case ".docx":
				case ".msg":
				case ".pages":
				case ".rtf":
				case ".txt":
				case ".wpd":
				case ".wps":
					$image = "file-text.svg";
					break;
				case ".m4a":
				case ".mid":
				case ".mp3":
				case ".mpa":
				case ".wav":
				case ".wma":
					$image = "file-media.svg";
					break;
				case ".avi":
				case ".flv":
				case ".mov":
				case ".mp4":
				case ".mpg":
				case ".swf":
				case ".wmv":
					$image = "file-media.svg";
					break;
				case ".pdf":
					$image = "file-pdf.svg";
					break;
				case ".css":
				case ".htm":
				case ".html":
				case ".js":
				case ".php":
				case ".xhtml":
					$image = "file-code.svg";
					break;
				default:
					$image = "file.svg";
					break;
			}
			echo "<td>\n<a href=\"".$directory.$index[$i]."\">\n<div class=\"item\" onmouseout=\"path('".$directory."')\" onmouseover=\"path('".$directory.$index[$i]."')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/".$image."\"></img></p>\n<p align=\"center\">".$name."</p>\n</div>\n</a>\n</td>\n";
		}
	}
	if ($length < CONF_COLS) for ($i = $length; $i < CONF_COLS; $i++) echo "<td>\n</td>\n";
	echo "</tr>\n";
}
else echo "<tr>\n<td>\n<a href=\"?path=".dirname($directory)."/\">\n<div class=\"item\" onmouseout=\"path('".$directory.$index[$i]."')\" onmouseover=\"path('".dirname($directory)."/')\">\n<p align=\"center\"><img height=\"50px\" src=\"images/file-symlink-directory.svg\"></img></p>\n<p align=\"center\">[Parent]</p>\n</div>\n</a>\n</td>\n<td>\n</td>\n<td>\n</td>\n<td>\n</td>\n</tr>\n";
?>
</table>
</div>
</body>
</html>