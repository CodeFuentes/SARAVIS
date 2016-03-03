<?php
	include('conexion.php');
	$sql="insert into dis_profesor(d_lunesd,d_lunesh,d_martesd,d_martesh,d_miercolesd,d_miercolesh,d_juevesd,d_juevesh,d_viernesd,d_viernesh)
values('".$_REQUEST['d_lunesd']."','".$_REQUEST['d_lunesh']."','".$_REQUEST['d_martesd']."','".$_REQUEST['d_martesh']."'
	  ,'".$_REQUEST['d_miercolesd']."','".$_REQUEST['d_miercolesh']."','".$_REQUEST['d_juevesd']."','".$_REQUEST['d_juevesh']."'
	  ,'".$_REQUEST['d_viernesd']."','".$_REQUEST['d_viernesh']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='r_profesor2.php';
</script>