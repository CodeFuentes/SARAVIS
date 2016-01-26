<?php
include ("conexion.php");

$sql="select * from d_representante where ci_r='".$_REQUEST['ci_r']."'";
$cursor= mysql_query($sql);
$bus= mysql_fetch_array($cursor);

if($bus)
{
?>
<script language="javascript">
alert("lo Encontraste");
</script>
<?php
	include ("inicio.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta charset=UTF-8>
		<meta ="viewport" content="width=divice-width, Initial scale=1" />
		<link rel="stylesheet" href="estilo.css" />
	<title>Documento sin t&iacute;tulo</title>
</head>

<body>
	<header id="Encabezado">
		<table width="1242px"  height="110px">
			<tr>
				<td width="90px" height="100px" valign="top">
					<img src="logo_machado.png" align="left" width="90px" height="100px" />
				</td>
				<td valign="top" width="1200px" height="100px">
				<h3 align="center">
					República Bolivariana de Venezuela
					<br />
					Ministerio del Poder Popular para la Educación
					<br />
					U. E. N. "Luis Augusto Machado Cisneros"
					<br />
					La Victoria - Edo. Aragua.
				</h3>
				</td>
				<td width="90px" height="100px" valign="top" align="right">
					<img src="logo_upta.png" align="right" width="90px" height="100px"  />
				</td>
			</tr>
		</table>
	</header>
	
		<nav id="barra">
		<table width="1242px" height="32px" align="center">
			<tr valign="top">
				<td valign="top">   
       				<a href="inicio_prueba.php" title="Inicio"><img src="icono_home.png" align="right" width="37px" height="37px" ></a>
					
							<img src="confi.png" width="40px" height="40px" align="right">
						<ul class="menu">
						<li>
        					<a href="#"><img src="icono_sesion.png" width="32px" height="32px" align="right" class="img"></a>
					<ul>
								<li><a href="salir.php">Cerrar Sesión</a></li>
								<li><a href="#">Cambiar Contraseña</a></li>
							</ul>
						</li>
					<p align="right">     </p>
					<p align="right"><?php echo $_SESSION['usuario']; ?></p>
				</td>
			</tr>
		</table>
	</nav>
	
	<nav id="nav">
		<ul class="mainmenu">
		<table align="center" class="barra_nav" width="1242px">
			<tr valign="top">
			<td width="177px">
			<li>
				<a href="#">Registros</a>
				<ul>
					<li><a href="a_escolar.php">Año Escolar</a></li>
					<li><a href="secciones.php">Secciones</a></li>
					<li><a href="materias.php">Materias</a></li>
					<li><a href="busqueda_es.php">Estudiantes</a></li>
					<li><a href="busqueda_re.php">Representantes</a></li>
					<li><a href="busqueda_pro.php">Profesores</a></li>
				</ul>
			</li>
			</td>
			<td width="177px">
			<li>
				<a href="#">Escolaridad</a>
				<ul>
					<li><a href="n_ingreso.php">Nuevo Ingreso </a></li>
					<li><a href="r_ingreso.php">Ingreso Regular </a></li>
					<li><a href="retiro.php">Retiro </a></li>
				</ul>
			</li>
			</td>
			<td width="177px">
			<li>
				<a href="#">Asistencia</a>
				<ul>
					<li><a href="permiso_prof.php">Permiso</a></li>
					<li><a href="inasis_prof.php">Inasistencia</a></li>
					<li><a href="retardo_prof.php">Retardo</a></li>
					<li><a href="reposo_prof.php">Reposo</a></li>
				</ul>
			</li>
			</td>
			<td width="177px">
			<li>
				<a href="#">Horarios</a>
				<ul>
					<li><a href="g_horario.php">Generar Horario</a></li>
					<li><a href="b_horariodo.php">Horario Docente</a></li>
				</ul>
			</li>
			</td>
			<td width="177px">
			<li>
				<a href="#">Consultas</a>
				<ul>
					<li><a href="c_matricula.php">Matricula</a></li>
					<li><a href="b_listas.php">Nominas por Sección</a></li>
					<li><a href="b_fichain.php">Resumen Ficha de Incripción</a></li>
					<li><a href="b_constancia.php">Constancia de Estudio</a></li>
					<li><a href="b_horario.php">Horarios</a></li>
					<li><a href="b_asispersonal.php">Asistencia Personal</a></li>
					<li>
				<a href="#">Estadística</a>
				<ul>
					<li><a href="b_asis_indi.php">Asistencia Individual</a></li>
					<li><a href="asis_general.php">Asistencia General</a></li>			
				</ul>
			</li>					
				</ul>
			</li>
			</td>						
			</tr>
			</table>
		</ul>
				
	</nav>
	
	<section id="contenedor">
		<section id="area">
				<h2 align="center">Consultas</h2>
				<h2 align="center">Datos del Representante.</h2>
				<br />
			<form name="datos_repre" method="post" action="editar_re.php">
					<table align="center" width="500px" class="fondo">
						<tr>
							<td>
								<label>Tipo</label>
							</td>
							<td colspan="2">
								<select name="tipo_r" class="inputexto" >
									<option>Madre</option>
									<option>Padre</option>
									<option>Otro</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>C. I.:</label>
							</td>
							<td>
								<select name="doc_r" class="inputexto">
									<option>V</option>
									<option>E</option>
								</select>
							</td>
							<td>
								<input type="text" name="ci_r" value="<?php echo $bus['ci_r']?>" size="20" maxlength="8"class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Nombres</label>
							</td>
							<td colspan="2">
								<input type="text" name="nombre_r" value="<?php echo $bus['nombre_r']?>" size="30" maxlength="35" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Apellidos</label>
							</td>
							<td colspan="2">
								<input type="text" name="apellido_r" value="<?php echo $bus['apellido_r']?>" size="30" maxlength="35" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Fecha de Nacimiento</label>
							</td>
							<td colspan="2">
								<input type="date" name="fechan_r" value="<?php echo $bus['fechan_r']?>" size="30" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Grado de Instruccion</label>
							</td>
							<td colspan="2">
								<select name="grado_in_r" class="inputexto">
									<option>Primaria</option>
									<option>Bachiller</option>
									<option>Medio-Tecnico</option>
									<option>TSU</option>
									<option>Licenciado</option>
									<option>Ingeniero</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Ocupación</label>
							</td>
							<td colspan="2">
								<input type="text" name="ocupacion_r" size="30" value="<?php echo $bus['ocupacion_r']?>" maxlength="35" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Lugar de Trabajo</label>
							</td>
							<td colspan="2">
								<input type="text" name="ltrabajo_r" size="30" value="<?php echo $bus['ltrabajo_r']?>" maxlength="40" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Telefono</label>
							</td>
							<td>
								<input type="text" name="telf_r" size="6" value="<?php echo $bus['telf_r']?>" maxlength="4" required class="inputexto"/>
							</td>
							<td>
								<input type="text" name="telf_r" size="16" value="<?php echo $bus['telf_r']?>" maxlength="7" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Lugar de Origen</label>
							</td>
							<td colspan="2">
								<input type="text" name="origen_r" size="30" maxlength="35" value="<?php echo $bus['origen_r']?>" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Estado Civil</label>
							</td>
							<td colspan="2">
								<select name="ec_r" class="inputexto">
									<option>Soltero</option>
									<option>Casado</option>
									<option>Divorciado</option>
									<option>Viudo</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Dirección</label>
							</td>
							<td colspan="2">
								<input type="text" name="direccion_r" size="40" maxlength="150" value="<?php echo $bus['direccion_r']?>" required class="inputexto" />
							</td>
						</tr>
						<tr>
							<td>
								<label>Vive con el Grupo Familiar</label>
							</td>
							<td colspan="2">
								<select name="grupo_fr" class="inputexto">
									<option>Si</option>
									<option>No</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align="center">
								<input type="submit" name="Modificar" value="" style="height:50px; width:50px; margin-left:10px; background:		url(editar.png) center no-repeat;" title="Modificar Datos" class="botones" />
							</td>
							<td>
							</td>
							<td align="center">
								<input type="reset" name="cancelar" value="" style="height:50px; width:50px; margin-right:10px; margin-left:20px; background:		url(cancelar1.png) center no-repeat;" title="Cancelar" class="botones" />
							</td>
					</tr>
				</table>
			</form>
					
		</section>
	</section>
	
	<footer id="pie_pag"> <h5 align="center">Todos los Derechos Reservados. Comp-LOA © 2014</h5>
	</footer>
</body>
</html>
<?php }
else
{
?>
<script language="javascript">
alert("no existe!");
location.href='busqueda_es.php';
</script>
<?php }
