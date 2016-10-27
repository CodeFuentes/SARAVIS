<?php
	include('conexion.php');
	$sql="insert into d_estudiante(doc_es,ci_es,nom_es,ape_es,fechanac_es,sex_es,edad_es,lugarnac_es,vive_es,vive_e_es,direc_es,fechain_es,obser_es)
values('".$_REQUEST['doc_es']."','".$_REQUEST['ci_es']."','".$_REQUEST['nom_es']."','".$_REQUEST['ape_es']."'
	  ,'".$_REQUEST['fechanac_es']."','".$_REQUEST['sex_es']."','".$_REQUEST['edad_es']."','".$_REQUEST['lugarnac_es']."'
	  ,'".$_REQUEST['vive_es']."','".$_REQUEST['vive_e_es']."','".$_REQUEST['direc_es']."','".$_REQUEST['fechain_es']."'
	  ,'".$_REQUEST['obser_es']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='n_ingreso_fa.php';
</script>