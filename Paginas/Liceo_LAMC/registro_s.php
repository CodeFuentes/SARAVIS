<?php
	include('conexion.php');
	$sql="insert into secciones(grado,seccion,capacidad,aula)
values('".$_REQUEST['grado']."' , '".$_REQUEST['seccion']."', '".$_REQUEST['capacidad']."', '".$_REQUEST['aula']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Sección Agregada!");
location.href='secciones.php';
</script>