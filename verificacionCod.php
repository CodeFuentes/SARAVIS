<?php
header("Content-Type: text/html; charset=iso-8859-1");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

error_reporting(0);
require_once 'nucleo/configuracion/baseDatos.php';
require_once 'nucleo/bdGestor.php';
require_once 'nucleo/vistaGestor.php';
require_once 'nucleo/validarCampo.php';
require_once 'nucleo/generarPDF.php';
require_once 'nucleo/utilidades/catalogoFunciones.php';
require_once 'nucleo/utilidades/listadoGenerador.php';
require_once 'modelos/curso.php';
require_once 'modelos/edicion.php';

$id = $_GET['id'];

$codigoCorrecto = 'NO';
		
list($idCurso, $idEdicion, $idPersona) = explode('-', $_GET['id']);

$curso = curso::cargarCurso($idCurso);
			
if(!empty($curso))
{
	$edicion = $curso->seleccionarEdicion($idEdicion);
				
	if(!empty($edicion))
	{
		if($edicion->dameEstado() == 'bloqueada')
		{
			$colParticipantes = $edicion->dameColParticipantes();
							
			$persona = $edicion->buscarParticipante($idPersona);
							
			if(!empty($persona))
			{
				$codigoCorrecto = 'CORRECTO';
			}
		}
	}
}
			
if($codigoCorrecto == 'CORRECTO')
{				
	$nombreCurso = $curso->dameNombre();					
	$tipoCurso = $edicion->dameTipoLegible();
	$duracion = $edicion->dameDuracion();
    $fechaInicio = invertirFecha($edicion->dameFechaInicio());
    $fechaFinal = invertirFecha($edicion->dameFechaFin());
	$nombrePersona = $persona->dameNombre();
	$apellidoPersona = $persona->dameApellido();
	$cedulaPersona = $persona->dameDocumento();

	vistaGestor::agregarDiccionario('nombreCurso', $nombreCurso);
	vistaGestor::agregarDiccionario('tipoEdicion', $tipoCurso);
	vistaGestor::agregarDiccionario('idEdicion', $edicion->dameId());
	vistaGestor::agregarDiccionario('duracionEdicion', $duracion);
	vistaGestor::agregarDiccionario('inicioEdicion', invertirFecha($fechaInicio));
	vistaGestor::agregarDiccionario('finalEdicion', invertirFecha($fechaFinal));							
	vistaGestor::agregarDiccionario('nombrePersona', $nombrePersona);
	vistaGestor::agregarDiccionario('apellidoPersona', $apellidoPersona);
	vistaGestor::agregarDiccionario('documentoPersona', $cedulaPersona);
	vistaGestor::agregarArchivoCss('formularios');
	vistaGestor::agregarNotificacionPermanente('exito', 'El c&oacute;digo es correcto');
	vistaGestor::documentoNormal('Verificar c&oacute;digo de Participaci&oacute;n', array('vistas/curso/datosCodigo.html', 'vistas/btnSalir.html'));
}
else
{ 
	echo "<script> alert('Participante no encontrado.'); </script>"; 
	header('Location: ./?');
}
?>