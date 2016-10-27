<?php 
include("conexion.php");
$sql="insert into reposo_pr(ci_pr,doc_pr,ape_pr,nom_pr,orex_pr,fecin_pr,feccul_pr,rein_pr,des_pr)values('".$_REQUEST['ci_pr']."','".$_REQUEST['doc_pr']."','".$_REQUEST['ape_pr']."','".$_REQUEST['nom_pr']."','".$_REQUEST['orex_pr']."','".$_REQUEST['fecin_pr']."','".$_REQUEST['feccul_pr']."','".$_REQUEST['rein_pr']."','".$_REQUEST['des_pr']."')";
mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='reposo_prof.php';
</script>