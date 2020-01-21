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
			<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" />
				<table width="95%" border="0">
					<tr>
						<td width="50%" align="right">
							Выберите файл:
						</td>
						<td>
							<input type="file" name="uploadFile" />
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center" />
							<input type="submit" value="Загрузить" />
						</td>
					</tr>
				</table>
			</form>
		</div>
<?php
}
if (isset($_FILES['uploadFile']['name'])) {
	$fileName = $_FILES['uploadFile']['name'];
	$dir = $_SESSION['path'];
	if (copy($_FILES['uploadFile']['tmp_name'], $dir . $fileName)) {
		echo "<script>alert('Файл был успешно загружен'); location.replace('?page=main');</script>";
	} else {
		echo "<script>alert('Ошибка при загрузке файла');</script>";
	}
}
							