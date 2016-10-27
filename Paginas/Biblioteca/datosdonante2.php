<?php 
session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
require_once("conexion.php");

$nombres = "";
$apellidos = "";
$telefono = "";
$encontrado = false;
list($cedula1,$cedula2) = explode('-',$_REQUEST['cedula']);
$cedula2='';
$cedula1='';
$rs = mysql_query("select * from donante where activo='1' and identidad='$_REQUEST[cedula]'") or die(mysql_error());
if($a = mysql_fetch_assoc($rs))
{
$nombres = $a['nombre'];
$apellidos = $a['apellido'];
list($cedula1,$cedula2) = explode('-',$a['identidad']);
$telefono = $a['telefono'];
$encontrado = true;
}
?>

	  <legend>Registro de Donantes</legend>
			<label>C&eacute;dula o RIF</label>
			<select style="width:50px;" name="tipo">
			<option value="V-" <?php if($cedula1=='V') echo 'selected';?>>V-</option>
			<option value="E-" <?php if($cedula1=='E') echo 'selected';?>>E-</option>
			<option value="J-" <?php if($cedula1=='J') echo 'selected';?>>J-</option>
			</select><input style="width:85px;" required type="text"
			value="<?php echo $cedula2; ?>"
			 name="cedula" placeholder="Ej: 20230001"/>*
	<label>Nombres</label><input required type="text" 
			value="<?php echo $nombres; ?>" name="nombre" placeholder="Ej: Mar&iacute;a Josefina"/>*
			<label>Apellidos</label><input required type="text"
			value="<?php echo $apellidos; ?>"  name="apellido" placeholder="Ej: L&oacute;pez Landaeta"/>*
			<label>Tel&eacute;fono</label><input required type="text"
			value="<?php echo $telefono; ?>"  name="telefono" placeholder="Ej: 04120432103"/>*
<?php if($encontrado) { ?>
	<input type="button" onclick="modificarDonante();" value="Guardar Cambios">
	<input type="button" onclick="if(confirm('Realmente desea eliminar al donante?'))window.location='donantes.php?elim=1&id=<?php echo $_REQUEST['cedula'];?>';" value="Eliminar">
<?php }else {?>
	<input type="button" onclick="crearDonante();" value="Guardar Datos">
<?php } ?>
<label>* Datos obligatorios.</label>
<script>
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
