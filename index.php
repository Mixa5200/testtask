<?php

	session_start();

	include_once "include/config.php";
	include_once "include/functions.php";
	
	if (isset($_GET['page'])) {
		if (preg_match("/^[a-zA-Z0-9_]+$/", $_GET['page'])) {
			$page = strtolower($_GET['page']);
		} else {
			$page = "main";
		}
	} else {
		$page = "main";
	}
	
	if (isset($_GET['do'])) {
		if (preg_match("/^[a-zA-Z0-9_]+$/", $_GET['do'])) {
			$do = strtolower($_GET['do']);
		} else {
			$do = "";
		}
	} else {
		$do = "";
	}
	
	if (isset($_GET['folder'])) {
		if (preg_match("/^[a-zA-Z0-9_]+$/", $_GET['folder'])) {
			$folder = strtolower($_GET['folder']);
		} else {
			$folder = "";
		}
	} else {
		$folder = "";
	}
	
	if ($_SESSION['login'] != "") {
		if ($page == "main" && $do == "") {
			$page_path = "modules/main_page.php";
		}
		elseif ($page == "logout") {
			$page_path = "modules/logout.php";
		}
		elseif ($page == "create_folder") {
			$page_path = "modules/create_folder.php";
		}
		elseif ($page == "main" && $do == "back") {
			$page_path = "modules/back.php";
		}
		elseif ($page == "load_file") {
			$page_path = "modules/load_file.php";
		}
		elseif ($page == "rename_file") {
			$page_path = "modules/rename_file.php";
		}
		elseif ($page == "delete_file") {
			$page_path = "modules/delete_file.php";
		}
		elseif ($page == "download_file") {
			$page_path = "modules/download_file.php";
		} else {
			$page_path = "modules/main_page.php";
		}
	} else {
		if ($page == "auth") {
			$page_path = "modules/auth.php";
		} elseif ($page == "reg") {
			$page_path = "modules/reg.php";
		} else {
			$page_path = "modules/auth.php";
		}
	}
	
	$ConnectDB = mysql_connect($mysql_path, $mysql_login, $mysql_password);
	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title><?php echo $site_title; ?></title>
		<link rel="stylesheet" href="style/main.css" />
	</head>
	<body>
		<div class="container">
			<?php include $page_path; ?>
		</div>
	</body>
</html>
