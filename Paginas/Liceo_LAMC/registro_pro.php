<?php
	include('conexion.php');
	$sql="insert into d_profesor(ci_pr,doc_pr,ape_pr,nom_pr,fec_pr,lug_pr,sex_pr,esci_pr,pohi_pr,cua_pr,dire_pr,teca_pr,tece_pr,coel_pr)
values('".$_REQUEST['ci_pr']."','".$_REQUEST['doc_pr']."','".$_REQUEST['ape_pr']."','".$_REQUEST['nom_pr']."'
	  ,'".$_REQUEST['fec_pr']."','".$_REQUEST['lug_pr']."','".$_REQUEST['sex_pr']."','".$_REQUEST['esci_pr']."'
	  ,'".$_REQUEST['pohi_pr']."','".$_REQUEST['cua_pr']."','".$_REQUEST['dire_pr']."','".$_REQUEST['teca_pr']."'
	  ,'".$_REQUEST['tece_pr']."','".$_REQUEST['coel_pr']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='r_profesor2.php';
</script>