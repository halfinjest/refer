<?php

$timezone = "Etc/UTC";
date_default_timezone_set($timezone);
if (isset($_GET["path"])) $directory = $_GET["path"];
else header("Location: ?path=./");
$index = scandir($directory);
for ($i = 0, $j = 0; $i < count($index); $i++) if (substr($index[$i], 0, 1) != ".")
{
	$items[$j] = $index[$i];
	$j++;
}

?>
<html>
	<head>
		<title>refer</title>
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" href="octicons/file-directory.svg" />
	</head>
	<body bgcolor="#FFFFFF">
		<div class="header">
			<h1 align="center">refer</h1>
			<h3>Index of <?=$directory?></h3>
		</div>
		<div class="listing">
			<table border="0" cellspacing="0px">
<?php

if ($j > 0) while ($total < $j)
{
	$last += 5;
	echo "\t\t\t\t<tr>\n";
	for ($i = $total; $i < $last && $total < $j; $i++)
	{
		if ($total == 0)
		{
			echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<p align=\"center\"><a href=\"refer.php?path=".dirname($directory)."/\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></a></p><p align=\"center\">[Parent]</p>\n\t\t\t\t\t</td>\n";
			array_unshift($items, "");
			$total++;
			$i++;
			$j++;
		}
		if (is_dir($directory.$items[$total]))
		{
			echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<p align=\"center\"><a href=\"refer.php?path=".$directory.$items[$i]."/\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></a></p><p align=\"center\">$items[$i]</p>\n\t\t\t\t\t</td>\n";
			$total++;
		}
		else
		{
			switch (strtolower(strrchr($items[$total], ".")))
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
			echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<p align=\"center\"><a href=\"".$directory.$items[$i]."\"><img src=\"".$image."\" height=\"50px\"></img></a></p><p align=\"center\">$items[$i]</p>\n\t\t\t\t\t</td>\n";
			$total++;
		}
	}
	echo "\t\t\t\t</tr>\n";
}
else
{
	echo "\t\t\t\t<tr>\n";
	echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<p align=\"left\"><a href=\"refer.php?path=".dirname($directory)."/\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></a></p><p align=\"left\">[Parent]</p>\n\t\t\t\t\t</td>\n";
	echo "\t\t\t\t</tr>\n";
}

?>
			</table>
		</div>
		<div class="footer">
			<h4 align="right">Directory last modified: <?php echo date("F d, Y", stat($directory)["mtime"])." at ".date("H:i:s", stat($directory)["mtime"]).", ".explode("/", $timezone)[1]; ?></h4>
		</div>
	</body>
</html>