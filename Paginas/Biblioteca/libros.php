<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	$script='';
if(isset($_REQUEST['elim']) && isset($_REQUEST['cota']))
{
	mysql_query("update libro
	set activo='0'
	 where cota='$_REQUEST[cota]'");
	$script = "alert('Libro eliminado');";
}
if(isset($_REQUEST['cota']) && !isset($_REQUEST['envio']))
{
	$resultados = mysql_query("select * from libro where cota='$_REQUEST[cota]'");
	if(!$resultados || !($r=mysql_fetch_array($resultados)))
	$script= "alert('Libro inexistente'); window.location='libros.php';";
}
else if(isset($_REQUEST['envio']))
{
	switch($_REQUEST['envio'])
	{
		case "Enviar": 
		$id= date("dmY")."-".rand(1,1000);
		mysql_query("insert into libro(cota,titulo,autor,editorial,ano,materia)
		values ('$id','$_REQUEST[titulo]','$_REQUEST[autor]'
		,'$_REQUEST[editorial]','$_REQUEST[ano]','$_REQUEST[materia]');");
		$script = "alert('Libro Registrado'); window.location='libros.php';";
		break;
		
		case "Modificar": 
		$resultados = mysql_query("select * from libro 
		where cota='$_REQUEST[cota]'");
		if(!$resultados || !($r=mysql_fetch_array($resultados)))
		$script = "alert('Cota no registrada'); window.location='lectores.php';"; 
		mysql_query("update libro
		set titulo='$_REQUEST[titulo]',autor='$_REQUEST[autor]',
		editorial='$_REQUEST[editorial]'
		,ano='$_REQUEST[ano]',materia='$_REQUEST[materia]' where cota='$_REQUEST[cota]';");
		$script = "alert('Datos modificados'); window.location='libros.php';";
		break;
	}
}

require_once('header.php'); ?>
<script>

function validamePapi()
{
	var error='';
	var titulo= $('input[name=titulo]').val();
	var autor= $('input[name=autor]').val();
	var editorial= $('input[name=editorial]').val();
	var culo= $('input[name=ano]').val();
	if(!(culo.match(/^\d{1,4}$/)))
	error += 'El año debe ser un numero \n';
	if(titulo=='')
	error += 'Debe colocar un titulo \n';
	if(!(autor.match(/^[a-zA-Z ñÑóÓéÉáÁíÍúÚ]{2,60}$/)))
	error += 'Debe especificar el nombre de un autor \n';
	if(editorial=='')
	error += 'Debe colocar el nombre de una editorial \n';
	if(!error)
	$('form').submit();
	else
	alert(error);
}	

$(function(){
	<?php echo $script; ?>
	});
</script>
		<div class="relleno2">
		<table class="dataTable">
			<thead>
			<tr>
			<th>Cota</th>
			<th>Titulo</th>
			<th>Autor</th>
			<th>Acciones</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$resultados = mysql_query("select * from libro where activo='1';",$c);
			if($resultados)
			while($r2=mysql_fetch_array($resultados))
			echo "<tr><td>$r2[cota]</td><td>$r2[titulo]</td><td>$r2[autor]</td><td><a href=\"libros.php?cota=$r2[cota]\">Modificar</a></td></tr>";
			?>
			</tbody>
		</table>
		</div>
		<form class="alineado lector" action="libros.php" method="post">
		<fieldset>
			<legend>Registro de Libros</legend>
			<?php if(isset($r) && $r!=0) { ?>
			<label>Cota</label>
				<label><?php echo $r['cota']; ?></label>
				<input type="hidden" name="cota" value="<?php echo $r['cota']; ?>"/>
				<?php } ?>
			<label>T&iacute;tulo</label><input required type="text" 
			value="<?php if(isset($r)) echo $r['titulo']; ?>" name="titulo"/>
			<label>Autor</label><input required type="text"
			value="<?php if(isset($r)) echo $r['autor']; ?>"  name="autor"/>
			<label>Editorial</label><input required type="text"
			value="<?php if(isset($r)) echo $r['editorial']; ?>" name="editorial"/>
			<label>A&ntilde;o</label><input required type="text"
			value="<?php if(isset($r)) echo $r['ano']; ?>" name="ano"/>
			<label>Materia</label><select name="materia">
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
			</select>
<?php 	if(isset($r) && $r!=0){	?>
	<input type="hidden" name="envio" value="Modificar"> 
	<input type="button" name="envio" onclick="validamePapi();" value="Modificar"> 
	<input type="button" onclick="if(confirm('Realmente desea eliminar este libro (Ninguno de sus ejemplares figurará de ahora en adelante)?')) window.location='libros.php?elim=1&cota=<?php echo $r['cota']; ?>';" name="envio" value="Eliminar"> 
<?php 	}else{	?>
	<input type="hidden" name="envio" value="Enviar"> 
	<input type="button" name="envio" onclick="validamePapi();" value="Enviar"> 
	<input type="button" value="Inventario de Libros" onclick="window.location='inventario.php';"/>
<?php } ?>
		</fieldset>
		</form>
<?php require_once('footer.php'); ?>
