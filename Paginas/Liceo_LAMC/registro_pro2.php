<?php
	include('conexion.php');
	$sql="insert into d_especialidad_pr(grain_pr,esp1_pr,esp2_pr,mat1_pr,mat2_pr,esac_pr,tiob_pr,teoi_pr,dicu_pr)
values('".$_REQUEST['grain_pr']."','".$_REQUEST['esp1_pr']."','".$_REQUEST['esp2_pr']."','".$_REQUEST['mat1_pr']."'
	  ,'".$_REQUEST['mat2_pr']."','".$_REQUEST['esac_pr']."','".$_REQUEST['tiob_pr']."','".$_REQUEST['teoi_pr']."'
	  ,'".$_REQUEST['dicu_pr']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='disponibilidad_pr.php';
</script>