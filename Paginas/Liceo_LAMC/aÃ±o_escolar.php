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
		<table width="1242px" height="110px">
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
		<table width="1242px" height="30px" align="center">
			<tr valign="top">
				<td valign="top">   
       				<a href="inicio_prueba.php" title="Inicio"><img src="icono_home.png" align="right" width="37px" height="37px" ></a>
					<ul class="menu">
						<li>
        					<a href="#"><img src="confi.png" width="40px" height="40px" align="right"></a>
							<ul>
								<li><a href="salir.php">Cerrar Sesi�n</a></li>
								<li><a href="#">Cambiar Contrase�a</a></li>
							</ul>
						</li>
						
							
					
						
					
					<img src="icono_sesion.png" width="32px" height="32px" align="right">
					<p align="right">     </p>
					<p align="right">Sesi�n</p>
				</td>
			</tr>
		</table>
	</nav>
	
	<nav id="nav">
		<ul class="mainmenu">
			<li>
				<a href="#">Registros</a>
				<ul>
					<li><a href="a�o_escolar.php">A�o Escolar</a></li>
					<li><a href="secciones.php">Secciones</a></li>
					<li><a href="estudiantes.php">Estudiantes</a></li>
					<li><a href="profesores.php">Profesores</a></li>
				</ul>
			</li>
			<li>
				<a href="#">Escolaridad</a>
				<ul>
					<li><a href="n_ingreso.php">Nuevo Ingreso </a></li>
					<li><a href="r_ingreso.php">Ingreso Regular </a></li>
					<li><a href="retiro.php">Retiro </a></li>
				</ul>
			</li>
		</ul>
				
	</nav>
	
	<section id="contenedor">
		<section id="area">
			<h2 align="center">Registrar el A�o Escolar</h2>
			<form name="a_escolar" method="post" action="registro_ae.php">
			<table align="center" width="500px">
				<tr>
					<td>
						<label>Nombre</label>
					</td>
					<td>
						<input type="text" name="nombre_ae" value="" size="18" maxlength="9" />
					</td>
				</tr>
				<tr>
					<td>
						<label>Incio</label>
					</td>
					<td>
						<input type="date" name="fechai_ae" value="" size="18" />
					</td>
				</tr>
				<tr>
					<td>
						<label>Culminaci�n</label>
					</td>
					<td>
						<input type="date" name="fechac_ae" value="" size="18" />
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="guardar" value="Guardar" title="Guardar" />
					</td>
					<td colspan="2">
						<input type="reset" name="cancelar" value="Cancelar" title="Cancelar" />
					</td>
				</tr>
			</table>
		</section>
	</section>
	
	<footer id="pie_pag">
	</footer>
</body>
</html>
