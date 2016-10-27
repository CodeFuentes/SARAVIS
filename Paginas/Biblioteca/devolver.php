<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	
	$resultados = mysql_query("select * from prestamo where id_p='$_REQUEST[id]'");
	if(!$resultados || !($prestamo=mysql_fetch_array($resultados)))
	die("<script>alert('Prestamo inexistente'); window.location='index.php';</script>");
	$devolucion = strtotime($prestamo['fecha_r']);
	$fecha = strtotime(date("Y-m-d"));
	if($fecha>$devolucion)
	{
			$nfecha = $fecha + 3600*24*30;
			$fechac = date("Y-m-d",$nfecha);
	}
		else $multa = "";
		$fecha = date("Y-m-d");
		$fecha2 = date("d\/m\/Y");
		mysql_query("update prestamo
			set fecha_r='$fecha'
			, estado='DEVUELTO EL $fecha2'
			where id_p='$_REQUEST[id]'") or die(mysql_error());
		 echo "<script>alert('Libro devuelto. $multa'); window.location='index.php';</script>";
?>
