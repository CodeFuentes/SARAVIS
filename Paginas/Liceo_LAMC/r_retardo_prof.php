<?php 
include("conexion.php");
$sql="insert into retardo_pr(ci_pr,doc_pr,ape_pr,nom_pr,hoen_pr,holle_pr,fecret_pr,motret_pr)values('".$_REQUEST['ci_pr']."','".$_REQUEST['doc_pr']."','".$_REQUEST['ape_pr']."','".$_REQUEST['nom_pr']."','".$_REQUEST['hoen_pr']."','".$_REQUEST['holle_pr']."','".$_REQUEST['fecret_pr']."','".$_REQUEST['motret_pr']."')";
mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='retardo_prof.php';
</script>
