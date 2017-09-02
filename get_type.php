<?php

function get_type($extension)
{
	switch ($extension)
	{
		case ".css":
		case ".htm":
		case ".html":
		case ".js":
		case ".php":
		case ".xhtml":
			return "code";
		case ".bmp":
		case ".gif":
		case ".jpg":
		case ".jpeg":
		case ".ico":
		case ".png":
		case ".svg":
			return "image";
		case ".m4a":
		case ".mid":
		case ".mp3":
		case ".mpa":
		case ".wav":
		case ".wma":
		case ".avi":
		case ".flv":
		case ".mov":
		case ".mp4":
		case ".mpg":
		case ".swf":
		case ".wmv":
			return "media";
		case ".pdf":
			return "pdf";
		case ".doc":
		case ".docx":
		case ".msg":
		case ".pages":
		case ".rtf":
		case ".txt":
		case ".wpd":
		case ".wps":
			return "text";
		default: return "other";
	}
}

function get_image($extension)
{
	switch (get_type($extension))
	{
		case "other": return "file.svg";
		case "code": return "file-code.svg";
		case "image":
		case "media": return "file-media.svg";
		case "pdf": return "file-pdf.svg";
		case "text": return "file-text.svg";
	}
}

?>