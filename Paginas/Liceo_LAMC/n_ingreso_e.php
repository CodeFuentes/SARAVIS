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
	</nav>
	
	<section id="contenedor">
		<section id="area">
				<h2 align="center">Incripción Nuevo Ingreso</h2>
				<h2 align="center">Datos del Estudiante. Paso 4/8</h2>
				<br />
			<form name="datos_estudiante" action="registro_in_es.php" method="post">
				<table align="center" class="fondo" width="500px">
					<tr>
						<td>
							<label>C. I.:</label>
						</td>
						<td align="right">
							<select name="doc_es">
								<option>V</option>
								<option>E</option>
							</select>
						</td>
						<td colspan="2" align="left">
							<input type="text" name="ci_es" size="15" maxlength="8" value="" required class="inputexto" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Apeliidos</label>
						</td>
						<td colspan="3">
							<input type="text" name="ape_es" size="20" maxlength="30" value="" required class="inputexto"/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Nombres</label>
						</td>
						<td colspan="3">
							<input type="text" name="nom_es" size="20" maxlength="30" value="" required class="inputexto"/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Género</label>
						</td>
						<td colspan="3">
							<select name="sex_es" class="inputexto">
								<option>Masculino</option>
								<option>Femenino</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Fecha de Nacimiento</label>
						</td>
						<td>
							<input type="date" name="fechanac_es" value="" required class="inputexto" />
						</td>
						<td>
							<label>Edad</label>
						</td>
						<td align="left">
							<input type="text" name="edad_es" value="" size="5" maxlength="2" required class="inputexto" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Lugar de Nacimiento</label>
						</td>
						<td colspan="3">
							<input type="text" name="lugarnac_es" value="" size="20"  maxlength="35" required class="inputexto"/>
						</td>
					</tr>
					<tr>
						<td>
							<label>Vive Con:</label>
						</td>
						<td>
							<select name="vive_es" class="inputexto">
								<option>Madre</option>
								<option>Padre</option>
								<option>Ambos</option>
								<option>Abuelos</option>
								<option>Otros</option>
							</select>
						</td>
						<td>
							<label>Especifique</label>
						</td>
						<td>
							<input type="text" name="vive_e_es" value="" size="20" maxlength="60" required class="inputexto" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Direccioón</label>
						</td>
						<td colspan="3">
							<textarea name="direc_es" rows="3" cols="40" class="inputexto">
							</textarea>
						</td>
					</tr>
					<tr>
						<td>
							<label>Fecha de Ingreso</label>
						</td>
						<td colspan="3">
							<input type="date" name="fechain_es" value="" required class="inputexto" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Observaciones</label>
						</td>
						<td colspan="3">
							<textarea name="obser_es" rows="3" cols="40" class="inputexto">
							</textarea>
						</td>
					</tr>
					<tr>
						<td>
								<a href="n_ingreso_r.php">
									<input type="button" name="anterior" value="" style="height:50px; width:50px; margin-left:10px; background:		url(anterior.png) center no-repeat;" title="Ir atras" class="botones" />
								</a>
							<td align="center">
								<input type="submit" name="guardar" value="" style="height:50px; width:50px; margin-right:20px; background:		url(guardar1.png) center no-repeat;" title="Guardar datos del Estudiante" class="botones" />
							</td>
							<td align="center">
								<input type="reset" name="cancelar" value="" style="height:50px; width:50px; margin-right:10px; margin-left:20px; background:		url(cancelar1.png) center no-repeat;" title="Cancelar" class="botones" />
							</td>
							</td>
							<td align="right">
								<a href="n_ingreso_fa.php">
									<input type="button" name="siguiente" value="" style="height:50px; width:50px; margin-right:10px; background:		url(siguiente.png) center no-repeat;" title="Pág. Sigiente" class="botones" />
						</td>
					</tr>
				</table>
					
		</section>
	</section>
	
	<footer id="pie_pag"> <h5 align="center">Todos los Derechos Reservados. Comp-LOA © 2014</h5>
	</footer>
</body>
</html>
