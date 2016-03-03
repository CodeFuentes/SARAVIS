<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	$script = '';
if(isset($_REQUEST['accion']) && $_REQUEST['accion']=='modificar')
{
	mysql_query("update donante
		set nombre='$_REQUEST[nombre]',apellido='$_REQUEST[apellido]'
		,telefono='$_REQUEST[telefono]' where identidad='$_REQUEST[tipo]$_REQUEST[cedula]';")
		or die(mysql_error());
		$script = "alert('Datos modificados'); window.location='donantes.php';";
}
if(isset($_REQUEST['elim']))
{
	mysql_query("update donante
	set activo='0'
	 where identidad='$_REQUEST[id]'");
	$script = "alert('Donante eliminado');";
}
if(isset($_REQUEST['accion']) && $_REQUEST['accion']=='crear')
{		
	$usuarios = mysql_query("select * from donante where identidad='$_REQUEST[tipo]$_REQUEST[cedula]';");
	if($u=mysql_fetch_assoc($usuarios))
	$script = "alert('ESTE USUARIO YA EXISTE');";
	else
	{
	mysql_query("insert into donante(nombre,apellido,telefono,identidad,activo)
		values ('$_REQUEST[nombre]','$_REQUEST[apellido]'
		,'$_REQUEST[telefono]','$_REQUEST[tipo]$_REQUEST[cedula]','1');");
		$script="alert('Registro Exitoso');";
	}
}
require_once('header.php'); ?>
<script>

function validarDonante()
{
	var error='';
	var cedula= $('input[name=cedula]').val();
	var nombres= $('input[name=nombre]').val();
	var apelldos= $('input[name=apellido]').val();
	var telefono= $('input[name=telefono]').val();
	if(!(cedula.match(/^\d{5,8}$/)))
	error += 'La cédula debe contener 8 dígitos numericos \n';
	if(!(nombres.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Los nombres solamente pueden tener letras y espacios \n';
	if(!(apelldos.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Los apellidos solamente pueden tener letras y espacios \n';
	if(!(telefono.match(/^\d{7,11}$/)))
	error += 'El telefono debe ser hasta 11 digitos numericos \n';
	if(error!='') alert(error);
	return error;
}	

function crearDonante()
{
	if(validarDonante()=='')
	{	$('form').attr('action','donantes.php?accion=crear');
	$('form').submit();}
}

function modificarDonante()
{
	if(validarDonante()=='')
	{	$('form').attr('action','donantes.php?accion=modificar');
	$('form').submit();}
}

function datosDonante2()
{
	var er='';
	if(!($('fieldset[name=datosdonante] input[name=cedula]').val().match(/^\d{5,9}$/)))
		{
			er += 'Eso no parece una cédula\n';
		}
	if(er=='')
	$('fieldset[name=datosdonante]').load("datosdonante2.php",
	{cedula:$('fieldset[name=datosdonante] select[name=tipo]').val()+$('fieldset[name=datosdonante] input[name=cedula]').val()});
	else alert(er);
}

$(function()
	{
		$('input[type=text]').blur(
		function()
		{
			$(this).val($(this).val().toUpperCase());
		}
		);
	});
$(function(){
	<?php echo $script; ?>
	});
</script>
		<form class="alineado lector" action="donantes.php" method="post">
		<center><h3>Registrar Donante</h3>
		<fieldset name="datosdonante">
			<legend>Datos del Donante</legend>
			
			<label>C&eacute;dula o RIF</label>
			<select style="width:50px;" name="tipo">
			<option value="V-">V-</option>
			<option value="E-">E-</option>
			<option value="J-">J-</option>
			</select><input style="width:85px;" required type="text" name="cedula" maxlength="8" placeholder="Ej: 20230001"/>*<br/>
			<input type="button" onclick="datosDonante2();" value="Buscar">
			<label>* Datos obligatorios.</label>
		</fieldset>
		</form>
<?php require_once('footer.php'); ?>
