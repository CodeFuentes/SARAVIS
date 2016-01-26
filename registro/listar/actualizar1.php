<?include ("../sesion/seguridad.php");?> 
<?include ("../sesion/conexion.php");?> 
<HTML>
<HEAD>
<TITLE>Actualizar1.php</TITLE>
</HEAD>
<BODY>
<div align="center">
<h1>Modifica un Registro</h1>
<br>
<?

echo '<FORM METHOD="POST" ACTION="actualizar2.php">Nombre<br>';

//Creamos la sentencia SQL y la ejecutamos
$sSQL="Select nombre From clientes Order By nombre";
$result=mysql_query($sSQL);

echo '<select name="nombre">';

//Generamos el menu desplegable
while ($row=mysql_fetch_array($result))
{echo '<option>'.$row["nombre"];}
?>
</select>

<br>Nombre<br>
<INPUT TYPE="TEXT" NAME="nombre2"><br>
<br>Teléfono<br>
<INPUT TYPE="TEXT" NAME="telefono"><br>

<INPUT TYPE="SUBMIT" value="Actualizar">
</FORM>
</div>

<div align="center">
<a href="lectura.php">Volver</a><br>
</div>

</BODY>
</HTML>
