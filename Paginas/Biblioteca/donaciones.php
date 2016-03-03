<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	$script = '';
if(isset($_REQUEST['tipo_d']))
{
	$resultados = mysql_query
	("select * from donante where identidad='$_REQUEST[tipo]$_REQUEST[cedula]'") or die(mysql_error());
	if(!$r=mysql_fetch_array($resultados))
	mysql_query("insert into donante(identidad,nombre,apellido,telefono) values(
	'$_REQUEST[tipo]$_REQUEST[cedula]',
	'$_REQUEST[nombre]','$_REQUEST[apellido]','$_REQUEST[telefono]')");
	foreach($_REQUEST['uso'] as $k=>$v)
	{
		$cota = $_REQUEST['materia']."-".rand(1000,9999)."-".$_REQUEST['estante'][$k];
		$autor = $_REQUEST['nombre_a']." ".$_REQUEST['apellido_a'];
		mysql_query("insert into libro
		(cota,titulo,autor,ano,editorial,materia,id_donante,estante,uso,activo) values(
		'$cota',
		'$_REQUEST[titulo]',
		'$autor',
		'$_REQUEST[ano]',
		'$_REQUEST[editorial]',
		'$_REQUEST[materia]',
		'$_REQUEST[tipo]$_REQUEST[cedula]',
		'".$_REQUEST['estante'][$k]."',
		'$v',
		'1')") or die(mysql_error());
	}
	$script = "alert('Registro exitoso. Se han guardado $_REQUEST[cantidad] libro(s).');";
}

require_once('header.php'); ?>
<script>

function cambiarTipo()
{
 if($('select[name=tipo_d]').val()=='Donación')
 $('fieldset[name=datosdonante]').removeAttr('disabled');
 else
 {
 $('fieldset[name=datosdonante]').attr('disabled','disabled');
 }
  $('fieldset[name=datoslibro]').show(1000);
}

function datosDonante()
{
	var er='';
	if(!($('fieldset[name=datosdonante] input[name=cedula]').val().match(/^\d{5,9}$/)))
		{
			er += 'Eso no parece una cédula\n';
		}
	if(er=='')
	$('fieldset[name=datosdonante]').load("datosdonante.php",
	{cedula:$('fieldset[name=datosdonante] select[name=tipo]').val()+$('fieldset[name=datosdonante] input[name=cedula]').val()});
	else alert(er);
}

function Continuar()
{
	var error='';
	var titulo= $('input[name=titulo]').val();
	var nombre_a= $('input[name=nombre_a]').val();
	var apellido_a= $('input[name=apellido_a]').val();
	var editorial= $('input[name=editorial]').val();
	var ano= $('input[name=ano]').val();
	var cantidad= $('input[name=cantidad]').val();
	if(!(ano.match(/^\d{1,4}$/)))
	error += 'El año debe ser un numero \n';
	if(!(cantidad.match(/^\d{1,2}$/)))
	error += 'La cantidad debe ser un numero \n';
	if(titulo=='')
	error += 'Debe colocar un titulo \n';
	if(!(nombre_a.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Debe especificar el nombre de un autor \n';
	if(!(apellido_a.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Debe especificar el apellido de un autor \n';
	if(editorial=='')
	error += 'Debe colocar el nombre de una editorial \n';
	if(!error)
	{
		var i, html1='';
		$('fieldset[name=datosdonacion]').html('');
		html1 = '<table><tr><td>ID</td><td>Uso</td><td>Estante</td></tr>';
		for(i=1;i<=cantidad;i++)
		html1 += 
'<tr><td>'+i+'</td><td><select name="uso[]"><option>CIRCULANTE</option><option>SALA</option></select></td><td><select name="estante[]"><option>G1</option><option>G2</option><option>G3</option><option>P1</option></select></td></tr>';
		html1 += '</table><input type="button" value="Guardar Donaci&oacute;n" onclick="Donacion();"/>';
		$('fieldset[name=datosdonacion]').html(html1);
		$('fieldset[name=datosdonacion]').show(1000);
	}
	else
	alert(error);
	return error;
}

function Donacion()
{
	var error='';
	if($('select[name=tipo_d]').val()=='Donación')
	{
	
	var error='';
	var cedula= $('input[name=cedula]').val();
	var nombres= $('input[name=nombre]').val();
	if($('input[name=nombre]').val()==undefined)
	{ alert("Primero rellene los datos del lector");
	return ;}
	var apelldos= $('input[name=apellido]').val();
	var telefono= $('input[name=telefono]').val();
	if(!(cedula.match(/^\d{5,8}$/)))
	error += 'La cédula debe contener 8 dígitos numericos \n';
	if(!(nombres.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Los nombres solamente pueden tener letras y espacios \n';
	if(!(apelldos.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Los apellidos solamente pueden tener letras y espacios \n';
	if(!(telefono.match(/^\d{7,11}$/)))
	error += 'El telefono debe ser de 11 digitos numericos \n';
	}
	var titulo= $('input[name=titulo]').val();
	var nombre_a= $('input[name=nombre_a]').val();
	var apellido_a= $('input[name=apellido_a]').val();
	var editorial= $('input[name=editorial]').val();
	var ano= $('input[name=ano]').val();
	var cantidad= $('input[name=cantidad]').val();
	if(!(ano.match(/^\d{1,4}$/)))
	error += 'El año debe ser un numero \n';
	if(!(cantidad.match(/^\d{1,2}$/)))
	error += 'La cantidad debe ser un numero \n';
	if(titulo=='')
	error += 'Debe colocar un titulo \n';
	if(!(nombre_a.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Debe especificar el nombre de un autor \n';
	if(!(apellido_a.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Debe especificar el apellido de un autor \n';
	if(editorial=='')
	error += 'Debe colocar el nombre de una editorial \n';
	if(error=='')
	{
		$('form').submit();
	}
	else
	alert(error);
	return error;
}

function validar()
{
	var error='';
	var cantidad= $('input[name=cantidad]').val();
	if(!(cantidad.match(/^\d{1,2}$/)))
	error += 'La cantidad debe ser un numero \n';
	if(error=='') $('form').submit();
	else alert(error);
}
$(function()
	{
		$('input[type=text], textarea').blur(
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
<form class="alineado lector" action="donaciones.php" method="post">
		<center><h3>Registrar Ingreso de Libros</h3>
		<label>Tipo de Ingreso</label>
			<select onchange="cambiarTipo()" name="tipo_d" required>
			<option value=""></option>
			<option>Directo</option>
			<option>Donaci&oacute;n</option>
			</select>*</center>
		<fieldset name="datosdonante" disabled>
			<legend>Datos del Donante</legend>
			
			<label>C&eacute;dula o RIF</label>
			<select style="width:50px;" name="tipo">
			<option value="V-">V-</option>
			<option value="E-" >E-</option>
			<option value="J-">J-</option>
			</select><input style="width:85px;" required type="text" name="cedula" maxlength="8" placeholder="Ej: 20230001"/>*<br/>
			<input type="button" onclick="datosDonante();" value="Buscar">
		</fieldset>
		<fieldset name="datoslibro" style="display:none;">
			<legend>Datos del libro a Registrar</legend>
		<label>T&iacute;tulo</label><input required type="text"  name="titulo" placeholder="Ej: El principito"/>*
			<label>Nombre del autor</label><input required type="text"  name="nombre_a" placeholder="Ej: Pedro"/>*
			<label>Apellido del autor</label><input required type="text"  name="apellido_a" placeholder="Ej: Perez"/>*
			<label>Editorial</label><input required type="text" name="editorial" placeholder="Ej: Santillana"/>*
			<label>A&ntilde;o de edici&oacute;n</label><input required type="text" name="ano" placeholder="Ej: 1993"/>*
			<label>Categor&iacute;a</label><select name="materia">
			<?php 
			$resultados = mysql_query("select * from categoria;",$c);
			if($resultados)
			while($r2=mysql_fetch_array($resultados))
			{
				if(isset($r) && $r['materia']==$r2['id_dewey']) $seleccionado="selected";
				else $seleccionado='';
				echo "<option value=\"$r2[id_dewey]\" ".$seleccionado.">".utf8_encode($r2['nombre'])."</option>";
			}
			?>
			</select>*
			<label>Cantidad a donar:</label><input required type="text"
			 name="cantidad" placeholder="Ej: 4"/>*
			<input type="button" value="Continuar" onclick="Continuar();">
		</fieldset>
		<fieldset name="datosdonacion" style="display:none;"></fieldset>
<label>* Datos obligatorios.</label>
		</form>
		<div class="relleno2">
		</div>
		
<?php require_once('footer.php'); ?>
