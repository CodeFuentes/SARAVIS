<?php

require_once 'persistencias/edicionPersistencia.php';
require_once 'modelos/persona.php';
require_once 'modelos/certificado.php';
require_once 'modelos/identificador.php';

	class edicion
	{
		private $_idEdicion = NULL;
		private $_tipo;
		private $_estado = NULL;
		
		private $_fechaInicio;
		private $_fechaFin;
		private $_duracion;
		private $_limite;
		private $_horario;
		private $_sinoptico;
		private $_nombreFacilitador;
		private $_facilitador = NULL;
		private $_certificado = NULL;
		private $_identificador = NULL;
		private $_colEstudiantes = array();
		private $_nombreCurso;
		private $_descripcionCurso;
	
		public function __construct($idEdicion, $tipo, $fechaInicio, $fechaFin, $duracion, $limite, 
									$horario, $sinoptico, $estado = '', $nombre, $descripcion)
		{
			$this->_idEdicion = $idEdicion;
			$this->_tipo = $tipo;			
			$this->_fechaInicio = $fechaInicio;
			$this->_fechaFin = $fechaFin;
			$this->_duracion = $duracion;
			$this->_limite = $limite;
			$this->_horario = $horario;
			$this->_sinoptico = $sinoptico;
			$this->_estado = $estado;
			$this->_nombreCurso = $nombre;
			$this->_descripcionCurso = $descripcion;
		}		

		//
		//++
		//+++++
		//		METODOS GETTERS / SETTERS
		//+++++
		//++
		//
		
		public function dameId()
		{
			return $this->_idEdicion;
		}
		
		public function dameTipo()
		{
			return $this->_tipo;
		}
		
		public function dameEstado()
		{
			return $this->_estado;
		}

		public function dameTipoLegible()
		{
			switch($this->_tipo)
			{
				case 'curso_apro':
					$tipoFormateado = 'Curso / Aprobatorio';
				break;
				
				case 'curso_part':
					$tipoFormateado = 'Curso / Participación';
				break;
				
				case 'taller_apro':
					$tipoFormateado = 'Taller / Aprobatorio';
				break;
				
				case 'taller_part':
					$tipoFormateado = 'Taller / Participación';
				break;
			}
			
			return $tipoFormateado;
		}
		
		public function dameFechaFin()
		{
			return $this->_fechaFin;
		}
		
		public function dameFechaInicio()
		{
			return $this->_fechaInicio;
		}
		
		public function dameDuracion()
		{
			return $this->_duracion;
		}
		
		public function dameLimite()
		{
			return $this->_limite;
		}
		
		public function dameHorario()
		{
			return $this->_horario;
		}
		
		public function dameSinoptico()
		{
			return $this->_sinoptico;
		}
		
		public function dameFacilitador()
		{
			return $this->_facilitador;
		}
		
		public function dameCertificado()
		{
			return $this->_certificado;
		}
		
		public function dameIdentificador()
		{
			return $this->_identificador;
		}
		public function dameNombreCurso()
		{
			return $this->_nombreCurso;
		}
		public function dameDescripcionCurso()
		{
			return $this->_descripcionCurso;
		}
		
		public function ponerFacilitador(persona $facilitador)
		{
			$this->_facilitador = $facilitador;
		}
		
		public function ponerCertificado(certificado $certificado)
		{
			$this->_certificado = $certificado;
		}
		
		public function ponerIdentificador(identificador $identificador)
		{
			$this->_identificador = $identificador;
		}
		
		//
		//++
		//+++++
		//		METODOS NORMALES
		//+++++
		//++
		//
		
		public function guardarEstado($guardarEstado)
		{
			$edicionPersistencia = new edicionPersistencia();
			$datosColParticipantes = $edicionPersistencia->guardarEstado($this->_idEdicion, $guardarEstado);
		}
		
		public function dameColParticipantes()
		{
			$edicionPersistencia = new edicionPersistencia();
			$datosColParticipantes = $edicionPersistencia->traerColParticipantes($this->_idEdicion);
			
			
			foreach($datosColParticipantes as $participante)
			{
				$persona = new persona(
							$participante['id_persona'], $participante['documento'], $participante['nombre'],
							$participante['apellido'], $participante['sexo'], $participante['fecha_nacimiento'],
							$participante['telefono'], $participante['direccion'], $participante['correo']
							);
							
				$this->_colEstudiantes[] = $persona;
			}
			
			return $this->_colEstudiantes;
		}
		
		public function registrar($idCurso)
		{
			$edicionPersistencia = new edicionPersistencia();
			$idGenerado = $edicionPersistencia->registrarEdicion(
														$idCurso,														
														$this->_tipo,
														$this->_fechaInicio,
														$this->_fechaFin,
														$this->_duracion,
														$this->_limite,
														$this->_horario,
														$this->_sinoptico
														);
			$this->_idEdicion = $idGenerado;
		}
		
		public function modificar()
		{
			$edicionPersistencia = new edicionPersistencia();
			$idGenerado = $edicionPersistencia->modificarEdicion(
														$this->_idEdicion,												
														$this->_tipo,
														$this->_fechaInicio,
														$this->_fechaFin,
														$this->_duracion,
														$this->_limite,
														$this->_horario,
														$this->_sinoptico
														);
			$this->_idEdicion = $idGenerado;
		}

		public function dameRelacionParticipantes()
		{
			$edicionPersistencia = new edicionPersistencia();
			$arrayDatosRelaciones = $edicionPersistencia->dameRelacionParticipantes($this->_idEdicion);
			
			return $arrayDatosRelaciones;
		}
		
		static public function cargarEdicion($idEdicion)
		{
			$edicionPersistencia = new edicionPersistencia();
			$datosAsociaciones = $edicionPersistencia->cargarEdicion($idEdicion);
			

			foreach($datosAsociaciones as $asociaciones)
			{
					$edicion = new edicion(
							$asociaciones['id_edicion'], $asociaciones['tipo'], $asociaciones['fecha_inicio'],
							$asociaciones['fecha_fin'], $asociaciones['duracion'], $asociaciones['limite'],
							$asociaciones['horario'], $asociaciones['sinoptico'], $asociaciones['estado']
							);
			
				if(!empty($asociaciones['p_id_persona']))
				{
					//$this->_facilitador = persona::cargarPersona($asociaciones['p_id_persona']);
					
					$persona = new persona(
									$asociaciones['p_id_persona'], $asociaciones['p_documento'], $asociaciones['p_nombre'],
									$asociaciones['p_apellido'], $asociaciones['p_sexo'], $asociaciones['p_fecha_nacimiento'],
									$asociaciones['p_telefono'], $asociaciones['p_direccion']
									);
									
					$edicion->_facilitador = $persona;
					/*
					//p.id_persona as p_id_persona, p.documento as p_documento, p.nombre as p_nombre, p.apellido as p_apellido, //p.sexo as p_sexo, p.fecha_nacimiento as p_fecha_nacimiento, p.telefono as p_telefono, p.direccion as p_direccion
					*/
				}
				else
				{
					$edicion->_facilitador = NULL;
				}
				
				if(!empty($asociaciones['c_id_certificado']))
				{
					//$this->_certificado = certificado::cargarCertificado($asociaciones['c_id_certificado']);
					
					$certificado = new certificado(
										$asociaciones['c_id_certificado'], $asociaciones['c_firma_facilitador'], $asociaciones['c_firmas_extras'], $asociaciones['c_fondo'], $asociaciones['c_logo_extra']
										);
										
					$edicion->_certificado = $certificado;
					/*
					//c.id_certificado as c_id_certificado, c.firmas as c_firmas, c.fondo as c_fondo, c.logo_extra as c_logo_extra,
					*/
				}
				else
				{
					$edicion->_certificado = NULL;
				}
				
				if(!empty($asociaciones['i_id_identificador']))
				{	
					//$this->_identificador = identificador::cargarIdentificador($asociaciones['i_id_identificador']);
				
					$identificador = new identificador($asociaciones['i_id_identificador'], $asociaciones['i_fondo']);
					
					$edicion->_identificador = $identificador;
					/*
					//i.id_identificador as i_id_identificador, i.fondo as i_fondo
					*/
				}
				else
				{
					$edicion->_identificador = NULL;
				}
				
				return $edicion;
			}	
		}
		
		public function cuposEdicion()
		{
			$edicionPersistencia = new edicionPersistencia();
			$datosEdicion = $edicionPersistencia->contarParticipantes($this->_idEdicion);
		
			$cupos = $this->_limite - $datosEdicion[0]['cantidad_participantes'];
			return $cupos;
		}		
		
		
		public function asignarFacilitador($idFacilitador)
		{			
			$persona = persona::cargarPersona($idFacilitador);
			
			if(!empty($persona))
			{	
				$edicionPersistencia = new edicionPersistencia();
				$edicionPersistencia->asignarFacilitador($this->_idEdicion, $idFacilitador);
				$retorna = "valor";
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}
		
		public function existeParticipante($idPersona)
		{
			$edicionPersistencia = new edicionPersistencia();
			$datosParticipante = $edicionPersistencia->existeParticipante($this->_idEdicion, $idPersona);
		
			if(!empty($datosParticipante))
			{
				$retorna = 'existeParticipante';
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;		
		}
		
		public function incribirPersona($idPersona)
		{
			$edicionPersistencia = new edicionPersistencia();
			$datosParticipante = $edicionPersistencia->incribirPersona($this->_idEdicion, $idPersona);
		
		}
		
		
		public function desincorporarPersona($idPersona)
		{
			$edicionPersistencia = new edicionPersistencia();
			$edicionPersistencia->desincorporarPersona($this->_idEdicion, $idPersona);
		}
		
		public function buscarParticipante($idPersona)
		{
			$cantidadEstudiantes = count($this->_colEstudiantes);
			
			if($cantidadEstudiantes > 0)
			{	
				$retorna = NULL;
			
				foreach($this->_colEstudiantes as $estudiante)
				{					
					if($estudiante->dameId() == $idPersona)
					{
						$retorna = $estudiante;
					}
				}
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
			
		
		}

		public function bloquearEdicion($id_edicion){
			$edicionPersistencia = new edicionPersistencia();
			$datosAsociaciones = $edicionPersistencia->bloquearEdicion($id_edicion);

			return $datosAsociaciones;
		}

		public function desbloquearEdicion($id_edicion){
			$edicionPersistencia = new edicionPersistencia();
			$datosAsociaciones = $edicionPersistencia->desbloquearEdicion($id_edicion);

			return $datosAsociaciones;
		}

		public function historialEdiciones(){
			$edicionPersistencia = new edicionPersistencia();
			$ediciones = $edicionPersistencia->listadoEdiciones();

			 if(!empty($ediciones))
			 {

		 		foreach($ediciones as $edicion)
			 		{
						$edic[] = new edicion(
											$edicion['id_edicion'],
											$edicion['tipo'],
											$edicion['fecha_inicio'],
											$edicion['fecha_fin'],
											$edicion['duracion'],
											$edicion['limite'],
											$edicion['horario'],
											$edicion['sinoptico'],
											$edicion['estado'], 
											$edicion['e_nombre'],
											$edicion['e_descripcion']
										);
					$retorna = $edic;
					
					}
				
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}

	}
	
	
	
	