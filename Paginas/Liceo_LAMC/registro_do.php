<?php
	include('conexion.php');
	$sql="insert into d_documentos(partida_o,c_partida,ced_ma,ced_pa,ced_re,ced_es,boleta,foto_es,foto_re,otros,notas,tipo_notas,pendiente,f_entrega,obser_do)
values('".$_REQUEST['partida_o']."','".$_REQUEST['c_partida']."','".$_REQUEST['ced_ma']."','".$_REQUEST['ced_pa']."'
	  ,'".$_REQUEST['ced_re']."','".$_REQUEST['ced_es']."','".$_REQUEST['boleta']."','".$_REQUEST['foto_es']."'
	  ,'".$_REQUEST['foto_re']."','".$_REQUEST['otros']."','".$_REQUEST['notas']."','".$_REQUEST['tipo_notas']."'
	  ,'".$_REQUEST['pendiente']."','".$_REQUEST['f_entrega']."','".$_REQUEST['obser_do']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='n_ingreso_in.php';
</script>
