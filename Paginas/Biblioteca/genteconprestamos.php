<?php
	include("conexion.php");
	$arreglo=null;
	$consulta="select * from prestamo 
	inner join libro on
	cota=prestamo.id_ejemplar
	inner join lector on
	id_lector=identidad where fecha_r>=current_date() 
	and estado='NO DEVUELTO' order by fecha_c";
	//die($consulta);
	$data = mysql_query($consulta) or die(mysql_error());
?>
<h2>Lectores con Pr&eacute;stamos</h2>
	<table style="border:1px solid black; margin:0px auto;" width="400">
		<tr>
			<td><b>C&eacute;dula</b></td>
			<td><b>Nombre Completo</b></td>
			<td><b>Nombre del Libro</b></td>
			<td><b>Fecha Devoluci&oacute;n</b></td>
		</tr>
<?php 
	while ($o=mysql_fetch_array($data))
{
	echo "<tr><td>$o[identidad]</td>
	<td>$o[nombre] $o[apellido]</td>
	<td>$o[titulo]</td>
	<td>$o[fecha_r]</td></tr>";
}
?></table>