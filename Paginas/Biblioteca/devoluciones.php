<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	$script = '';
if(isset($_REQUEST['tipo']))
{
	foreach($_REQUEST['libro'] as $l)
	{
		$ls = mysql_query("select * from libro where cota='$l'");
		$datal=mysql_fetch_assoc($ls);
		$fecha = date("Y-m-d");
		if($datal['uso']=='SALA')
		{
			$fechaf=date("Y-m-d");
		}
		else
		{
			$fechaf=date("Y-m-d",strtotime($fecha)+60*60*24*2);
		}
		$sql = "insert into prestamo(id_lector,id_ejemplar,fecha_c,fecha_r,estado,multa)
		values('$_REQUEST[tipo]$_REQUEST[cedula]','$l','$fecha','$fechaf','NO DEVUELTO',0)";
		mysql_query($sql);
		mysql_query("update libro set prestado='1' where cota='$l'");
		$script="alert('Prestamos concedidos.');";
	}
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
	error += 'La cédula debe contener 8 dígitos \n';
	if(!(nombres.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Los nombres solamente pueden tener letras y espacios \n';
	if(!(apelldos.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Los apellidos solamente pueden tener letras y espacios \n';
	if(!(telefono.match(/^\d{7,11}$/)))
	error += 'El telefono debe ser de digitos, hasta 11 \n';
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

function prestamosUsuario()
{
		$('fieldset[name=librosapedir]').load("librosapedir.php",
	{cedula:$('fieldset[name=datosdonante] select[name=tipo]').val()+$('fieldset[name=datosdonante] input[name=cedula]').val()});
	$('fieldset[name=datosprestamos]').show(500);
}

function cargarCategorias(n)
{
	var cate = $('select[data-n='+n+']').val();
	$('span#libros_'+n).load('librosporcategoria.php',{id_dewey:cate});
}

function prestarFIN()
{
	$('form').submit();
}

function prestamosUsuario()
{
	var er='';
	if(!($('fieldset[name=datosdonante] input[name=cedula]').val().match(/^\d{5,9}$/)))
		{
			er += 'Eso no parece una cédula\n';
		}
	if(er=='')
	{
		$('fieldset[name=datosprestamos]').load("prestamoslector2.php",
	{cedula:$('fieldset[name=datosdonante] select[name=tipo]').val()+$('fieldset[name=datosdonante] input[name=cedula]').val()});
	$('fieldset[name=datosprestamos]').show(500);
	}else alert(er);
}

function prestar()
{
	$('fieldset[name=librosapedir]').load("libros2.php",
	{cantidad:$('select[name=cantidad]').val()});
	$('fieldset[name=librosapedir]').show(500);
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
		<form class="alineado lector" action="prestamos.php" method="post">
		<center><h3>Registrar Devoluci&oacute;n</h3>
		<fieldset name="datosdonante">
			<legend>Datos del Lector</legend>
			
			<label>C&eacute;dula o RIF</label>
			<select style="width:50px;" name="tipo">
			<option value="V-">V-</option>
			<option value="E-">E-</option>
			<option value="J-">J-</option>
			</select><input style="width:85px;" required type="text" name="cedula" maxlength="8" placeholder="Ej: 20230001"/>*<br/>
			<input type="button" onclick="prestamosUsuario();" value="Buscar">
		</fieldset>
		<fieldset name="datosprestamos" style="display:none;">
			<legend>Prestamos Pendientes</legend>
			<table><thead>
			<tr><th>Cota</th>
			<th>Fecha prestado</th>
			<th>Fecha devolucion</th></tr>
			</thead>
			<tbody id="cuerpoeyuca"></tbody></table>
		</fieldset>
		<fieldset name="librosapedir" style="display:none;"></fieldset>
		</form>
<?php require_once('footer.php'); ?>
