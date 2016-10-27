<?php
	include("conexion.php");
	$arreglo=null;
	$consulta="select * from prestamo 
	inner join libro on
	cota=prestamo.id_ejemplar
	inner join lector on
	id_lector=identidad where fecha_r<current_date() 
	and estado='NO DEVUELTO' group by id_lector";
	//die($consulta);
	$data = mysql_query($consulta) or die(mysql_error());
?>
<h2>Lectores Morosos</h2>
	<table style="border:1px solid black; margin:0px auto;" width="400">
		<tr>
			<td><b>C&eacute;dula</b></td>
			<td><b>Nombre Completo</b></td>
			<td><b>Libros debidos</b></td>
		</tr>
<?php 
	while ($o=mysql_fetch_array($data))
{
	$tits="";
	$consulta2="select * from prestamo 
	inner join libro on
	cota=prestamo.id_ejemplar
	where fecha_r<current_date() 
	and estado='NO DEVUELTO'";
	
	$data2 = mysql_query($consulta2);
	while ($o2=mysql_fetch_array($data2)) $tits.="$o2[titulo]<br/>";
	echo "<tr><td>$o[identidad]</td>
	<td>$o[nombre] $o[apellido]</td>
	<td>$tits</td></tr>";
}
?></table>


