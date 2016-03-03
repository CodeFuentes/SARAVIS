<?php
	include('conexion.php');
	$sql="insert into ae(nombre_ae,fechai_ae,fechac_ae)
values('".$_REQUEST['nombre_ae']."' , '".$_REQUEST['fechai_ae']."', '".$_REQUEST['fechac_ae']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='a_escolar.php';
</script>