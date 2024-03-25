<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Магазин музыкальных инструментов Нота</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
      #zatemnenie {
        background: rgba(102, 102, 102, 0.5);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: none;
      }
      #okno {
        width: 250px;
        height: 90px;
        text-align: center;
        padding: 15px;
        border: 3px solid #000000;
        border-radius: 10px;
        color: #000000;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        background: #fff;
      }
      #zatemnenie:target {display: block;}
      .close {
        display: inline-block;
        border: 1px solid #000000;
        color: #000000;
        padding: 0 12px;
        margin: 10px;
        text-decoration: none;
        background: #f2f2f2;
        font-size: 10pt;
        cursor:pointer;
      }
      .close:hover {background: #c2c2c2;}
    </style>
</head>
<body>
	<font face="verdana">
	<!--Вызов верхней части сайта-->
	<?php include("head2.php"); ?>
	<form method="POST" align="center">
	<h3 style="color: #464545;"><center>Резервирование заказов</center></h3>
	<div align="center">
		<!--Создание элемента числовое поле-->
		<p>Код заказа <input type="text" name="idz" size="20" maxlength="50"></p>
		<button name="add" align="center">
		<div id="zatemnenie">
			<div id="okno">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
					<tr><td><h3 style="color: #464545;">Подтвердите резевирование заказа</h3></td></tr>
					<tr><td valign="bottom"><input type="submit" name="rezzak"  value="Зарезервировать"/>
					<?php
					if (isset($_POST['rezzak'])) //если произошло нажатие на кнопку Зарезервировать
					{
						$idzak='';
						if (isset($_POST['idz']))
						{
							// Передача переменных с формы
							$idzak= $_POST['idz'];
							if ($idzak == '')
							{
								?>
								<script>
									confirm('Поле пустое. Заполните поле');
								</script>
								<?php
								echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=rezzak.php">';
							}
							else
							{
								/*Соединение с базой данных */
								$link = mysqli_connect("localhost", "root", "", "magazin");
								/* проверка соединения */
								if (mysqli_connect_errno()) {
									printf("Не удалось подключиться: %s\n", mysqli_connect_error());
									exit();
								}
								$add = mysqli_query($link, "INSERT INTO `rezerv`(`id_rezerva`, `id_zakaza`) VALUES ('','$idzak')");
								mysqli_close($link);
								?>
								<script>
									confirm('Заказ был зарезервирован');
								</script>
								<?php
								echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=rezzak.php">';
							}
						}
					}
					?>
					<input type="submit" name="otm"  value="Отмена"/>
					<?php
					if (isset($_POST['otm'])) //если произошло нажатие на кнопку Отмена
					{
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=rezzak.php">';
					}
					?>
					</td></tr>
				</table>
			</div>
		</div>
		<a style="color: #000000;" href="#zatemnenie">Зарезервировать заказ</a>
		</button>
		<button name="delrez" align="center">
			Просмотр завершен
			<?php
					if (isset($_POST['delrez'])) //если произошло нажатие на кнопку Просмотр завершен
					{
						$idzak='';
						if (isset($_POST['idz']))
						{
							// Передача переменных с формы
							$idzak= $_POST['idz'];
							if ($idzak == '')
							{
								?>
								<script>
									confirm('Поле пустое. Заполните поле');
								</script>
								<?php
								echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=rezzak.php">';
							}
							else
							{
								/*Соединение с базой данных */
								$link = mysqli_connect("localhost", "root", "", "magazin");
								/* проверка соединения */
								if (mysqli_connect_errno()) {
									printf("Не удалось подключиться: %s\n", mysqli_connect_error());
									exit();
								}
								$add = mysqli_query($link, "DELETE FROM `rezerv` WHERE `id_zakaza` = $idzak");
								mysqli_close($link);
								echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=rezzak.php">';
							}
						}
					}
					?>
		</button>
	</div>
	</form>
	<h3 style="color: #464545;"><center>Зарезервированые заказы</center></h3>
	<?php
		/* Соединение с базой данных */
		$link = mysqli_connect("localhost", "root", "", "magazin");
		/* проверка соединения */
		if (mysqli_connect_errno($link)) {
			printf("Не удалось подключиться: %s\n", mysqli_connect_error());
			exit();
		}
		/* Select запрос на выборку из базы данных magazin */
		$result = mysqli_query($link, "SELECT * FROM `rezerv`");
		/* Вставка html кода в php и вывод его на экран с помощью функции вывода «echo». 
		Создание таблицы с помощью тегов <table> с соответствующими атрибутами. */
			echo "<table width='100%'  border='1' style='border-collapse: collapse', align=center>
		<tr>
		<th>Код резерва</th>
		<th>Код заказа</th>
		</tr>
			";
		/* Цикл прохода по массиву и вывод полей в ячейки создаваемой таблицы */
			while($row=mysqli_fetch_assoc($result))
		{
			echo "<tr align='center'>\n";
			echo "\t<td>".$row['id_rezerva']."</td>\n";
			echo "\t<td>".$row['id_zakaza']."</td>\n";
		}
		echo "</table>";
		/* Завершение работы с базой данных */
		mysqli_close($link);
	?>
	<p align="center">
		<button name="addzak" align="center">
			<a style="color: #000000;" href="addzak.php">Добавить заказ</a>
		</button>
		<button name="izmzak" align="center">
			<a style="color: #000000;" href="izmzak.php">Изменить заказ</a>
		</button>
		<button name="delzak" align="center">
			<a style="color: #000000;" href="delzak.php">Удалить заказ</a>
		</button>
	</p>
<!--Вызов нижней части сайта-->	
<?php include("bottom.php"); ?>