<?php
	$_SESSION['path'] = "./fileManager/" . $_SESSION['login'] . "/";
	echo "<script>location.replace(\"?page=main\");</script>";
?>