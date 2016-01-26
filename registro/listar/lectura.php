<?include ("../sesion/seguridad.php");?>
<?include ("../sesion/conexion.php");?>
<HTML>
<HEAD>
<TITLE>lectura.php</TITLE>
</HEAD>
<BODY>
<h1><div align="center">Lectura de la Base de Datos</div></h1>
<br>
<br>
<?

//Ejecutamos la sentencia SQL
$result=mysql_query("select * from clientes");
?>
<table align="center">
<tr>
<th>Nombre</th>
<th>Teléfono</th>
</tr>
<?
//Mostramos los registros
while ($row=mysql_fetch_array($result))
{
echo '<tr><td>'.$row["nombre"].'</td>';
echo '<td>'.$row["telefono"].'</td></tr>';
}
mysql_free_result($result)
?>
</table>

<div align="center">
<a href="insertar.php">Ingresar un nuevo registro</a><br>
<a href="actualizar1.php">Modificar un registro Existente</a><br>
<a href="borrar1.php">Eliminar un Registro</a><br>
</div>

</BODY>
</HTML>
