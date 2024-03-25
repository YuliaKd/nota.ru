<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Магазин музыкальных инструментов Нота</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<font face="verdana">
	<!--Вызов верхней части сайта-->
	<?php include("head2.php"); ?>
	<h3 style="color: #464545;"><center>Дополнительное оборудование</center></h3>
	<?php
		/* Соединение с базой данных */
		$link = mysqli_connect("localhost", "root", "", "magazin");
		/* проверка соединения */
		if (mysqli_connect_errno($link)) {
			printf("Не удалось подключиться: %s\n", mysqli_connect_error());
			exit();
		}
		/* Select запрос на выборку из базы данных tovari */
		$result = mysqli_query($link, "SELECT * FROM `tovary` WHERE `id_kategorii` = 6");
		mysqli_close($link);
	?>
	<table width="100%" border="1" cellpadding="0" cellspacing="0" align="center">
		<?php
			while($res = mysqli_fetch_assoc($result))
			{
				?>
				<tr>
				<td valign="top" align="center">
					<?php
					echo "<p>Модель: ".$res['Model']."</p>";
					?>
					<img src="images/<?php echo $res['Photo']; ?>.jpg" alt="">
					<?php
					echo "<p>Цена: ".$res['Stoimost']." р.</p>";
					?>
					<form method="get" align="center">
					<button>
						<a style="color: #000000;" href="tov2.php?tovar=<?php echo $res['id_tovara'];?>">Перейти</a>
					</button>
					</form>
					<p></p>
				</td>
				</tr>
				<?php
			}
		?>
		<tr><td height="40px">
		</td></tr>
	</table>
<!--Вызов нижней части сайта-->
<?php include("bottom.php"); ?>