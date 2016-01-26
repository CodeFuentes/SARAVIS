<?php
include ("../sesion/seguridad.php");
?>
<?php
include ("../sesion/conexion.php");
?>
<HTML>
<HEAD>
<TITLE>Insertar.php</TITLE>
</HEAD>
<BODY>
<?php
/* Se asignan las variables enviadas por POST a dos variables locales */
$nombre=$_POST['nombre'];
$telefono=$_POST['telefono'];
/* Se introduce en la base de datos lo campos enviados desde el formulario */
$query = "insert into 'clientes' ('nombre','telefono') values ('$nombre','$telefono')";

mysql_query($query) or die("Falla en el Query: $query");
?>
<h1><div align="center">Registro Insertado</div></h1>
<div align="center"><a href="lectura.php">Listar</a></div>
</BODY>
</HTML>
