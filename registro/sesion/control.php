<?php
session_start();
/* Este archivo se encarga de verificar si los datos que introdujimos en el formulario HTML están en la base de datos */

	/* Incluimos el archivo conexion.php, que es el que realiza la conexión con la base de datos */
	include("conexion.php");
	/* Asigna las variables enviadas con el metodo POST a unas variables locales */
	$u=$_POST['usuario'];
	$c=$_POST['contrasena'];
	/* Sentencia SELECT de SQL cuyos campos correspondan con las variables PHP */
	$sql="select * from usuario where nombre_usuario='$u' and clave_usuario='$c'";
	/* Registra si la consulta consiguio algun dato correspondiente */
	$rs = mysql_query($sql) or die ("Error en $sql:". mysql_error());
	$row = mysql_num_rows($rs);
	/* Condicional que determina si se consiguieron coincidencias */
	if ($row > 0)
	{ 
		/* De ser así se asignan las variables locales a la variable $_SESSION */
		$_SESSION["autentificado"]= "SI";
		$_SESSION["usuario"]= $u;
		/* Redirige al archivo insertar.php */
  		header ("Location: ../listar/insertar.php"); 
	}
	else
	{ 
    		//si no existe le mando otra vez a la portada 
    		header("Location: index.php?errorusuario=si"); 
	} 
?>
