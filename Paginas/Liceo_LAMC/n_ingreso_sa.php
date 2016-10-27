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
			</td>			>			
			</tr>
			</table>
		</ul>
				
	</nav>
	
	<section id="contenedor">
		<section id="area">
			<h2 align="center">Inscripción Nuevo Ingreso</h2>
			<h2 align="center">Datos Salud. Paso 7/8</h2>
			<br />
			<form name="inscripcion" method="post" action="registro_salud.php">
				<table width="500px" align="center" class="fondo">
					</tr>
					<tr>
						<td colspan="2">
							<label>Talla</label>
						</td>
						<td colspan="2">
							<input type="text" name="talla_es" size="20" maxlength="3" value="" required class="inputexto" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Peso</label>
						</td>
						<td colspan="2">
							<input type="text" name="peso_es" size="20" maxlength="6" value="" required class="inputexto" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Índice de Masa Corporal</label>
						</td>
						<td colspan="2">
							<input type="text" name="IMC_es" size="20" maxlength="4" value="" required class="inputexto" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Tipo de Sangre</label>
						</td>
						<td colspan="2">
							<select name="t_sangre" class="inputexto">
								<option>A</option>
								<option>O</option>
								<option>B</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Factor</label>
						</td>
						<td colspan="2">
							<select name="f_sangre" class="inputexto">
								<option>RH Positivo</option>
								<option>RH Negativo</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>¿Padece alguna Enfermedad?</label>
						</td>
						<td colspan="2">
							<input type="text" name="enfer_es" size="20" maxlength="40" class="inputexto" value="" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>¿Padece alguna Alergia?</label>
						</td>
						<td colspan="2">
							<input type="text" name="aler_es" size="20" maxlength="40" class="inputexto" value="" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>¿Emplea algún Medicamento Especial?</label>
						</td>
						<td colspan="2">
							<input type="text" name="medic_es" size="20" maxlength="40" class="inputexto" value="" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>¿Presenta alguna Condición Especial o Diversidad Funcional?</label>
						</td>
						<td colspan="2">
							<select name="condicion_es" class="inputexto">
								<option>Ninguna</option>
								<option>Retardo Mental</option>
								<option>Autismo</option>
								<option>Impedimento Físico</option>
								<option>Deficiencia Visual</option>
								<option>Deficiencia Auditiva</option>
								<option>Otra Condición</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Otra Condición. Especifique</label>
						</td>
						<td colspan="2">
							<input type="text" name="condi_espe" size="20" maxlength="40" class="inputexto" value="" />
						</td>
					</tr>
					<tr>
					<tr>
						<td colspan="2">
							<label>¿Está siendo Atendido/a?</label>
						</td>
						<td colspan="2">
							<select name="atendido_es" class="inputexto">
								<option>Si</option>
								<option>No</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Especifique Servicio o Centro de Apoyo</label>
						</td>
						<td colspan="2">
							<input type="text" name="cen_apoyo" size="20" maxlength="40" class="inputexto" value="" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>¿Tiene Informes (médico, psicológico, pedagógico)? </label>
						</td>
						<td colspan="2">
							<select name="informe_med" class="inputexto">
								<option>Si</option>
								<option>No</option>
							</select>
						</td>
					</tr>
					<tr height="10px">
						<td colspan="4">
						</td>
					</tr>
					<tr>
						<td>
								<a href="n_ingreso_do.php">
									<input type="button" name="anterior" value="" style="height:50px; width:50px; margin-left:10px; background:		url(anterior.png) center no-repeat;" title="Ir atras" class="botones" />
								</a>
							<td align="left">
								<input type="submit" name="guardar" value="" style="height:50px; width:50px; margin-right:20px; background:		url(guardar1.png) center no-repeat;" title="Guardar datos" class="botones" />
							</td>
							<td align="left">
								<input type="reset" name="cancelar" value="" style="height:50px; width:50px; margin-right:50px; margin-left:-15px; background:		url(cancelar1.png) center no-repeat;" title="Cancelar" class="botones" />
							</td>
							</td>
							<td align="right">
								<a href="n_ingreso_in.php">
									<input type="button" name="siguiente" value="" style="height:50px; width:50px; margin-right:10px; background:		url(siguiente.png) center no-repeat;" title="Pág. Sigiente" class="botones"/>
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
