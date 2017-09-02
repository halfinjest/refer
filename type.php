<?php

function type($extension)
{
	switch ($extension)
	{
		case ".bmp":
		case ".gif":
		case ".jpg":
		case ".jpeg":
		case ".ico":
		case ".png":
		case ".psd":
		case ".svg":
		case ".xcf":
			return "image";
		case ".doc":
		case ".docx":
		case ".msg":
		case ".pages":
		case ".rtf":
		case ".txt":
		case ".wpd":
		case ".wps":
			return "text";
		case ".m4a":
		case ".mid":
		case ".mp3":
		case ".mpa":
		case ".wav":
		case ".wma":
			return "media";
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
		case ".css":
		case ".htm":
		case ".html":
		case ".js":
		case ".php":
		case ".xhtml":
			return "code";
		default:
			return "other";
	}
}

function image($extension)
{
	switch (type($extension))
	{
		case "image":
		case "media":
			return "file-media.svg";
		case "text":
			return "file-text.svg";
		case "pdf":
			return "file-pdf.svg";
		case "code":
			return "file-code.svg";
		case "other":
			return "file.svg";
	}
}

?>