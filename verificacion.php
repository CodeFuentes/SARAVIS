<?php

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

$id = $_POST['codigo'];
//codigo Prueba = 1-9-127
$codigoCorrecto = 'NO';

list($idCurso, $idEdicion, $idPersona) = explode('-', $id);

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
	vistaGestor::documentoNormal('', array('vistas/curso/datosCodigo.html', 'vistas/btnSalir.html'));
}
else
{ 
	echo "<script> alert('Participante no encontrado.'); 
	window.location = './';
	</script>"; 
	
}
?>