<?php
	if (isset($_POST['auth'])) {
		$login = sanitizeString($_POST['login']);
		$pass = sanitizeString($_POST['pass']);
		if (preg_match("/^[a-zA-Z0-9_]+$/", $login) && strlen($login) >= 3) {
			if (preg_match("/^[a-zA-Z0-9_]+$/", $pass) && strlen($pass) >= 3) {
				$pass_hash = getPasswordHash($login, $pass);
				if (mysql_num_rows(mysql_query("SELECT id FROM `" . $mysql_db . "`.`accounts` WHERE login = '$login' AND password = '$pass_hash'")) != 0) {
					$_SESSION['login'] = $login;
					echo "<script>location.replace('?page=main');</script>";
				} else {
					echo "<script>alert('Неправильный логин и/или пароль');</script>";
				}
			} else {
				echo "<script>alert('Длина пароля должна быть больше 2 символов, либо в пароле присутствуют недопустимые символы');</script>";
			}
		} else {
			echo "<script>alert('Длина логина должна быть больше 2 символов, либо в логине присутствуют недопустимые символы');</script>";
		}
	}
?>
<center>
	<h1>Авторизация</h1>
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
			<td colspan="2" align="center">
				<input type="submit" value="Войти" name="auth" /> или <a href="?page=reg">зарегистрироваться</a>
			</td>
		</tr>
	</table>
</form>
