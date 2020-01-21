<?php
	if ($_SESSION['login'] != "") {
		$_SESSION['login'] = "";
		session_destroy();
		echo "<script>location.replace('?page=main')</script>";
	}
?>