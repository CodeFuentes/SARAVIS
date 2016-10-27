<?php 
session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
include("conexion.php");
mysql_query("insert into auditoria(usuario,operacion,fecha) 
values('$_SESSION[nombre]','El usuario $_SESSION[nombre] ha cerrado sesion',current_date())") or die(mysql_error());	
session_destroy();
header("location:index.php");
?>
