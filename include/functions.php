<?php

function sanitizeString($str) {
	$str = strip_tags($str);
	$str = htmlentities($str);
	$str = htmlspecialchars($str);
	return $str;
}

function getPasswordHash($username, $pword) {
	$username = strtoupper($username);
	$pword = strtoupper($pword);
	return md5($username . ":" . $pword);
}

function getFilesFromFolder($path, $folder) {
	$files = array();
	$folders = array();
	if ($folder != "") {
		$path = $path . $folder . "/";
		$_SESSION['path'] = $path;
	}
		if ($handle = opendir($path)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != "." && $file != "..") {
					if (is_dir($path . $file)) {
						array_push($folders, $file);
					} else {
						array_push($files, $file);
					}
				}
			}
			closedir($handle);
		}
		if (sizeof($files) || sizeof($folders)) {
			$pageFiles = "<table width=\"48%\" height=\"95%\" border=\"0\"><tr><th>Папки</th></tr>";
			foreach ($folders AS $folder) {
				$pageFiles .= "<tr><td align=\"center\" width=\"100%\"><a href=\"?page=main&folder=$folder\">$folder</a></td></tr>";
			}
			$pageFiles .= "</table><table width=\"48%\" height=\"95%\" border=\"0\"><tr><th>Файлы</th></tr>";
			foreach ($files AS $file) {
				$pageFiles .= "<tr><td width=\"100%\" align=\"center\">$file<br /><a href=\"?page=rename_file&filename=$file\">переименовать</a> <a href=\"?page=delete_file&filename=$file\">удалить</a> <a href=\"modules/download_file.php?filename=$file\" target=\"_blank\">скачать</a></td></tr>";
			}
			$pageFiles .= "</table>";
		} else {
			$pageFiles = "<table width=\"98%\" height=\"95\" border=\"0\"><tr><th>Данная папка пуста</th></tr></table>";
		}
		
	return $pageFiles;
}