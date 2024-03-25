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
        width: 600px;
        height: 250px;
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
	
	<table width="100%" align="center">
		
		<tr width="100%" align="center"><td>
			<h2 style="color: #464545;"><center>ЗАКАЖИ БЕЗ ОЧЕРЕДИ</center></h2>
		</td></tr>
		<tr width="100%" align="center"><td>
			<img style="vertical-align: middle;" src="images/start.jpg" alt=""/>
		</td></tr>
		<tr width="100%" align="center"><td>
			<button style="background: #DC143C; width: 200px; height: 50; border-radius: 30px;">
				<a style="color: #FFFFFF;" href="katalog.php"><h3>CДЕЛАТЬ ЗАКАЗ</h3></a>
			</button>
		</td></tr>	
	</table>
<!--Вызов нижней части сайта-->
<?php include("bottom.php"); ?>