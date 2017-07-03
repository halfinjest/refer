<?php

$timezone = "Etc/UTC";
date_default_timezone_set($timezone);
if (isset($_GET["path"])) $directory = $_GET["path"];
else header("Location: ?path=./");
$index = array_slice(scandir($directory), 1);

?>
<html>
	<head>
		<title>Index of <?=$directory?></title>
		<link rel="stylesheet" href="css/refer.css" />
		<link rel="icon" href="octicons/file-directory.svg" />
	</head>
	<body>
		<div class="header">
			<h1 align="center">refer</h1>
			<h3>Index of <?=$directory?></h3>
		</div>
		<div class="listing">
			<table border="0" cellspacing="0px">
<?php

$total = count($index);
if ($total > 1) while ($i < $total - 1)
{
	$last += 4;
	echo "<tr>\n";
	if ($i == 0) echo "<td>\n<a href=\"refer.php?path=".dirname($directory)."/\">\n<div class=\"item\">\n<p align=\"center\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></p><p align=\"center\">[Parent]</p>\n</div>\n</a>\n</td>\n";
	while ($i < $last - 1 && ++$i < $total)
	{
		if (is_dir($directory.$index[$i])) echo "<td>\n<a href=\"refer.php?path=".$directory.$index[$i]."/\">\n<div class=\"item\">\n<p align=\"center\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></p><p align=\"center\">".$index[$i]."</p>\n</div>\n</a>\n</td>\n";
		else
		{
			switch (strtolower(strrchr($index[$i], ".")))
			{
				case ".bmp":
				case ".gif":
				case ".jpg":
				case ".jpeg":
				case ".png":
				case ".psd":
				case ".svg";
				case ".xcf":
					$image = "octicons/file-media.svg";
					break;
				case ".doc":
				case ".docx":
				case ".msg":
				case ".pages":
				case ".rtf":
				case ".txt":
				case ".wpd":
				case ".wps":
					$image = "octicons/file-text.svg";
					break;
				case ".m4a":
				case ".mid":
				case ".mp3":
				case ".mpa":
				case ".wav":
				case ".wma":
					$image = "octicons/file-media.svg";
					break;
				case ".avi":
				case ".flv":
				case ".mov":
				case ".mp4":
				case ".mpg":
				case ".swf":
				case ".wmv":
					$image = "octicons/file-media.svg";
					break;
				case ".pdf":
					$image = "octicons/file-pdf.svg";
					break;
				case ".css":
				case ".htm":
				case ".html":
				case ".js":
				case ".jsp":
				case ".php":
				case ".xhtml":
					$image = "octicons/file-code.svg";
					break;
				default:
					$image = "octicons/file.svg";
					break;
			}
			echo "<td>\n<a href=\"".$directory.$index[$i]."\">\n<div class=\"item\">\n<p align=\"center\"><img src=\"".$image."\" height=\"50px\"></img></p><p align=\"center\">".$index[$i]."</p>\n</div>\n</a>\n</td>\n";
		}
	}
	if ($total < 4) for ($i = $total; $i < 4; $i++) echo "<td>\n</td>\n";
	echo "</tr>\n";
}
else echo "<tr>\n<td>\n<a href=\"refer.php?path=".dirname($directory)."/\">\n<div class=\"item\">\n<p align=\"center\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></p><p align=\"center\">[Parent]</p>\n</div>\n</a>\n</td>\n<td>\n</td>\n<td>\n</td>\n<td>\n</td>\n</tr>\n";
?>
			</table>
		</div>
	</body>
</html>