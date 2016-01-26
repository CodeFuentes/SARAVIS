<h4> Cota </h4>

<?php 
 session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$resultados = mysql_query("select * from libro WHERE materia='$_REQUEST[id_dewey]' and prestado='0';",$c);
	$r = mysql_fetch_assoc($resultados);
	if(!$r)
	echo "No hay libros disponibles en esta categor&iacute;a";
	else
	{
		echo "<select name=\"libro[]\">";
		 do
	{
		echo "<option value=\"$r[cota]\">$r[cota] ($r[uso])</option>";
	}while($r = mysql_fetch_assoc($resultados));
	echo "</select>";
	}
?>
