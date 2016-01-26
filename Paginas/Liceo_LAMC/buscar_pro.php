<?php
include ("conexion.php");

$sql="select * from d_profesor where ci_pr='".$_REQUEST['ci_prof']."'";
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
				<h2 align="center">Datos del Docente.</h2>
				<br />
			<form name="registro_prof" action="editar_dprofesor.php" method="post">
				<table align="center" width="500px" class="fondo">
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
							<input type="text" name="ci_pr" size="16" maxlength="8" class="inputexto" required value="<?php echo $bus['ci_pr']?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Apellidos</label>
						</td>
						<td colspan="2">
							<input type="text" name="ape_pr" size="20" maxlength="35" class="inputexto" required value="<?php echo $bus['ape_pr']?>" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Nombres</label>
						</td>
						<td colspan="2">
							<input type="text" name="nom_pr" size="20" maxlength="35" value="<?php echo $bus['nom_pr']?>" class="inputexto" required />
						</td>
					</tr>
					<tr>
						<td>
							<label>Fecha de Nacimiento</label>
						</td>
						<td colspan="2">
							<input type="date" name="fec_pr" class="inputexto" value="<?php echo $bus['fec_pr']?>" required />
						</td>
					</tr>
					<tr>
						<td>
							<label>Lugar de Nacimiento</label>
						</td>
						<td colspan="2">
							<input type="text" name="lug_pr" size="20" maxlength="60" value="<?php echo $bus['lug_pr']?>" class="inputexto" required />
						</td>
					</tr>
					<tr>
						<td>
							<label>Género</label>
						</td>
						<td colspan="2">
							<select name="sex_pr" class="inputexto">
								<option>Masculino</option>
								<option>Femenino</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Estado Civil</label>
						</td>
						<td colspan="2">
							<select name="esci_pr" class="inputexto">
								<option>Soltero</option>
								<option>Casado</option>
								<option>Divorciado</option>
								<option>Viudo</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>¿Posee Hijos?</label>
						</td>
						<td colspan="2">
							<select name="pohi_pr" class="inputexto">
								<option>Si</option>
								<option>No</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Cuantos:</label>
						</td>
						<td colspan="2">
							<input type="text" name="cua_pr" size="12" maxlength="1" value="<?php echo $bus['cua_pr']?>" class="inputexto" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Dirección</label>
						</td>
						<td colspan="2">
							<input type="text" name="dire_pr" size="30" maxlength="160" value="<?php echo $bus['dire_pr']?>" class="inputexto" required />
						</td>
					</tr>
					<tr>
						<td>
							<label>Teléfono de Habitación</label>
						</td>
						<td colspan="2">
							<input type="text" name="teca_pr" size="18" maxlength="11" value="<?php echo $bus['teca_pr']?>" class="inputexto" />
						</td>
					</tr>
					<tr> 
						<td>
							<label>Teléfono Celular</label>
						</td>
						<td colspan="2">
							<input type="text" name="tece_pr" size="18" maxlength="11" value="<?php echo $bus['tece_pr']?>" class="inputexto" />
						</td>
					</tr>			
					<tr>
						<td>
							<label>Correo Electronico</label>
						</td>
						<td>
							<input type="text" name="coel_pr" size="20" maxlength="60" value="<?php echo $bus['coel_pr']?>" class="inputexto" />
						</td>
					</tr>

						<tr>
							<td align="center" width="245px">
								<input type="submit" name="Modificar" value="" style="height:50px; width:50px; margin-left:10px; background:		url(editar.png) center no-repeat;" title="Modificar Datos" class="botones" />
							</td>
							<td width="10px">
							</td>
							<td align="center" width="245px">
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
location.href='busqueda_pro.php';
</script>
<?php }