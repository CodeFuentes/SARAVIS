<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	
	$resultados = mysql_query("select * from prestamo where id_p='$_REQUEST[id]'");
	if(!$resultados || !($prestamo=mysql_fetch_array($resultados)))
	die("<script>alert('Prestamo inexistente'); window.location='index.php';</script>");
		$momentoviejo = strtotime($prestamo['fecha_r']);
		$momentonuevo = $momentoviejo+3600*24*1;
		$fecha_r = date("Y-m-d",$momentonuevo);
		mysql_query("update prestamo
			set fecha_r='$fecha_r'
			, estado='PRORROGADO - NO DEVUELTO'
			where id_p='$_REQUEST[id]'") or die(mysql_error());
		 echo "<script>alert('Prorroga concedida'); window.location='index.php';</script>";
?>
