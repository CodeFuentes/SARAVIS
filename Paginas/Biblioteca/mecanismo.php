<?php
	include("conexion.php");
	$arreglo=null;
	$desde=$_REQUEST['desde'];
	$hasta=$_REQUEST['hasta'];
	$consulta="select * from auditoria where 1 ";
	if($desde!='')
	{	
		list($mes,$dia,$ano) = explode('/',$desde);
		$desde = $ano.'-'.$mes.'-'.$dia;
		$consulta .= "and fecha>='$desde' ";
	}if($hasta!='')
	{
		list($mes,$dia,$ano) = explode('/',$hasta);
		$hasta = $ano.'-'.$mes.'-'.$dia;
			$consulta .= "and fecha<='$hasta' ";
	}
	$data = mysql_query($consulta) or die(mysql_error());
?>
<h2>Registro de eventos</h2>
	<table width="400">
		<tr><td width="300"><b>Descripcion</b></td><td><b>Fecha</b></td></tr>
<?php 
	while ($o=mysql_fetch_array($data))
{
	echo "<tr><td>$o[operacion]</td><td>$o[fecha]</td></tr>";
}
?></table>


