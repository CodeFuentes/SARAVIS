<?php 
include("conexion.php");

$sql="insert into permiso_pr(ci_pr,doc_pr,ape_pr,nom_pr,gra_pr,supro_pr,rem_pr,fecper_pr,motper_pr)values('".$_REQUEST['ci_pr']."','".$_REQUEST['doc_pr']."','".$_REQUEST['ape_pr']."','".$_REQUEST['nom_pr']."','".$_REQUEST['gra_pr']."','".$_REQUEST['supro_pr']."','".$_REQUEST['rem_pr']."','".$_REQUEST['fecper_pr']."','".$_REQUEST['motper_pr']."')";
mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='permiso_prof.php';
</script>