<?php
include("conexion.php");
$sql="update d_profesor set ape_pr='".$_REQUEST['ape_pr']."',nom_pr='".$_REQUEST['nom_pr']."',fec_pr='".$_REQUEST['fec_pr']."'
	  ,lug_pr='".$_REQUEST['lug_pr']."',sex_pr='".$_REQUEST['sex_pr']."',esci_pr='".$_REQUEST['esci_pr']."',pohi_pr='".$_REQUEST['pohi_pr']."'
	  ,cua_pr='".$_REQUEST['cua_pr']."',dire_pr='".$_REQUEST['dire_pr']."',teca_pr='".$_REQUEST['teca_pr']."',tece_pr='".$_REQUEST['tece_pr']."'
	  ,coel_pr='".$_REQUEST['coel_pr']."' where ci_pr='".$_REQUEST['ci_pr']."'";
mysql_query($sql);
?>
<script language="javascript">
alert("Los Datos fueron editados Exitosamente!")
location.href='buscar_pro.php';
</script>
