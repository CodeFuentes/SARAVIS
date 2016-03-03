<h4>Categor&iacute;a</h4>
</ul>
<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	$resultados = mysql_query("select * from categoria;",$c);
	$categorias='';
	if($resultados)
		while($r2=mysql_fetch_array($resultados))
		$categorias.="<option value=\"$r2[id_dewey]\">".utf8_encode($r2['nombre'])."</option>";
	
	for($i=0;$i<$_REQUEST['cantidad'];$i++)
	{
		echo "<li><select name=\"categoria\" data-n=\"$i\" onchange=\"cargarCategorias($i)\">$categorias</select><span id=\"libros_$i\"></span></li>";
	}
	?>
</ul>
<input type="button"  onclick="prestarFIN()" value="Finalizar" />
