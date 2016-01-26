<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	$script = '';
if(isset($_REQUEST['accion']) && $_REQUEST['accion']=='modificar')
{
	if(!isset($_REQUEST['grado']))$_REQUEST['grado']='';
	if(!isset($_REQUEST['turno']))$_REQUEST['turno']='';
	mysql_query("update lector
		set nombre='$_REQUEST[nombres]',apellido='$_REQUEST[apellidos]'
		,tipo='$_REQUEST[tipo_lector]'
		,ocupacion='$_REQUEST[ocupacion]'
		,sexo='$_REQUEST[sexo]'
		,direccion='$_REQUEST[direccion]'
		,grado='$_REQUEST[grado]'
		,turno='$_REQUEST[turno]'
		,telefono='$_REQUEST[telefono]' where identidad='$_REQUEST[tipo]$_REQUEST[cedula]';")
		or die(mysql_error());
		$script = "alert('Datos modificados'); window.location='lectores.php';";
}
if(isset($_REQUEST['elim']))
{
	mysql_query("update lector
	set activo='0'
	 where identidad='$_REQUEST[id]'") or die(mysql_error());
	$script = "alert('Lector eliminado');";
}
if(isset($_REQUEST['accion']) && $_REQUEST['accion']=='crear')
{		
	if(!isset($_REQUEST['grado']))$_REQUEST['grado']='';
	if(!isset($_REQUEST['turno']))$_REQUEST['turno']='';
	mysql_query("insert into lector(identidad,nombre,apellido,tipo,ocupacion,activo,multado_hasta,sexo,direccion,telefono,grado,turno)
		values ('$_REQUEST[tipo]$_REQUEST[cedula]','$_REQUEST[nombres]','$_REQUEST[apellidos]'
		,'$_REQUEST[tipo_lector]','$_REQUEST[ocupacion]','1',null,'$_REQUEST[sexo]','$_REQUEST[direccion]','$_REQUEST[telefono]',
		'$_REQUEST[grado]','$_REQUEST[turno]');") or die("<script>alert('Lector existente'); window.location='lectores.php';</script>");
		$script = "alert('Lector registrado'); window.location='lectores.php';";
}
require_once('header.php'); ?>
<script>

function validarLector()
{
	var error='';
	var cedula= $('input[name=cedula]').val();
	var nombres= $('input[name=nombres]').val();
	var apelldos= $('input[name=apellidos]').val();
	var telefono= $('input[name=telefono]').val();
	var ocupacion= $('input[name=ocupacion]').val();
	var tipo= $('select[name=tipo_lector]').val();
	var turno= $('input[name=turno]').val();
	var grado= $('input[name=grado]').val();
	var sexo= $('select[name=sexo]').val();
	var telefono= $('input[name=telefono]').val();
	var direccion= $('textarea[name=direccion]').val();
	
	if(!(cedula.match(/^\d{5,8}$/)))
	error += 'La cédula debe contener 8 dígitos numéricos\n';
	if(!(nombres.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Los nombres solamente pueden tener letras y espacios \n';
	if(!(apelldos.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Los apellidos solamente pueden tener letras y espacios \n';
	if(!(telefono.match(/^\d{7,11}$/)))
	error += 'El telefono debe tener entre 7 y 11 dígitos numéricos \n';
	if(tipo=='Seleccione un tipo')
	error += 'Debe escoger cual tipo de lector va a registrar';
	if(sexo=='Seleccione un sexo')
	error += 'Debe decir el sexo del lector';
	if(ocupacion=='')
	error += 'Debe decir a qué se dedica \n';
	if(direccion=='')
	error += 'Debe especificar su dirección \n';
	if(error!='') alert(error);
	return error;
}	

function crearLector()
{
	if(validarLector()=='')
	{
	$('form').attr('action','lectores.php?accion=crear');
	$('form').submit();
	}
}

function modificarLector()
{
	if(validarLector()=='')
	{	$('form').attr('action','lectores.php?accion=modificar');
	$('form').submit();}
}

function datosLector()
{
	var er='';
	if(!($('fieldset[name=datoslector] input[name=cedula]').val().match(/^\d{5,9}$/)))
		{
			er += 'Eso no parece una cédula\n';
		}
	if(er=='')
	$('fieldset[name=datoslector]').load("datoslector.php",
	{cedula:$('fieldset[name=datoslector] select[name=tipo]').val()+$('fieldset[name=datoslector] input[name=cedula]').val()});
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
		<form class="alineado lector" action="lectores.php" method="post">
		<center><h3>Registrar Lectores</h3></center>
		<fieldset name="datoslector">
			<legend>Datos del Lector</legend>
			
			<label>C&eacute;dula o RIF</label>
			<select style="width:50px;" name="tipo">
			<option value="V-">V-</option>
			<option value="E-">E-</option>
			<option value="J-">J-</option>
			</select><input style="width:85px;" required type="text" name="cedula" maxlength="8" placeholder="Ej: 20230001"/>*<br/>
			<input type="button" onclick="datosLector();" value="Buscar">
			<label>* Datos obligatorios.</label>
		</fieldset>
		</form>
<?php require_once('footer.php'); ?>
