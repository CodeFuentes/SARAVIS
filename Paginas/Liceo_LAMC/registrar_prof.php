<?php
	include('conexion.php');
	$sql="insert into d_profesores(ci_prof,nom_prof,ape_prof)
values('".$_REQUEST['ci_prof']."' , '".$_REQUEST['nom_prof']."', '".$_REQUEST['ape_prof']."')";

mysql_query($sql);
?>
<script language= "javascript">
alert("Agregado con Exito!");
location.href='registro_prof.php';
</script>