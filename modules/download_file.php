<?php
	session_start();
	if ($_SESSION['login'] != "") {
		ob_end_clean();
		$path = "." . $_SESSION['path'] . $_GET['filename'];
		$file_extension = strtolower(substr(strrchr($filename, "."), 1));
		switch ($file_extension) {
			case "pdf": $ctype = "application/pdf"; break;
			case "exe": $ctype = "application/octet-stream"; break;
			case "zip": $ctype = "application/zip"; break;
			case "doc": $ctype = "application/msword"; break;
			case "xls": $ctype = "application/vnd.ms-excel"; break;
			case "ppt": $ctype = "application/vnd.ms-powerpoint"; break;
			case "mp3": $ctype = "audio/mp3"; break;
			case "gif": $ctype = "image/gif"; break;
			case "png": $ctype = "image/png"; break;
			case "jpeg":
			case "jpg": $ctype = "image/jpg"; break;
			default: $ctype = "application/force-download";
		}
		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: private", false);
		header("Content-Type: $ctype");
		header("Content-Disposition: attachment; filename=\"" . basename($path) . "\";");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: " . filesize($path));
		readfile($path);
		exit();
	}
?>