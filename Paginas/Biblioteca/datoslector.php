<?php 
session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
require_once("conexion.php");

$nombres = "";
$apellidos = "";
$telefono = "";
$encontrado = false;
list($cedula1,$cedula2) = explode('-',$_REQUEST['cedula']);
$sexo='';
$direccion='';
$ocupacion='';
$rs = mysql_query("select * from lector where activo='1' and identidad='$_REQUEST[cedula]'") or die(mysql_error());
if($a = mysql_fetch_assoc($rs))
{
$nombres = $a['nombre'];
$apellidos = $a['apellido'];
list($cedula1,$cedula2) = explode('-',$a['identidad']);
$encontrado = true;
$sexo = $a['sexo'];
$telefono = $a['telefono'];
$direccion = $a['direccion'];
$ocupacion = $a['ocupacion'];
}
?>

	  <legend>Registro de Lectores</legend>
			<label>C&eacute;dula</label><select style="width:50px;" name="tipo">
			<option value="V-" <?php if(isset($a) && $cedula1=='V') echo 'selected';?>>V-</option>
			<option value="E-" <?php if(isset($a) && $cedula1=='E') echo 'selected';?>>E-</option>
			<option value="J-" <?php if(isset($a) && $cedula1=='J') echo 'selected';?>>J-</option>
			</select><input style="width:85px;" required type="text"
			value="<?php if(isset($a)) echo $cedula2; ?>"
			 name="cedula" placeholder="Ej: 20230001"/>*
			<label>Nombres</label><input required type="text" 
			value="<?php if(isset($a)) echo $nombres; ?>" name="nombres" placeholder="Ej: Mar&iacute;a Josefina"/>*
			<label>Apellidos</label><input required type="text"
			value="<?php if(isset($a)) echo $apellidos; ?>"  name="apellidos" placeholder="Ej: L&oacute;pez Landaeta"/>*
			<label>Ocupaci&oacute;n</label><input required type="text"
			value="<?php if(isset($a)) echo $ocupacion; ?>" name="ocupacion" placeholder="Ej: Secretario(a)"/>*
			<label>Tipo de Usuario</label><select onchange="cambiarestado();" name="tipo_lector">
				<option>Seleccione un tipo</option>
			<option value="estudiante"
			<?php if(isset($a) && $a['tipo']=='estudiante') echo "selected"; ?>>estudiante</option>
			<option value="externo"
			<?php if(isset($a) && $a['tipo']=='externo') echo "selected"; ?>>externo</option>
			</select>*
			<label>Turno</label><select name="turno" 
			<?php if(!isset($a) || $a['tipo']=='externo') echo 'disabled'; ?> >
			<option value="diurno"
			<?php if(isset($a) && $a['turno']=='diurno') echo "selected"; ?>>Diurno</option>
			<option value="vespertino"
			<?php if(isset($a) && $a['turno']=='verspertino') echo "selected"; ?>>Vespertino</option>
			</select>*
			<label>Grado</label><select name="grado" 
			<?php if(!isset($a) || $a['tipo']=='externo') echo 'disabled'; ?>>
			<option 
			<?php if(isset($a) && $a['grado']=='1') echo "selected"; ?>
			value="1">Primero</option>
			<option value="2"
			<?php if(isset($a) && $a['grado']=='2') echo "selected"; ?>>Segundo</option>
			<option value="3"
			<?php if(isset($a) && $a['grado']=='3') echo "selected"; ?>>Tercero</option>
			<option value="4"
			<?php if(isset($a) && $a['grado']=='4') echo "selected"; ?>>Cuarto</option>
			<option value="5"
			<?php if(isset($a) && $a['grado']=='5') echo "selected"; ?>>Quinto</option>
			<option value="6"
			<?php if(isset($a) && $a['grado']=='6') echo "selected"; ?>>Sexto</option>
			<option value="7"
			<?php if(isset($a) && $a['grado']=='7') echo "selected"; ?>>Primer A&ntilde;o</option>
			<option value="8"
			<?php if(isset($a) && $a['grado']=='8') echo "selected"; ?>>Segundo A&ntilde;o</option>
			<option value="9"
			<?php if(isset($a) && $a['grado']=='9') echo "selected"; ?>>Tercer A&ntilde;o</option>
			<option value="10"
			<?php if(isset($a) && $a['grado']=='10') echo "selected"; ?>>Cuarto A&ntilde;o</option>
			<option value="11"
			<?php if(isset($a) && $a['grado']=='11') echo "selected"; ?>>Quinto A&ntilde;o</option>
			</select>*
			<label>Sexo</label><select  name="sexo">
				<option>Seleccione un sexo</option>
			<option value="F"
			<?php if(isset($a) && $sexo=='F') echo "selected"; ?>>FEMENINO</option>
			<option value="M"
			<?php if(isset($a) && $sexo=='M') echo "selected"; ?>>MASCULINO</option>
			</select>*
			<label>Tel&eacute;fono</label><input required type="text" 
			value="<?php if(isset($a)) echo $telefono; ?>" name="telefono" placeholder="Ej: 04120432103"/>*
			<label>Direcci&oacute;n</label><textarea name="direccion" style="margin-top: 2px;margin-bottom: 2px;height: 32px;resize: none;display: inline;width: 140px;" placeholder="Calle Campo Elias con..."><?php if(isset($a)) echo $direccion; ?></textarea>*
<?php if($encontrado) { ?>
	<input type="button" onclick="window.location='reporte4.php?cedula=<?php echo $cedula1."-".$cedula2;?>';" value="Historial del Lector">
	<input type="button" onclick="modificarLector();" value="Guardar Cambios">
	<input type="button" onclick="if(confirm('Realmente desea eliminar al lector?'))window.location='lectores.php?elim=1&id=<?php echo $_REQUEST['cedula'];?>';" value="Eliminar">
	<INPUT TYPE="button" ONCLICK="history.back()" NAME="Volver atr&aacute;s" VALUE="Cancelar">
<?php }else {?>
	<input type="button" onclick="crearLector();" value="Guardar Datos">
	<INPUT TYPE="button" ONCLICK="history.back()" NAME="Volver atr&aacute;s" VALUE="Cancelar">
<?php } ?><label>* Datos obligatorios.</label>
<script>
	function cambiarestado()
	{
		if($('select[name=tipo_lector]').val()=='estudiante')
		{
			$('select[name=turno]').removeAttr('disabled');
			$('select[name=grado]').removeAttr('disabled');
		}
		else
		{
			$('select[name=turno]').attr('disabled','disabled');
			$('select[name=grado]').attr('disabled','disabled');
		}
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
</script>