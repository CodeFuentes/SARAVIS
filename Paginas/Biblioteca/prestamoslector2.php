<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	$r=0;
	$script = '';
$prestamos = mysql_query("select * from prestamo where id_lector='$_REQUEST[cedula]' and estado LIKE '%NO DEVUELTO%';")
		or die(mysql_error());
		
?>
<legend>Prestamos Pendientes</legend>
			<table><thead>
			<tr><th>Cota</th>
			<th>Fecha prestado</th>
			<th>Fecha devolucion</th>
			<th></th></tr>
			</thead>
			<tbody id="cuerpoeyuca">
			<?php 
			$num = mysql_num_rows($prestamos);
			$p = mysql_fetch_assoc($prestamos);
			if(!$p)
				echo '<tr><td colspan="3">No hay prestamos pendientes</td></tr>';
			else
				do
				{
					echo "<tr><td>$p[id_ejemplar]</td><td>$p[fecha_c]</td><td>$p[fecha_r]</td><td><input type=\"button\" onclick=\"window.location='devolver.php?id=$p[id_p]'\" value=\"Devolver\"/></td></tr>";
				}while($p = mysql_fetch_assoc($prestamos));
			?>
			</tbody></table>
<?php if($num<2) { ?>
Libros a pedir:
<select name="cantidad" style="width:50px;">
<?php 
for($i=0;$i<=2-$num;$i++)
echo "<option>$i</option>";
?>
</select>
<input type="button"  onclick="prestar()" value="Prestar Libros" />
<?php } ?>
