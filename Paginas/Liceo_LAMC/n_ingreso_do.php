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
			<h2 align="center">Inscripci�n Nuevo Ingreso</h2>
			<h2 align="center">Documentos Presentados Paso 6/8</h2>
			<br />
			<form name="document" action="registro_do.php" method="post">
				<table align="center" width="500px" class="fondo">
					<tr>
						<td colspan="2">
							<label>Partida de Nacimiento Original.</label>
						</td colspan="2">
						<td>
							<input type="checkbox" name="partida_o" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Copia de la Partida de Nacimiento.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="c_partida" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>C�dula de la Madre.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="ced_ma" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>c�dula del Padre.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="ced_pa" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>C�dula del Representante.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="ced_re" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>C�dula del Estudiante.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="ced_es" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Boleta de Promoci�n.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="boleta" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Fotos del Estudiante.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="foto_es" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Foto del representante.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="foto_re" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Otros.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="otros" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Certificaci�n de Calificaciones.</label>
						</td>
						<td colspan="2">
							<input type="checkbox" name="notas" value="true" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Tipo de Certificaci�n de claificaciones.</label>
						</td>
						<td colspan="2">
							<select name="tipo_notas" class="inputexto">
								<option>Original</option>
								<option>Copia</option>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Documentos Pendientes.</label>
						</td>
						<td colspan="2">
							<input type="text" name="pendiente" value="" size="20" maxlength="25" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Fecha de Entrega.</label>
						</td>
						<td colspan="2">
							<input type="date" name="f_entrega" value="" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<label>Observaciones.</label>
						</td>
						<td colspan="2">
							<textarea name="obser_do" cols="30" rows="2" class="inputexto">
							</textarea>
						</td>
					</tr>
					<tr>
						<td>
								<a href="n_ingreso_fa.php">
									<input type="button" name="anterior" value="" style="height:50px; width:50px; margin-left:10px; background:		url(anterior.png) center no-repeat;" title="Ir atras" class="botones" />
								</a>
							<td align="center">
								<input type="submit" name="guardar" value="" style="height:50px; width:50px; margin-right:20px; background:		url(guardar1.png) center no-repeat;" title="Guardar datos" class="botones" />
							</td>
							<td align="center">
								<input type="reset" name="cancelar" value="" style="height:50px; width:50px; margin-right:10px; margin-left:20px; background:		url(cancelar1.png) center no-repeat;" title="Cancelar" class="botones" />
							</td>
							</td>
							<td align="right">
								<a href="n_ingreso_sa.php">
									<input type="button" name="siguiente" value="" style="height:50px; width:50px; margin-right:10px; background:		url(siguiente.png) center no-repeat;" title="P�g. Sigiente" class="botones"/>
						</td>
					</tr>
				</table>
		</section>
	</section>
	
	<footer id="pie_pag"> <h5 align="center">Todos los Derechos Reservados. Comp-LOA � 2014</h5>
	</footer>
</body>
</html>