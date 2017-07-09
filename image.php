<?php

function image($file)
{
	switch ($file)
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
			return "file-media.svg";
		case ".doc":
		case ".docx":
		case ".msg":
		case ".pages":
		case ".rtf":
		case ".txt":
		case ".wpd":
		case ".wps":
			return "file-text.svg";
		case ".m4a":
		case ".mid":
		case ".mp3":
		case ".mpa":
		case ".wav":
		case ".wma":
			return "file-media.svg";
		case ".avi":
		case ".flv":
		case ".mov":
		case ".mp4":
		case ".mpg":
		case ".swf":
		case ".wmv":
			return "file-media.svg";
		case ".pdf":
			return "file-pdf.svg";
		case ".css":
		case ".htm":
		case ".html":
		case ".js":
		case ".php":
		case ".xhtml":
			return "file-code.svg";
		default:
			return "file.svg";
	}
}

?>