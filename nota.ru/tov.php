<?
	$idt = $_REQUEST['tovar'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Магазин музыкальных инструментов Нота</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
		.scale {
			transition: 1s; /* Время эффекта */
		}
		.scale:hover {
			transform: scale(1.4); /* Увеличиваем масштаб */
		}
	</style>
</head>
<body>
	<font face="verdana">
	<!--Вызов верхней части сайта-->
	<?php include("head1.php"); ?>
	<?php
	/* Соединение с базой данных */
	$link = mysqli_connect("localhost", "root", "", "magazin");
	/* проверка соединения */
	if (mysqli_connect_errno($link)) {
		printf("Не удалось подключиться: %s\n", mysqli_connect_error());
		exit();
	}
	/* Select запрос на выборку из базы данных tovari */
	$result = mysqli_query($link, "SELECT * FROM `tovary` WHERE `id_tovara`=$idt;");
	?>
	
	<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
		<?php
		while($res = mysqli_fetch_assoc($result))
		{
		?>
		<tr><td>
			<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
				<tr><td width="10%">
					<a href="#" onclick="history.back(-1)" style="color: black; align-left"><h4 style="color: #464545;">Назад</h4></a>
				</td>
				<td width="90%" align="center">
					<h3 style="color: #464545;" align="center"><?php echo $res['Model']; ?></h3>
				</td></tr>
			</table>
		</td></tr>
		<tr><td>
			<table border="1" cellspacing="0" cellpadding="0" width="100%" height="400" align="center">
				<tr><td width="40%" align="center"  valign="middle">
					<img src="images/<?php echo $res['Photo']; ?>.jpg" alt="" class="scale">
				</td>
				<td width="60%" align="center" valign="middle">
					<?php
					echo "<p>В наличии ".$res['Nalichie']." шт.</p>";
					echo "<p>Описание: ".$res['Opisanie']."</p>";
					echo "<p>Цена: ".$res['Stoimost']." р.</p>";
					mysqli_close($link);
					?>
					<form method="POST" align="center">
					<?php
					$kol='';
					$stoim=$res['Stoimost'];
					?>
					<p>Количество <input value="1" name="kol" type="text" min=0 max=10/></p>
					<button name="add">
						<img style="vertical-align: middle; width: 24px;" src="images/korzina2.png" alt=""/>
						Добавить в корзину
					</button>
					<?php
					if (isset($_POST['add'])) //если произошло нажатие на кнопку Добавить в корзину
					{
						if (isset($_POST['kol']))
						{
							// Передача переменных с формы
							$kol= trim($_POST['kol']);
						}
						$stoim=$stoim * $kol;
						/*Соединение с базой данных */
						$link = mysqli_connect("localhost", "root", "", "magazin");
						/* проверка соединения */
						if (mysqli_connect_errno()) {
							printf("Не удалось подключиться: %s\n", mysqli_connect_error());
							exit();
						}
						$add = mysqli_query($link, "INSERT INTO `zakazy`(`id_zakaza`, `id_tovara`, `id_klienta`, `Kolichestvo`, `Itogovaya_stoimost`) VALUES 
							('','$idt', '1', '$kol','$stoim')");
						mysqli_close($link);
						?>
						<script>
							confirm('Товар добавлен в корзину');
						</script>
						<?php
					}
					?>
					</form>
				</td></tr>
			</table>
		</td></tr>
		<?php
		}
		?>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100">
		<tr>
		<td></td>
		</tr>
	</table>
<!--Вызов нижней части сайта-->
<?php include("bottom.php"); ?>