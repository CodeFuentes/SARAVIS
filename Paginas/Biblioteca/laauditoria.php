<?php
session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
include('header.php');
?>
<form enctype="multipart/form-data" action="auditoria.php" method="post" class="login">
<center><fieldset>
	<legend>Registro de eventos</legend>
	<table>
	<tr>
	<td>Desde</td>
	<td><input class="fecha" type="text"  name="desde" placeholder="Presione para seleccionar fecha" size="30"/></td>
	</tr>
	<tr>
	<td>Hasta</td>
	<td><input class="fecha" type="text"  name="hasta" placeholder="Presione para seleccionar fecha" size="30"/></td>
	</tr>
	<tr>
	<td><input type="submit" value="Ver Operaciones"/></td>
	</tr>
	</fieldset></center></table>
</form>
<?php
include('footer.php');
?>
