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
			<h2 align="center">Inscripción Nuevo Ingreso</h2>
			<h2 align="center">Datos de la Incripción. Paso 8/8</h2>
			<form name="inscripcion" method="post" action="registro_inscri.php">
				<table width="500px" align="center" class="fondo">
					<tr>
						<td colspan="2">
							<label>Año Escolar</label>
						</td>
						<td colspan="2">
							<select name="anio_escolar" class="inputexto">
								<option>2012-2013</option>
								<option>2013-2014</option>
								<option>2014-2015</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Año</label>
						</td>
						<td colspan="2">
							<select name="grado" class="inputexto">
								<option>1º</option>
								<option>2º</option>
								<option>3º</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Sección</label>
						</td>
						<td colspan="2">
							<select name="seccion" class="inputexto">
								<option>A</option>
								<option>B</option>
								<option>C</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Plantel de Procedencia</label>
						</td>
						<td colspan="2">
							<input type="text" name="plantel" size="20" maxlength="40" value="" required class="inputexto" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Dirección del Plantel</label>
						</td>
						<td colspan="2">
							<textarea name="direc_plantel" class="inputexto" rows="2" cols="20">
							</textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Condición</label>
						</td>
						<td colspan="2">
							<select name="condi_es" class="inputexto">
								<option>Regular</option>
								<option>Repitiente</option>
								<option>Materia Pendiente</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>¿Realiza alguna actividad Deportiva, Cultural o Recreativa?</label>
						</td>
						<td colspan="2">
							<input type="text" name="acti_es" size="20" maxlength="40" value="" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td>
							<label>¿Ha recibido portátil Canaima? Indique serial.</label>
						</td>
						<td>
							<select name="canaima_es" class="inputexto">
								<option>Si</option>
								<option>No</option>
							</select>
						</td>
						<td>
							<label>Serial</label>
						</td>
						<td>
							<input type="text" name="serial_ca" size="12" maxlength="21" value="" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>¿Ha recibido colección Bicentenario?</label>
						</td>
						<td colspan="2">
							<select name="colec_bicen" class="inputexto">
								<option>Si</option>
								<option>No</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left">
							<a href="n_ingreso_do.php">
								<input type="button" name="anterior" value="" style="height:50px; width:50px; margin-left:10px; background:		url(anterior.png) center no-repeat;" title="Ir atras" class="botones" />
							</a>
						<td align="center" colspan="2">
							<input type="submit" name="guardar" value="" style="height:50px; width:50px; margin-right:20px; margin-left:-130px; background:		url(guardar1.png) center no-repeat;" title="Guardar datos" class="botones" />
						</td>
						<td align="right">
							<input type="reset" name="cancelar" value="" style="height:50px; width:50px; margin-right:10px; margin-left:0px; background:		url(cancelar1.png) center no-repeat;" title="Cancelar" class="botones" />
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
