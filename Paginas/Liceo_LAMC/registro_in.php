<?php
	include('conexion.php');
	$sql="insert into d_madre(doc_m,ci_m,nombre_m,apellido_m,fechan_m,grado_in_m,ocupacion_m,ltrabajo_m,telf_m,origen_m,ec_m,direccion_m,grupo_fm)
values('".$_REQUEST['doc_m']."','".$_REQUEST['ci_m']."','".$_REQUEST['nombre_m']."','".$_REQUEST['apellido_m']."'
	  ,'".$_REQUEST['fechan_m']."','".$_REQUEST['grado_in_m']."','".$_REQUEST['ocupacion_m']."','".$_REQUEST['ltrabajo_m']."'
	  ,'".$_REQUEST['telf_m']."','".$_REQUEST['origen_m']."','".$_REQUEST['ec_m']."','".$_REQUEST['direccion_m']."'
	  ,'".$_REQUEST['grupo_fm']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='n_ingreso_p.php';
</script>