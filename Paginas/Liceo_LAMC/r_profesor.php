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
					<li><a href="busqueda_pro.php">Profesosres</a></li>
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
					<li><a href="n_ingreso.php">Permiso</a></li>
					<li><a href="r_ingreso.php">Inasistencia</a></li>
					<li><a href="retiro.php">Retardo</a></li>
					<li><a href="retiro.php">Reposo</a></li>
				</ul>
			</li>
			</td>
			<td width="177px">
			<li>
				<a href="#">Horarios</a>
				<ul>
					<li><a href="n_ingreso.php">Generar Horario</a></li>
					<li><a href="r_ingreso.php">Horario Docente</a></li>
				</ul>
			</li>
			</td>
			<td width="177px">
			<li>
				<a href="#">Consultas</a>
				<ul>
					<li><a href="n_ingreso.php">Matricula</a></li>
					<li><a href="r_ingreso.php">Nominas por Sección</a></li>
					<li><a href="n_ingreso.php">Resumen Ficha de Incripción</a></li>
					<li><a href="retiro.php">Constancia de Estudio</a></li>
					<li><a href="r_ingreso.php">Horarios</a></li>
					<li><a href="retiro.php">Asistencia Personal</a></li>
					<li>
				<a href="#">Estadística</a>
				<ul>
					<li><a href="n_ingreso.php">Asistencia Individual</a></li>
					<li><a href="r_ingreso.php">Asistencia General</a></li>			
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
		<h2 align="center">Registro Datos del Docente</h2>
		<br />
			<form name="d_profesor" method="post" action="registro_pro.php">
				<table align="center" class="fondo" width="500px">
					<tr>
						<td>
							<label>CI:</label>
						</td>
						<td>
							<select name="doc_pr" class="inputexto">
								<option>V</option>
								<option>E</option>
							</select>
						</td>
						<td>
							<input type="text" name="ci_pr" size="16px" maxlength="8" class="inputexto" required />
						</td>
					</tr>
					<tr>
						<td>
							<label>Apellidos</label>
						</td>
						<td colspan="2">
							<input type="text" name="ape_pr" size="20px" maxlength="35" class="inputexto" required />
						</td>
					</tr>
					<tr>
						<td>
							<label>Nombres</label>
						</td>
						<td colspan="2">
							<input type="text" name="nom_pr" size="20px" maxlength="35" class="inputexto" required />
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

