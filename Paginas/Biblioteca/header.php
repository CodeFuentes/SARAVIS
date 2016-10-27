<!DOCTYPE html>
<html lang="es">

<head>
	<title>Biblioteca</title>
    <link rel="shortcut icon" href="img/115px-Icono_libros.ico">
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<script class="text/javascript" src="js/jquery.min.js"></script>
	<script class="text/javascript" src="js/datatables.min.js"></script>
	<script class="text/javascript" src="js/jquery-ui.js"></script>
	<script class="text/javascript">
		$(function(){$('input.fecha').datepicker()});
		
		function hacerDonacion()
		{
			var error=0,errores='';
			if($('select[name=cota]').val()=='')
			{
				errores+='Falta el libro\n';
				error++;
			}
			if($('select[name=id]').val()=='')
			{
				errores+='Falta el donante\n';
				error++;
			}
			if($('input[name=cantidad]').val()=='')
			{
				errores+='Falta la cantidad\n';
				error++;
			}
			if(!error)
			$('table tbody').load('registrardonacion.php',
								{
									cota:$('select[name=cota]').val(),
									id:$('select[name=id]').val(),
									cantidad:$('input[name=cantidad]').val()
								});
			else alert(errores);
		}
		
		function DesactivaroActivar()
		{
			
			if($('select[name=tipo]').val()=='estudiante')
			{
				$('select[name=turno]').removeAttr('disabled');
				$('select[name=grado]').removeAttr('disabled');
			}
			else
			{
				$('select[name=turno]').attr('disabled','disabled');
				$('select[name=grado]').attr('disabled','disabled');
			}
		}
	</script>
	<link rel="stylesheet" href="css/estilos.css" type="text/css" /> 
	<link rel="stylesheet" href="css/demo_table.css" type="text/css" /> 
	<link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css" /> 
</head>

<body>
	<div class="todo">
    <div class="header">
	<a href="http://www.ueplgbolivar.webs.tl" title="U.E.P 'Libertador y Generalisimo Bol&iacute;var'"><img src="img/banner.jpg" class="header"/></a>
    </div>

<?php if(isset($_SESSION['sesioniniciada'])) {?>
	<div class="cabeza">
	<a href="home.php" title="Ir a la P&aacute;gina Principal"><img src="img/casita.png" class="icono"/></a>
    <a href="http://www.facebook.com/coordinadoras.lgb"  title="Facebook"><img src="img/facebook.png" class="icono"/ ></a>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    <b>Sesi&oacute;n Iniciada como <?php echo $_SESSION['nombre']; ?></b>
	<a href="salir.php" title="Cerrar Sesi&oacute;n"><img src="img/salir.png" class="icono"/></a>
    </div>
    
	<ul class="menu">
    <li><a>Registro</a>
	<ul>
		<li><a href="lectores.php">Lectores</a></li>
		<li><a href="donantes.php">Donantes</a></li>
		<li><a href="donaciones.php">Ingreso de libros</a></li>
        <li><a href="#">Inventario</a></li>
	</ul>
	</li>
	<li><a>Procesos</a>
	<ul>
		<li><a href="prestamos.php">Pr&eacute;stamos</a></li>
		<li><a href="devoluciones.php">Devoluciones</a></li>
	</ul></li>
	<li><a>Reportes</a>
	<ul>
		<li><a href="reporte1.php">Lectores con pr&eacute;stamos</a></li>
		<li><a href="reporte2.php">Lectores morosos</a></li>
		<li><a href="reporte3.php">Historial de pr&eacute;stamo</a></li>
		<li><a href="reporte5.php">Historial de devoluci&oacute;n</a></li>
		<li><a href="reporte6.php">Historial de donantes</a></li>
	</ul></li>
	<?php if($_SESSION['tipocuenta']=='ADMIN'){ ?>
	<li><a>Mantenimiento</a>
	<ul>
		<li><a href="laauditoria.php">Registro de eventos</a></li>
	</ul></li>
	<?php } ?>
	<li><a>Ayuda</a></li>
	</ul>
<?php } else {?>
	<ul class="cabeza">
	<div class="alineate">
	<a href="index.php" title="Ir a la P&aacute;gina Principal"><img src="img/casita.png" class="icono"/></a>
    <a href="http://www.facebook.com/coordinadoras.lgb" title="Facebook"><img src="img/facebook.png" class="icono"/></a>
    <a href="iniciosesion.php" title="Inicie Sesi&oacute;n"><img src="img/llaveinutil.png" class="icono"/></a>
    </div>
	</ul>
<?php } ?>
	<div class="cuerpo">