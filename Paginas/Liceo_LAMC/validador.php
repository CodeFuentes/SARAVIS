<?php
session_start();
	include("conexion.php");
	$usuario=$_POST['usuario'];
	$contrasena=$_POST['contrasena'];
	$sql="select * from usuarios where n_usuario='$usuario' and contrasena='$contrasena'";
	$rs = mysql_query($sql) or die ("Error en $sql:". mysql_error());
	$row = mysql_num_rows($rs);
	if ($row > 0){ 
	
	$_SESSION["autentificado"]= "SI";
		$_SESSION["usuario"]= $usuario;

  echo "<script>window.location = 'inicio_prueba.php';</script>";
	}
	else {
 
  ?>
  <script language= "javascript">
alert("Disculpe! Clave y usuario incorrecta!");
</script>
<?php
 echo "<script>window.location = ' index.php?errorusuario=si';</script>";
	
	}
?>
