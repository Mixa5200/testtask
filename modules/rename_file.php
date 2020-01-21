<?php
if ($_SESSION['login'] != "") {
	?>
		<div class="header">
			<div class="headerText"><?php echo $site_title ?></div>
		</div>
		<div class="userBlock">
			<div class="userBlockText">
				<div class="userBlockTextContent">
					Привет, <?php ucfirst($_SESSION['login']) ?>
				</div>
				<br />
				<div class="userBlockTextContent">
					<a href="?page=logout">Выйти</a>
				</div>
			</div>
		</div>
		<div class="leftMenu">
			<ul>
				<li>
					<a href="?page=create_folder">Создать папку</a>
				</li>
				<li>
					<a href="?page=load_file">Загрузить файл</a>
				</li>
				<li>
					<a href="?page=main&do=back">Вернуться в корневой каталог</a>
				</li>
			</ul>
		</div>
		<div class="appScreen">
			<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" />
				<table width="95%" border="0">
					<tr>
						<td width="50%" align="right">
							Введите новое имя файла:
						</td>
						<td>
							<input type="text" name="newFilename" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" />
							<input type="submit" value="Переименовать" name="renameFile" />
						</td>
					</tr>
				</table>
			</form>
		</div>
<?php
}
if (isset($_POST['renameFile'])) {
	$newFilename = sanitizeString($_POST['newFilename']);
	if (preg_match("/(^[a-zA-Z0-9]+([a-zA-Z\_0-9\.-]*))$/", $newFilename)) {
		$oldFilename = $_GET['filename'];
		$dir = $_SESSION['path'];
		$path = $dir . $oldFilename;
		$newFilename = $dir . $newFilename;
		if (rename($path, $newFilename)) {
			echo "<script>alert('Файл был успешно переименован'); location.replace('?page=main');</script>";
		}
	} else {
		echo "<script>alert('Недопустимые символы в имени файла');</script>";
	}
}