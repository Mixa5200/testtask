<?php
if ($_SESSION['login'] != "") {
	if ($_SESSION['path'] == "") {
		$_SESSION['path'] = "./fileManager/" . $_SESSION['login'] . "/";
	}
	$page = "<div class=\"header\">
				<div class=\"headerText\">$site_title</div>
			 </div>
			 <div class=\"userBlock\">
				<div class=\"userBlockText\">
					<div class=\"userBlockTextContent\">
						Привет, " . ucfirst($_SESSION['login']) . "
					</div>
					<br />
					<div class=\"userBlockTextContent\">
						<a href=\"?page=logout\">Выйти</a>
					</div>
				</div>
			</div>
			<div class=\"leftMenu\">
				<ul>
					<li>
						<a href=\"?page=create_folder\">Создать папку</a>
					</li>
					<li>
						<a href=\"?page=load_file\">Загрузить файл</a>
					</li>
					<li>
						<a href=\"?page=main&do=back\">Вернуться в корневой каталог</a>
					</li>
				</ul>
			</div>
			<div class=\"appScreen\">" . 
				getFilesFromFolder($_SESSION['path'], $_GET['folder']) .
			"
			</div>";
}
echo $page;
?>