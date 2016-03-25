<?php

require_once 'persistencias/cursoPersistencia.php';
require_once 'modelos/edicion.php';

	class curso
	{
		private $_idCurso;
		private $_nombre;
		private $_descripcion;
		private $_colEdiciones = array();
	
		public function __construct($idCurso, $nombre, $descripcion)
		{
			$this->_idCurso = $idCurso;
			$this->_nombre = $nombre;
			$this->_descripcion = $descripcion;
		}
		
		//
		//++
		//+++++
		//		METODOS GETTERS
		//+++++
		//++
		//
		
		public function dameId(){
			return $this->_idCurso;
		}
		
		public function dameNombre(){
			return $this->_nombre;
		}
		
		public function dameDescripcion(){
			return $this->_descripcion;
		}
		
		public function dameColEdiciones(){
			return $this->_colEdiciones;
		}
		
		//
		//++
		//+++++
		//		METODOS NORMALES
		//+++++
		//++
		//
		
		
		public function registrar()
		{
			$idCurso = $this->_verificarNombre();
		
			if(empty($idCurso))
			{
				$cursoPersistencia = new cursoPersistencia();
				$idGenerado = $cursoPersistencia->registrarCurso(
														$this->_nombre,
														$this->_descripcion
														);
				$this->_idCurso = $idGenerado;

				$retorna = 'exito';
			}
			else
			{
				$retorna = 'existeNombre';
			}
			
			return $retorna;
		}
		
		private function _verificarNombre()
		{
			$cursoPersistencia = new cursoPersistencia();
			$idCurso = $cursoPersistencia->verificarNombre($this->_nombre);
			return $idCurso;
		}
		
		static public function buscarCodigo($idEdicion, $idPersona)
		{
			$cursoPersistencia = new cursoPersistencia();
			$arrayDatosCursos = $cursoPersistencia->buscarCodigo($idEdicion, $idPersona);

			return $arrayDatosCursos;
		}
		
		
		static public function buscar($dato)
		{
			$cursoPersistencia = new cursoPersistencia();
			$arrayDatosCursos = $cursoPersistencia->buscarCurso($dato);
			
			
			if(!empty($arrayDatosCursos))
			{
				foreach($arrayDatosCursos as $curso)
				{
					$retorna[] = new curso(
										$curso['id_curso'],
										$curso['nombre'],
										$curso['descripcion']
									);
				}
				
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}
		
		
		static public function cargarCurso($idCurso)
		{
			$cursoPersistencia = new cursoPersistencia();
			$datosCurso = $cursoPersistencia->cargarCurso($idCurso);
	
			if(!empty($datosCurso))
			{
				$retorna = new curso(
										$datosCurso[0]['id_curso'],
										$datosCurso[0]['nombre'],
										$datosCurso[0]['descripcion']
									);
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}
		
		public function modificar()
		{
			$idCursoVerificada = $this->_verificarNombre();

			if(empty($idCursoVerificada) or $idCursoVerificada[0]['id_curso'] == $this->_idCurso)
			{
				$cursoPersistencia = new cursoPersistencia();
				$idGenerado = $cursoPersistencia->modificarCurso(
														$this->_idCurso,														
														$this->_nombre,
														$this->_descripcion
														);
				$retorna = 'exito';
			}
			else
			{
				$retorna = 'existeNombre';
			}
			
			return $retorna;
		}
	
		public function cargarColEdiciones()
		{
			$cursoPersistencia = new cursoPersistencia();

			$datosColEdiciones = $cursoPersistencia->cargarColEdiciones($this->_idCurso);
			
			if(!empty($datosColEdiciones))
			{
				foreach($datosColEdiciones as $datoEdicion)
				{

					$miEdicion = new edicion(
							$datoEdicion['id_edicion'], $datoEdicion['tipo'], $datoEdicion['fecha_inicio'],
							$datoEdicion['fecha_fin'], $datoEdicion['duracion'], $datoEdicion['limite'],
							$datoEdicion['horario'], $datoEdicion['sinoptico'], $datoEdicion['estado']
							);

					if(!empty($datoEdicion['p_id_persona']))
					{
						$persona = new persona(
										$datoEdicion['p_id_persona'], $datoEdicion['p_documento'], $datoEdicion['p_nombre'],
										$datoEdicion['p_apellido'], $datoEdicion['p_sexo'], $datoEdicion['p_fecha_nacimiento'],
										$datoEdicion['p_telefono'], $datoEdicion['p_direccion']
										);
										
						$miEdicion->ponerFacilitador($persona);
					}
					
					if(!empty($datoEdicion['c_id_certificado']))
					{
						$certificado = new certificado(
											$datoEdicion['c_id_certificado'], $datoEdicion['c_firma_facilitador'],
											$datoEdicion['c_firmas_extras'], $datoEdicion['c_fondo'], $datoEdicion['c_logo_extra']
											);
									
						$miEdicion->ponerCertificado($certificado);
					}
					
					if(!empty($datoEdicion['i_id_identificador']))
					{	
						$identificador = new identificador($datoEdicion['i_id_identificador'], $datoEdicion['i_fondo']);
						
						$miEdicion->ponerIdentificador($identificador);
					}

					$this->_colEdiciones[] = $miEdicion;
				}			
			}
			else
			{	
				$this->_colEdiciones = array();
			}
		}
		
		public function seleccionarEdicion($idEdicion)
		{
			$cursoPersistencia = new cursoPersistencia();
			$datosEdicion = $cursoPersistencia->dameEdicion($this->_idCurso, $idEdicion);
	
			if(!empty($datosEdicion))
			{
				$edicion = edicion::cargarEdicion($datosEdicion[0]['id_edicion']);
				
				$retorna = $edicion;
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}
 
		
	}
	
	
	
	