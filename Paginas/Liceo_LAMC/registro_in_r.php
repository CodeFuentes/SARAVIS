<?php
	include('conexion.php');
	$sql="insert into d_representante(doc_r,tipo_r,ci_r,nombre_r,apellido_r,fechan_r,grado_in_r,ocupacion_r,ltrabajo_r,telf_r,origen_r,ec_r,direccion_r,grupo_fr)
values('".$_REQUEST['doc_r']."','".$_REQUEST['tipo_r']."','".$_REQUEST['ci_r']."','".$_REQUEST['nombre_r']."','".$_REQUEST['apellido_r']."'
	  ,'".$_REQUEST['fechan_r']."','".$_REQUEST['grado_in_r']."','".$_REQUEST['ocupacion_r']."','".$_REQUEST['ltrabajo_r']."'
	  ,'".$_REQUEST['telf_r']."','".$_REQUEST['origen_r']."','".$_REQUEST['ec_r']."','".$_REQUEST['direccion_r']."'
	  ,'".$_REQUEST['grupo_fr']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='n_ingreso_e.php';
</script>