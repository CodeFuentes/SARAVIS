<?include ("../sesion/seguridad.php");?>
<?include ("../sesion/conexion.php");?> 
<HTML>
<HEAD>
<TITLE>Borrar1.php</TITLE>
</HEAD>
<BODY>
<div align="center">
<h1>Borrar un registro</h1>
<br>

<?

echo '<FORM METHOD="POST" ACTION="borrar2.php">Nombre<br>';

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Select nombre From clientes Order By nombre";
$result=mysql_query($sSQL);

echo '<select name="nombre">';

//Mostramos los registros en forma de menú desplegable
while ($row=mysql_fetch_array($result))
{echo '<option>'.$row["nombre"];}
mysql_free_result($result)
?>

</select>
<br>
<INPUT TYPE="SUBMIT" value="Borrar">
</FORM>
</div>

<div align="center">
<a href="lectura.php">Volver</a><br>
</div>

</BODY>
</HTML>
