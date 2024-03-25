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
        height: 80px;
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
	<?php include("head1.php"); ?>
	<h3 style="color: #464545;"><center>Корзина</center></h3>
	<?php
	/* Соединение с базой данных */
	$link = mysqli_connect("localhost", "root", "", "magazin");
	/* проверка соединения */
	if (mysqli_connect_errno($link)) {
		printf("Не удалось подключиться: %s\n", mysqli_connect_error());
		exit();
	}
	/* Select запрос на выборку из базы данных tovari */
	$result = mysqli_query($link, "SELECT * FROM `zakazy` WHERE `id_klienta` = '1';");
	mysqli_close($link);
	$idtov='';
	$idzak='';
	$nomtov = '0';
	$array = array();
	?>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
		<?php
		$itog='0';
		while($res = mysqli_fetch_assoc($result))
		{
		?>
		<tr><td>
			<?php
			$idtov=$res['id_tovara'];
			?>
			<table border="1" cellspacing="0" cellpadding="0" width="100%" align="center">
			<tr><td width="40%"  align="center">
				<?php
				/* Соединение с базой данных */
				$link = mysqli_connect("localhost", "root", "", "magazin");
				/* проверка соединения */
				if (mysqli_connect_errno($link)) {
					printf("Не удалось подключиться: %s\n", mysqli_connect_error());
					exit();
				}
				/* Select запрос на выборку из базы данных tovari */
				$query = mysqli_query($link, "SELECT * FROM `tovary` WHERE `id_tovara` = $idtov");
				mysqli_close($link);
				while($sql = mysqli_fetch_assoc($query))
				{
					?>
					<img src="images/<?php echo $sql['Photo']; ?>.jpg" alt="">
				</td>
				<td width="60%"  align="center">
				<?php
				$nomtov = $nomtov + 1;
				echo "<p>Товар №".$nomtov.": ".$sql['Model']."</p>";
				echo "<p>Количество: ".$res['Kolichestvo']." шт.</p>";
				echo "<p>Итоговая стоимость товара: ".$res['Itogovaya_stoimost']." р.</p>";
				$itog=$itog + $res['Itogovaya_stoimost'];
				$idzak=$res['id_zakaza'];
				$array[] = $idzak;
				}
				?>
				<p></p>
			</td></tr>
			</table>
		</td></tr>
		<tr><td width="100%" align="center">
		
		<?php
		}
		if ($itog == 0)
		{
			?>
			<h4 width="100%" align="center" style="color: #464545;">Корзина пуста</h4>
			<table border="0" cellspacing="0" cellpadding="0" width="100%" height="360">
				<tr>
				<td></td>
				</tr>
			</table>
			<?php
		}
		else
		{
			echo "<h4>Итоговая стоимость заказа: ".$itog." р.</h4>";
			?>
			<p></p>
			<form method="POST" align="center">
			<button name="del" align="center">
			<div id="zatemnenie">
				<div id="okno">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
						<tr><td><h3 style="color: #464545;">Подтвердите удаление</h3></td></tr>
						<tr><td valign="bottom"><input type="submit" name="delzak" value="Удалить"/>
						<?php
						if (isset($_POST['delzak'])) //если произошло нажатие на кнопку Удалить
						{
							/*Соединение с базой данных */
							$link = mysqli_connect("localhost", "root", "", "magazin");
							/* проверка соединения */
							if (mysqli_connect_errno()) {
								printf("Не удалось подключиться: %s\n", mysqli_connect_error());
								exit();
							}
							$del = mysqli_query($link, "DELETE FROM `zakazy` WHERE `id_klienta` = '1'");
							mysqli_close($link);
							?>
							<script>
								confirm('Все товары из корзины были удалены');
							</script>
							<?php
							echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=korzina.php">';
							break;
						}
						?>
						<input type="submit" name="otm"  value="Отмена"/>
						<?php
						if (isset($_POST['otm'])) //если произошло нажатие на кнопку Отмена
						{
							echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=korzina.php">';
						}
						?>
						</td></tr>
					</table>
				</div>
			</div>
			<a style="color: #000000;" href="#zatemnenie">Очистить корзину</a>
			</button>
			</form>
			<p></p>
			<table>
			<form method="POST" align="center">
			<p>Номер товара в корзине <input type="text" name="ntov" size="6" maxlength="50">
			<button name="udtov">
				Удалить товар из корзины
			</button>
			<?php
			if (isset($_POST['udtov'])) //если произошло нажатие на кнопку Удалить товар из корзины
			{
				if (isset($_POST['ntov'])) //если было задано значение в поле поиска
				{
					$ntov = ''; //создание пустой переменной поиска
					$ntov = trim($_POST['ntov']); // Передача в переменную значения из поля поиска
					if ($ntov == '')
					{
						?>
						<script>
							confirm('Поле пустое. Заполните поле номера товара для его удаления');
						</script>
						<?php
					}
					else
					{
						$idz = '';
						$idz = $array[$ntov-1];
						/*Соединение с базой данных */
						$link = mysqli_connect("localhost", "root", "", "magazin");
						/* проверка соединения */
						if (mysqli_connect_errno()) {
							printf("Не удалось подключиться: %s\n", mysqli_connect_error());
							exit();
						}
						$udt = mysqli_query($link, "DELETE FROM `zakazy` WHERE `id_zakaza` = $idz");
						mysqli_close($link);
						echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=korzina.php">';
						?>
						<script>
							confirm('Товар был удален');
						</script>
						<?php
					}
				}
			}
			?>
			</form>
			</table>
			</p>
			<p></p>
			<form method="POST" align="center">
			<button name="oplata" style="width: 200px; height: 50px; border-radius: 30px;">
				Оплатить
			</button>
			<?php
			if (isset($_POST['oplata'])) //если произошло нажатие на кнопку Оплатить
			{
				?>
				<script>
					confirm('Прикладывайте карту');
					confirm('Оплата произведена успешно');
				</script>
				<?php
				/*Соединение с базой данных */
				$link = mysqli_connect("localhost", "root", "", "magazin");
				/* проверка соединения */
				if (mysqli_connect_errno()) {
					printf("Не удалось подключиться: %s\n", mysqli_connect_error());
					exit();
				}
				$date_today = date("Y-m-d");
				$add = mysqli_query($link, "INSERT INTO `vydacha_i_vozvrat`(`id_pokupki`, `id_klienta`, `Data`, `Podtverjdenie_vozvrata`) 
					VALUES ('','1', '$date_today','')");
				mysqli_close($link);
			}
			?>
			</form>
			<p></p>
			<form method="POST" align="center">
			<button name="chek">
				Распечатать номер заказа
			</button>
			<?php
			if (isset($_POST['chek'])) //если произошло нажатие на кнопку Оплатить
			{
				?>
				<script>
					confirm('Номер заказа распечатан. Ваш номер заказа: 1');
				</script>
				<?php
				echo '<META HTTP-EQUIV="Refresh" CONTENT="0; URL=index1.php">';
			}
			?>
			</form>
			<?php
			}
			?>
		</td></tr>
	</table>
	<table border="0" cellspacing="0" cellpadding="0" width="100%" height="100">
		<tr>
		<td></td>
		</tr>
	</table>
<!--Вызов нижней части сайта-->
<?php include("bottom.php"); ?>