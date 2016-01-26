<?php session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$ejemplares = mysql_query("select * from ejemplar 
	where cota='$_REQUEST[libro]' and 
	cota_particular<>ALL(select id_ejemplar from prestamo where estado like '%NO DEVUELTO%')") or die(mysql_error());
	if(!($e=mysql_fetch_array($ejemplares)))
	{
		echo "<center>Ning&uacute;n ejemplar disponible</center>";
	}
	else do
	{
		echo "<label>$e[cota_particular]</label><a href=\"prestarlibros.php?id=$_REQUEST[lector]&solicitar=$e[cota_particular]\">Prestar este Ejemplar</a>";
	} while($e=mysql_fetch_array($ejemplares));
?>
