<?include ("../sesion/seguridad.php");?>
<?include ("../sesion/conexion.php");?>
<HTML>
<HEAD>
<TITLE>Borrar2.php</TITLE>
</HEAD>
<BODY>
<?

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Delete From clientes Where nombre='".$_POST['nombre']."'";
mysql_query($sSQL);
?>

<h1><div align="center">Registro Borrado</div></h1>
<div align="center"><a href="lectura.php">Listar</a></div>

</BODY>
</HTML>
