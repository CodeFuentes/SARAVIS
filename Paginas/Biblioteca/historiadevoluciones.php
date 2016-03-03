<?php
	include("conexion.php");
	$arreglo=null;
	$consulta="select * from prestamo 
	inner join libro on
	cota=prestamo.id_ejemplar
	inner join lector on
	id_lector=identidad where 
	estado like 'DEVUELTO%'";
	$data = mysql_query($consulta) or die(mysql_error());
?>
<h2>Historial de Devoluciones</h2>
	<table style="border:1px solid black; margin:0px auto;" width="400">
		<tr>
			<td><b>Num.</b></td>
			<td><b>Fecha Solicitud</b></td>
			<td><b>Nombre Completo</b></td>
			<td><b>Nombre del Libro</b></td>
			<td><b>Fecha Devoluci&oacute;n</b></td>
		</tr>
<?php $i=0;
	while ($o=mysql_fetch_array($data))
{
	$i++;
	echo "<tr><td>$i</td><td>$o[fecha_c]</td>
	<td>$o[nombre] $o[apellido]</td>
	<td>$o[titulo]</td>
	<td>$o[fecha_r]</td></tr>";
}
?></table>


