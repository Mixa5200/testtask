<?php
if ($_SESSION['login'] != "") {
	$filename = $_GET['filename'];
	$dir = $_SESSION['path'];
	$path = $dir . $filename;
	if (unlink($path)) {
		echo "<script>alert('Файл был успешно удален'); location.replace('?page=main');</script>";
	} else {
		echo "<script>alert('Ошибка при удалении файла'); location.replace('?page=main');</script>";
	}
}