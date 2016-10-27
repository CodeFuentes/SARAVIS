<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	if(isset($_GET['cancelar']))
	{
		if(isset($_SESSION['prestamos']))
		unset($_SESSION['prestamos'][$_GET['cancelar']]);
	}
	if(isset($_GET['solicitar']))
	{
		$yametido=false;
		
		if(isset($_SESSION['prestamos']))
		foreach($_SESSION['prestamos'] as $p)
		{
			if($p['id_ejemplar']==$_GET['solicitar'])
			{
				$script = "alert('Ya ha sido solicitado este ejemplar');";
				$yametido=true;
			}
		}
		if(!$yametido)
		{
				$datos = mysql_query("select * from libro where 
				cota=(select cota from ejemplar where cota_particular='$_GET[solicitar]');");
				$dato = mysql_fetch_array($datos);
				if(!isset($_SESSION['prestamos']))$_SESSION['prestamos']=array();
				$_SESSION['prestamos'][] = array('id_ejemplar'=>$_GET['solicitar'],
												'nombre'=>$dato['titulo']);
		}
	}

require_once('header.php'); ?>
		<script>
$(function(){
	<?php echo $script; ?>
	});
		function cargarEjemplares()
		{
			$('div#ejemplares').load('cargarejemplares.php',
			{libro:$('select[name=libro]').val(),
				lector:'<?php echo $_REQUEST['id'];?>'});
		}
		</script>
		<div class="relleno2">
		<table class="dataTable">
			<thead>
			<tr>
			<th>Nombre Libro</th>
			<th>ID Ejemplar</th>
			<th>Acciones</th>
			</tr>
			</thead>
			<tbody>
			<?php
			if(isset($_SESSION['prestamos']))
			foreach($_SESSION['prestamos'] as $k=>$p)
				echo "<tr><td>$p[nombre]</td><td>$p[id_ejemplar]</td><td><a href=\"prestarlibros.php?id=$_REQUEST[id]&cancelar=$k\">Cancelar</a></td></tr>";
			?>
			</tbody>
		</table>
		</div>
		<form class="alineado lector" action="prestarlibros2.php" method="post">
		<fieldset>
			<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>"/>
			<legend>Prestar Libros</legend>
			<label>Libro</label><select name="libro" onchange="cargarEjemplares();">
				<option value="">Seleccione</option>
				<?php 
			$resultados = mysql_query("select * from libro;",$c);
			if($resultados)
			while($r2=mysql_fetch_array($resultados))
			echo "<option value=\"$r2[cota]\">$r2[titulo] ($r2[autor])</option>";
			?>
			</select>
			<div id="ejemplares">
			</div>
			<input type="submit" value="Continuar"/>
		</fieldset>
		</form>
<?php require_once('footer.php'); ?>
