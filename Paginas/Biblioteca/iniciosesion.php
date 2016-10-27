<?php  session_start();
if(isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
if(isset($_REQUEST['nombre']) && isset($_REQUEST['clave']))
{
	$result = mysql_query("select * from usuario
	where nombre='$_REQUEST[nombre]' and clave='$_REQUEST[clave]';");
	if(!($r=mysql_fetch_array($result)))
	{
		die("<script>alert('Usuario o clave incorrectos'); window.location='iniciosesion.php';</script>");
	}
	$_SESSION['sesioniniciada']=1;
	$_SESSION['nombre']=$_REQUEST['nombre'];
	$_SESSION['tipocuenta']=$r['tipocuenta'];
	mysql_query("insert into auditoria(usuario,operacion,fecha) 
	values('$_SESSION[nombre]','El usuario $_SESSION[nombre] ha iniciado sesion',current_date())");
	header("location:home.php");
}
require_once('header.php'); ?>
		<img src="img/fotocolegio.jpg" class="relleno"/>
		<form style="float: left;" class="alineado inicio" action="iniciosesion.php" method="post">
		<fieldset>
			<legend>Inicio de Sesi&oacute;n</legend>
			<label>Nombre</label><input  type="text" name="nombre" placeholder="Ejemplo: Mar&iacute;a" required/>
			<label>Clave</label><input type="password" name="clave" placeholder="Puede n&uacute;meros y letras" required/>
			<input type="submit" value="Enviar">
		</fieldset>
		</form>
<?php require_once('footer.php'); ?>