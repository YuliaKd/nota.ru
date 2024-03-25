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
	<form method="POST" align="center">
	<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
		<tr><td align="center">
			<p><label>Код товара <input type="text" name="kodtov" size="15" maxlength="50"></label></p>
			<p><label>Расширенный поиск по товару <input type="text" name="poisk" size="15" maxlength="50"></label></p>
			<!--Объявление кнопки-->
			<input type="submit" name="search" value="Поиск" >
			<p></p>
			<?php
				if (isset($_POST['search'])) //если произошло нажатие на кнопку
				{
					if (isset($_POST['poisk']) || isset($_POST['kodtov'])) //если было задано значение в поле поиска
					{
						$kodtov = ''; //создание пустой переменной поиска
						$poisk = ''; //создание пустой переменной поиска
						$kodtov = trim($_POST['kodtov']); // Передача в переменную значения из поля поиска
						$poisk = trim($_POST['poisk']); // Передача в переменную значения из поля поиска
						if ($poisk == '' && $kodtov == '')
						{
							?>
							<script>
								confirm('Поле пустое. Заполните поле поиска');
							</script>
							<?php
						}
						elseif ($poisk != '')
						{
							/* Подключение к базе данных */
							$link = mysqli_connect("localhost", "root", "", "magazin");
							
							/* проверка соединения */
							if (mysqli_connect_errno($link)) 
							{
								 printf("Не удалось подключиться: %s\n", mysqli_connect_error());
								 exit();
							}
							/* Select запрос на вывод результатов поиска */
							$result = mysqli_query($link, "SELECT * FROM tovary t WHERE t.id_tovara LIKE '%$poisk%' OR t.id_proizvoditelya LIKE '%$poisk%' 
								OR t.id_kategorii LIKE '%$poisk%' OR t.id_podkategorii LIKE '%$poisk%' OR t.Model LIKE '%$poisk%' OR t.Opisanie LIKE '%$poisk%' 
								OR t.Nalichie LIKE '%$poisk%' OR t.Stoimost LIKE '%$poisk%'");
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
										echo "<p>В наличии ".$res['Nalichie']." шт.</p>";
										?>
										<form method="get" align="center">
											<button>
												<a style="color: #000000;" href="tov.php?tovar=<?php echo $res['id_tovara'];?>">Перейти</a>
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
						<?php
						}
						elseif ($kodtov != '') //если было задано значение в поле поиска
						{
							/* Подключение к базе данных */
							$link = mysqli_connect("localhost", "root", "", "magazin");
							/* проверка соединения */
							if (mysqli_connect_errno($link)) 
							{
								 printf("Не удалось подключиться: %s\n", mysqli_connect_error());
								 exit();
							}
							/* Select запрос на вывод результатов поиска */
							$result = mysqli_query($link, "SELECT * FROM tovary WHERE id_tovara LIKE '%$kodtov%'");
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
										echo "<p>В наличии ".$res['Nalichie']." шт.</p>";
										?>
										<form method="get" align="center">
											<button>
												<a style="color: #000000;" href="tov.php?tovar=<?php echo $res['id_tovara'];?>">Перейти</a>
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
						<?php
						}	
					}
				}
			?>
		</td></tr>
	</table>
	</form>
<!--Вызов нижней части сайта-->
<?php include("bottom.php"); ?>