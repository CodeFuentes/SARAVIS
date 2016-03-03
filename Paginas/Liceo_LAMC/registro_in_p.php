<?php
	include('conexion.php');
	$sql="insert into d_padre(doc_p,ci_p,nombre_p,apellido_p,fechan_p,grado_in_p,ocupacion_p,ltrabajo_p,telf_p,origen_p,ec_p,direccion_p,grupo_fp)
values('".$_REQUEST['doc_p']."','".$_REQUEST['ci_p']."','".$_REQUEST['nombre_p']."','".$_REQUEST['apellido_p']."'
	  ,'".$_REQUEST['fechan_p']."','".$_REQUEST['grado_in_p']."','".$_REQUEST['ocupacion_p']."','".$_REQUEST['ltrabajo_p']."'
	  ,'".$_REQUEST['telf_p']."','".$_REQUEST['origen_p']."','".$_REQUEST['ec_p']."','".$_REQUEST['direccion_p']."'
	  ,'".$_REQUEST['grupo_fp']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='n_ingreso_r.php';
</script>