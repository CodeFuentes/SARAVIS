<?php
include("conexion.php");
$sql="update d_estudiante set  doc_es='".$_REQUEST['doc_es']."',nom_es='".$_REQUEST['nom_es']."',ape_es'".$_REQUEST['ape_es']."',fechanac_es='".$_REQUEST['fechanac_es']."',sex_es='".$_REQUEST['sex_es']."',edad_es='".$_REQUEST['edad_es']."',lugarnac_es='".$_REQUEST['lugarnac_es']."',vive_es='".$_REQUEST['vive_es']."',vive_e_es='".$_REQUEST['vive_e_es']."',direc_es='".$_REQUEST['direc_es']."',fechain_es='".$_REQUEST['fechain_es']."',obser_es='".$_REQUEST['obser_es']."' where ci_es='".$_REQUEST['ci_es']."'";
mysql_query($sql);
?>
<script language="javascript">
alert("Los Datos fueron Registrados Exitosamente!")
location.href='r_ingreso.php';
</script>
