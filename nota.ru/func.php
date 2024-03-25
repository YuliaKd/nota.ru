<?php
function cont_load($id_tovara = "")
{
	$loading= mysqli_connect('localhost', 'root', '', 'magazin');
	$query = $id === "" ? "SELECT * FROM tovary" : "SELECT * FROM tovary WHERE id_tovara = $id_tovara";
	$result= mysqli_query($loading, $query);
	while ($a= mysqli_fetch_array($result)) {
        echo $a['id_tovara'] . "<br />";
		echo $a['Model'] . "<br />";
		echo $a['Kolichestvo'] . "<br />";
		echo $a['Stoimost'] . "<br />";
		echo $a['Opisanie'] . "<br />";
	}
	mysqli_close($loading);
	return $result;
}
?>