<?php
	include ("inicio.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
					Rep�blica Bolivariana de Venezuela
					<br />
					Ministerio del Poder Popular para la Educaci�n
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
								<li><a href="salir.php">Cerrar Sesi�n</a></li>
								<li><a href="#">Cambiar Contrase�a</a></li>
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
					<li><a href="a_escolar.php">A�o Escolar</a></li>
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
					<li><a href="b_listas.php">Nominas por Secci�n</a></li>
					<li><a href="b_fichain.php">Resumen Ficha de Incripci�n</a></li>
					<li><a href="b_constancia.php">Constancia de Estudio</a></li>
					<li><a href="b_horario.php">Horarios</a></li>
					<li><a href="b_asispersonal.php">Asistencia Personal</a></li>
					<li>
				<a href="#">Estad�stica</a>
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
				<h2 align="center">Incripci�n Nuevo Ingreso</h2>
				<h2 align="center">Datos de La Padre. Paso 2/8</h2>
				<br />
				<form name="incripcion_n_p" method="post" action="registro_in_p.php">
					<table align="center" width="500px" class="fondo">
						<tr>
							<td>
								<label>C. I.:</label>
							</td>
							<td align="right">
								<select name="doc_p" class="inputexto">
									<option>V</option>
									<option>E</option>
								</select>
							</td>
							<td class="2">
								<input type="text" name="ci_p" value="" size="20" maxlength="8" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Nombres</label>
							</td>
							<td colspan="3">
								<input type="text" name="nombre_p" value="" size="30" maxlength="35" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Apellidos</label>
							</td>
							<td colspan="3">
								<input type="text" name="apellido_p" value="" size="30" maxlength="35" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Fecha de Nacimiento</label>
							</td>
							<td colspan="3">
								<input type="date" name="fechan_p" value="" size="30" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Grado de Instruccion</label>
							</td>
							<td colspan="3">
								<select name="grado_in_p" class="inputexto">
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
								<label>Ocupaci�n</label>
							</td>
							<td colspan="3">
								<input type="text" name="ocupacion_p" size="30" value="" maxlength="35" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Lugar de Trabajo</label>
							</td>
							<td colspan="3">
								<input type="text" name="ltrabajo_p" size="30" value="" maxlength="40" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Telefono</label>
							</td>
							<td>
								<input type="text" name="telf_p" size="6" value="" maxlength="4" required class="inputexto"/>
							</td>
							<td colspan="2">
								<input type="text" name="telf_p" size="16" value="" maxlength="7" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Lugar de Origen</label>
							</td>
							<td colspan="3">
								<input type="text" value="" name="origen_p" size="30" maxlength="25" required class="inputexto"/>
							</td>
						</tr>
						<tr>
							<td>
								<label>Estado Civil</label>
							</td>
							<td colspan="3" class="inputexto">
								<select name="ec_p" class="inputexto">
									<option>Soltero</option>
									<option>Casado</option>
									<option>Divorciado</option>
									<option>Viudo</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label>Direcci�n</label>
							</td>
							<td colspan="3">
								<textarea name="direccion_p" rows="3" cols="30" required  class="inputexto">
								</textarea>
							</td>
						</tr>
						<tr>
							<td>
								<label>Vive con el Grupo Familiar</label>
							</td>
							<td colspan="2">
								<select name="grupo_fp" class="inputexto">
									<option>Si</option>
									<option>No</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<a href="n_ingreso.php">
									<input type="button" name="anterior" value="" style="height:50px; width:50px; margin-left:10px; background:		url(anterior.png) center no-repeat;" title="Ir atras" class="botones" />
								</a>
							<td align="center">
								<input type="submit" name="guardar" value="" style="height:50px; width:50px; margin-right:20px; background:		url(guardar1.png) center no-repeat;" title="Guardar datos del Padre" class="botones" />
							</td>
							<td align="center">
								<input type="reset" name="cancelar" value="" style="height:50px; width:50px; margin-right:20px; background:		url(cancelar1.png) center no-repeat;" title="Cancelar" class="botones" />
							</td>
							</td>
							<td>
								<a href="n_ingreso_r.php">
									<input type="button" name="siguiente" value="" style="height:50px; width:50px; margin-right:10px; background:		url(siguiente.png) center no-repeat;" title="P�g. Sigiente" class="botones" />
								</a>
							</td>
						</tr>
					</table>
				</form>										
		</section>
	</section>
	
	<footer id="pie_pag"> <h5 align="center">Todos los Derechos Reservados. Comp-LOA � 2014</h5>
	</footer>
</body>
</html>

