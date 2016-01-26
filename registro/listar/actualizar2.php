<?include ("../sesion/seguridad.php");?>
<?include ("../sesion/conexion.php");?> 
<HTML>
<HEAD>
<TITLE>Actualizar2.php</TITLE>
</HEAD>
<BODY>
<?
//Creamos la sentencia SQL y la ejecutamos
$sSQL="Update clientes Set telefono='".$_POST['telefono']."' Where nombre='".$_POST['nombre']."'"; 
mysql_query($sSQL);
$tSQL="Update clientes Set nombre='".$_POST['nombre2']."' Where nombre='".$_POST['nombre']."'"; 
mysql_query($tSQL);
?>

<h1><div align="center">Registro Actualizado</div></h1>
<div align="center"><a href="lectura.php">Listar</a></div>

</BODY>
</HTML>
