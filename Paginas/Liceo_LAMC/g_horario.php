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
			<h2 align="center">Horarios</h2>
			<h2 align="center">Generar Horarios de Clase.</h2>
			<br />
			<br />
			<form name="g_horario.php" action="horario_sec.php" method="post">
				<table align="center" width="500px" class="fondo">
					<tr height="25px">
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td >
						<label>Año Escolar</label>
						</td>
						<td>
						<select name="anio_es" class="inputexto">
							<option>2013-2014</option>
							<option>2014-2015</option>
						</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Grado</label>
						</td>
						<td>
							<input type="text" name="gradi" size="12" value="" maxlength="1" class="inputexto" required/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Sección</label>
						</td>
						<td>
							<input type="text" name="nom_sec" size="12" value="" maxlength="1" class="inputexto" required/>
						</td>
					</tr>
					<tr>
						<td align="center" width="250px">
							<input type="submit" value="" style="height:50px; width:50px; margin-left:60px; background:		url(horario.png) center no-repeat;" title="Generar Horario" class="botones"/>
						</td>
						<td align="center" width="250px">
							<input type="reset" value="" style="height:50px; width:50px; margin-right:15px; background:		url(cancelar1.png) center no-repeat;" title="Cancelar" class="botones" />
						</td>
					</tr>
					</tr>
					<tr height="3px">
						<td>
						</td>
						<td>
						</td>
					</tr>
					<tr>
				</table>
		</section>
	</section>
	
	<footer id="pie_pag"> <h5 align="center">Todos los Derechos Reservados. Comp-LOA © 2014</h5>
	</footer>
</body>
</html>