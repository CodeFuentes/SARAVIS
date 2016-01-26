<?php
	include("conexion.php");
	$arreglo=null;
	$consulta="SELECT * FROM donante ORDER BY nombre";
	$data = mysql_query($consulta) or die(mysql_error());
	$contar=mysql_num_rows($data);
	if ($contar==0)
	{
		echo "No se han encontrado registrado de donantes para mostrar";
		mysql_close($c);
		exit();
	}	
?>
<h2>Historial de Donantes</h2>
	<table style="border:1px solid black; margin:0px auto;" width="400">
		<tr>
			<td><b>Num.</b></td>
			<td><b>C&eacute;dula de Identidad</b></td>
			<td><b>Nombres</b></td>
			<td><b>Apellidos</b></td>
			<td><b>Telefonos</b></td>
		</tr>
<?php $i=0;
	while ($o=mysql_fetch_array($data))
{	$i++;
?>
	<tr>
	<td align=center><?php echo "$i"; ?></td>
	<td><?php echo $o["identidad"]; ?></td>
	<td><?php echo $o["nombre"]; ?></td>
	<td><?php echo $o["apellido"]; ?></td>
	<td><?php echo $o["telefono"]; ?></td>
	</tr>
<?php
}
?></table>


