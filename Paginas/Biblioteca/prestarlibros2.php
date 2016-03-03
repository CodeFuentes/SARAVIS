<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	if(isset($_POST['envio']))
	{
		$fecha_c = date("Y-m-d");
		$fecha_r = date("Y-m-d",time()+3600*24*1);
		
		foreach($_SESSION['prestamos'] as $k=>$p)
		{
			mysql_query("insert into prestamo
			(id_ejemplar,id_lector,fecha_c,fecha_r,estado,multa)
			values
			('$p[id_ejemplar]','$_REQUEST[id]','$fecha_c','$fecha_r','NO DEVUELTO','0')") or die(mysql_error());
		}
		unset($_SESSION['prestamos']);
		 echo "<script>alert('Prestamo registrado'); window.location='index.php';</script>";
	}
	
	$resultados = mysql_query("select * from lector where id='$_REQUEST[id]'");
	if(!$resultados || !($lector=mysql_fetch_array($resultados)))
	die("<script>alert('Lector inexistente'); window.location='lectores.php';</script>");

require_once('header.php'); ?>
		<script>
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
			</tr>
			</thead>
			<tbody>
			<?php
			if(isset($_SESSION['prestamos']))
			foreach($_SESSION['prestamos'] as $k=>$p)
				echo "<tr><td>$p[nombre]</td><td>$p[id_ejemplar]</td></tr>";
			?>
			</tbody>
		</table>
		</div>
		<form class="alineado lector" action="prestarlibros2.php" method="post">
		<fieldset>
			<input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>"/>
			<legend>Prestar Libros</legend>
			<label>Lector:</label><label><?php echo $lector['nombre']." ".$lector['apellido']; ?></label>
			<label>Fecha de Pr&eacute;stamo</label><label><?php echo date("d\/m\/Y");?></label>
			<label>Fecha de Devoluci&oacute;n</label><label><?php echo date("d\/m\/Y",time()+3600*24*1);?></label>
			
			<input type="submit" name="envio" value="Prestar"/>
		</fieldset>
		</form>
<?php require_once('footer.php'); ?>
