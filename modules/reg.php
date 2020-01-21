<?php
	if (isset($_POST['register'])) {
		$login = sanitizeString($_POST['login']);
		$pass = sanitizeString($_POST['pass']);
		$repass = sanitizeString($_POST['repass']);
		if (preg_match("/^[a-zA-Z0-9_]+$/", $login) && strlen($login) >= 3) {
			if (preg_match("/^[a-zA-Z0-9_]+$/", $pass) && strlen($pass) >= 3) {
				if ($repass == $pass) {
					if (mysql_num_rows(mysql_query("SELECT * FROM `" . $mysql_db . "`.`accounts` WHERE login = '$login'", $ConnectDB)) == 0) {
						$pass_hash = getPasswordHash($login, $pass);
						$query = mysql_query("INSERT INTO `" . $mysql_db . "`.`accounts` SET login = '$login', password = '$pass_hash'", $ConnectDB);
						if ($query) {
							$folder = "fileManager/" . $login;
							mkdir($folder);
							echo "<script>alert('Регистрация прошла успешно'); location.replace('?page=main');</script>";
						} else {
							echo "<script>alert('Ошибка при регистрации'); location.replace('?page=reg');</script>";
						}
					} else {
						echo "<script>alert('Введеный логин уже занят'); location.replace('?page=reg');</script>";
					}
				} else {
					echo "<script>alert('Введенные пароли не совпадают'); location.replace('?page=reg');</script>";
				}
			} else {
				echo "<script>alert('Длина пароля должна быть больше 2 символов. Пароль должен состоять только из латинских букв, цифр и знака \"_\"'); location.replace('?page=reg');</script>";
			}
		} else {
			echo "<script>alert('Длина логина должна быть быть больше 2 символов. Логин должен состоять только из латинских букв, цифр и знака \"_\"'); location.replace('?page=reg');</script>";
		}
	}
?>
<center>
	<h1>Регистрация</h1>
</center>
<form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
	<table width="100%" border="0">
		<tr>
			<td align="right" width="40%">Логин:</td>
			<td>
				<input type="text" placeholder="Логин" name="login" />
			</td>
		</tr>
		<tr>
			<td align="right">Пароль:</td>
			<td>
				<input type="password" placeholder="Пароль" name="pass" />
			</td>
		</tr>
		<tr>
			<td align="right">Подтверждение пароля:</td>
			<td>
				<input type="password" placeholder="Подтверждение пароля" name="repass" />
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="submit" value="Зарегистрироваться" name="register" /> или <a href="?page=main">войти</a>
			</td>
		</tr>
	</table>
</form>