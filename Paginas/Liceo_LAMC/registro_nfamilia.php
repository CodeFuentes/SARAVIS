<?php
	include('conexion.php');
	$sql="insert into d_socio-economico(adultos_m,adultos_f,adoles_m,adoles_f,nino_m,nina_f,adultos_mm,adultos_mf,t_familia,tipo_casa,te_casa,mision_v,cod_mv,mision_bo,beneficio,ingre_fa)
values('".$_REQUEST['adultos_m']."','".$_REQUEST['adultos_f']."','".$_REQUEST['adoles_m']."','".$_REQUEST['adoles_f']."'
	  ,'".$_REQUEST['nino_m']."','".$_REQUEST['nina_f']."','".$_REQUEST['adultos_mm']."','".$_REQUEST['adultos_mf']."'
	  ,'".$_REQUEST['t_familia']."','".$_REQUEST['tipo_casa']."','".$_REQUEST['te_casa']."','".$_REQUEST['mision_v']."'
	  ,'".$_REQUEST['cod_mv']."','".$_REQUEST['mision_bo']."','".$_REQUEST['beneficio']."','".$_REQUEST['ingre_fa']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='n_ingreso_do.php';
</script>
