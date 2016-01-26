<?php 
include("conexion.php");
$sql="insert into inasis_pr(ci_pr,doc_pr,ape_pr,nom_pr,fecinas_pr,jus_pr,motina_pr)values('".$_REQUEST['ci_pr']."','".$_REQUEST['doc_pr']."','".$_REQUEST['ape_pr']."','".$_REQUEST['nom_pr']."','".$_REQUEST['fecinas_pr']."','".$_REQUEST['jus_pr']."','".$_REQUEST['motina_pr']."')";
mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='inasis_prof.php';
</script>