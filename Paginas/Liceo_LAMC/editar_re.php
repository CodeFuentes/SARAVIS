<?php
include("conexion.php");
$sql="update d_representante set doc_r='".$_REQUEST['doc_r']."',apellido_r='".$_REQUEST['apellido_r']."',nombre_r='".$_REQUEST['nombre_r']."',fechan_r='".$_REQUEST['fechan_r']."',grado_in_r='".$_REQUEST['grado_in_r']."',ocupacion_r='".$_REQUEST['ocupacion_r']."'
	  ,ltrabajo_r='".$_REQUEST['ltrabajo_r']."',telf_r='".$_REQUEST['telf_r']."',origen_r='".$_REQUEST['origen_r']."',ec_r='".$_REQUEST['ec_r']."',direccion_r='".$_REQUEST['direccion_r']."',grupo_fr='".$_REQUEST['grupo_fr']."' where ci_r='".$_REQUEST['ci_r']."'";
mysql_query($sql);
?>
<script language="javascript">
alert("Los Datos fueron editados Exitosamente!")
location.href='buscar_re.php';
</script>