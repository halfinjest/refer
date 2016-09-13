<?php

date_default_timezone_set('America/Chicago');

$directory = "./";
if (isset($_GET["path"])) {
	$directory = $_GET["path"];
}
$index = scandir($directory);
$indexcnt = count($index);
$itemscnt = 0;
$ignore = 0;
for ($i = 0; $i < $indexcnt; $i++) {
	if (substr($index[$i], 0, 1) != "." && substr($index[$i], 0, 1) != "_") {
		$items[] = $index[$i];
		$itemscnt++;
	}
}

?>
<html>
	<head>
		<title>refer.php</title>
		<link rel="stylesheet" href="style.css"></link>
		<link rel="icon" href="octicons/file-directory.svg"></link>
	</head>
	<body bgcolor="#FFFFFF">
		<div class="container">
			<div class="header">
				<h1 align="center">refer.php</h1>
				<h3><?php echo "Index of ".$directory; ?></h3>
			</div>
			<table border="0" cellspacing="0px">
<?php

$total = 0;
$last = 0;
if ($itemscnt != 0) {
	while ($total < $itemscnt) {
		echo "\t\t\t\t<tr>\n";
		$last = $total;
		for ($i = $last; $i < ($last + 5); $i++) {
			if ($total < 1) {
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<p align=\"center\"><a href=\"refer.php?path=".dirname($directory)."/\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></a></p><p align=\"center\">[Parent]</p>\n\t\t\t\t\t</td>\n";
				array_unshift($items, "");
				$total++;
				$itemscnt++;
				$i++;
			}
			if (is_dir($directory.$items[$total])) {
				echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<p align=\"center\"><a href=\"refer.php?path=".$directory.$items[$i]."/\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></a></p><p align=\"center\">$items[$i]</p>\n\t\t\t\t\t</td>\n";
				$total++;
			}
			else {
				switch (strrchr($items[$total], ".")) {
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
			if ($total == $itemscnt) {
				break;
			}
		}
		echo "\t\t\t\t</tr>\n";
	}
}
else {
	echo "\t\t\t\t<tr>\n";
	echo "\t\t\t\t\t<td>\n\t\t\t\t\t\t<p align=\"left\"><a href=\"refer.php?path=".dirname($directory)."/\"><img src=\"octicons/file-directory.svg\" height=\"50px\"></img></a></p><p align=\"left\">[Parent]</p>\n\t\t\t\t\t</td>\n";
	echo "\t\t\t\t</tr>\n";
}

?>
			</table>
		</div>
	</body>
</html>
