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
		<h2 align="center">Registro Datos del Docente. Paso 2</h2>
		<br />
		<form name="D_Especialidad_pr" method="post" action="registro_pro2.php">
			<table align="center" class="fondo" width="500px">
				<tr>
					<td width="200px">
						<label>Grado de Instruccion</label>
					</td>
						<td colspan="2">
							<select name="grain_pr" class="inputexto">
								<option>Profesor</option>
								<option>Licenciado</option>
								<option>Postgrado</option>
								<option>Magister</option>
								<option>Doctorado</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="200px">
							<label>Especialidades:</label>
						</td>
						<td>
						<label>Especialidad 1</label>
							<input type="text" name="esp1_pr" size="20px" maxlength="20" class="inputexto" required />
						</td>
						<td>
						<label>Especialidad 2</label>
							<input type="text" name="esp2_pr" size="20px" maxlength="20" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td width="200px">
							<label>Materias que Imparte:</label>
						</td>
						<td>
						<label>Materia 1</label>
							<input type="text" name="mat1_pr" size="20px" maxlength="20" class="inputexto" required />
						</td>
						<td>
						<label>Materia 2</label>
							<input type="text" name="mat2_pr" size="20px" maxlength="20" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td width="200px">
							<label>¿Estudia Actualmente?</label>
						</td>
						<td colspan="2">
							<select name="esac_pr" class="inputexto">
								<option>Si</option>
								<option>No</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="200px">
							<label>Titulo a Obtener</label>
						</td>
						<td colspan="2">
							<input type="text" name="tiob_pr" size="20px" maxlength="45" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td width="200px">
							<label>¿Trabaja en Otra Institucion?</label>
						</td>
						<td colspan="2">
							<select name="teoi_pr" class="inputexto">
								<option>Si</option>
								<option>No</option>
							</select>
						</td>
					</tr>
					<tr>
						<td width="200px">
							<label>Diga Cual</label>
						</td>
						<td>
							<input type="text" name="dicu_pr" size="20px" maxlength="45" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td align="center" width="245px">
							<input type="submit" value="" class="botones" style="height:50px; width:50px; margin-left:60px; background:		url(guardar1.png) center no-repeat;" title="Buscar"/>
						</td>
						<td width="10px">
						</td>
						<td align="center" width="245px">
							<input type="reset" value="" class="botones" style="height:50px; width:50px; margin-right:15px; background:		url(cancelar1.png) center no-repeat;" title="Cancelar" />
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

