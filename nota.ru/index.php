<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Магазин музыкальных инструментов Нота</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<font face="verdana">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center"><!--Основная таблица-->
		<div class="head">
		<tr>
		<style>
			a {
				text-decoration: none;
			}
		</style>
		<td width="35%" valign="top" align="left">
			<a href="index.php"><img src="images\nota2.jpg"></a>
		</td>
		</tr>
		</div>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center" style="background-color: #464545">
		<tr width="100%" height="30" valign="top">
		<td width="5%" valign="top" align="center">
		</td>
		<td width="15%" valign="top" align="center">
			<h3 style="color: white;">Авторизация</h3>
		</td>
		<td width="5%" valign="top" align="center">
		</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr width="100%" height="10" border="0" cellpadding="0" cellspacing="0" align="center"><td></td></tr>
	<form method="POST" align="center">
		<!--Объявление текстовых полей-->
		<tr width="100%" height="40" border="0" cellpadding="0" cellspacing="0" align="center"><td>
			<label>Введите имя <input type="text" name="login" size="30" maxlength="10"></label>
		</td></tr>
		<tr width="100%" height="40" border="0" cellpadding="0" cellspacing="0" align="center"><td>
			<label>Введите пароль <input type="password" name="password" size="30" maxlength="10"></label>
		</td></tr>
		<!--Объявление кнопок-->
		<tr width="100%" height="40" border="0" cellpadding="0" cellspacing="0" align="center"><td>
			<input type="submit" name="reset" value="Очистить"> 
			<input type="submit" name="submit" value="Войти">
		</td></tr>
	</form>
	<?php
	if (isset($_POST['submit'])) //если произошло нажатие на кнопку Войти
	{
		$login = trim($_POST['login']);
		$password = trim($_POST['password']);
		if ($login == 'term' && $password = '123')
		{
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index1.php">';
		}
		if ($login == 'rab' && $password = '123')
		{
			echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index2.php">';
		}
	}
	?>
	<tr width="100%" height="460" border="0" cellpadding="0" cellspacing="0" align="center"><td>
	</td></tr>
	</table>
<!--Вызов нижней части сайта-->
<?php include("bottom.php"); ?>