<?php

require_once 'persistencias/personaPersistencia.php';

	class persona
	{
		private $_idPersona;
		private $_documento;
		private $_nombre;
		private $_apellido;
		private $_sexo;
		private $_fechaNacimiento;
		private $_telefono;
		private $_direccion;
		private $_correo;
	
		public function __construct($idPersona, $documento, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $direccion)
		{
			$this->_idPersona = $idPersona;
			$this->_documento = $documento;
			$this->_nombre = $nombre;
			$this->_apellido = $apellido;
			$this->_sexo = $sexo;
			$this->_fechaNacimiento = $fechaNacimiento;
			$this->_telefono = $telefono;
			$this->_direccion = $direccion;
			$this->_correo = $correo;
		}
		
		//
		//++
		//+++++
		//		METODOS GETTERS
		//+++++
		//++
		//
		
		public function dameId(){
			return $this->_idPersona;
		}
		
		public function dameDocumento()	{
			return $this->_documento;
		}
		
		public function dameNombre(){
			return $this->_nombre;
		}
		
		public function dameApellido(){
			return $this->_apellido;
		}
		
		public function dameSexo(){
			return $this->_sexo;
		}
		
		public function dameFechaNacimiento(){
			return $this->_fechaNacimiento;
		}

		public function dameTelefono(){
			return $this->_telefono;
		}
		
		public function dameDireccion(){
			return $this->_direccion;
		}

		public function dameCorreo(){
			return $this->_correo;
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
			$idPersonaVerificada = $this->_verificarDocumento();
		
			if(empty($idPersonaVerificada))
			{
				$personaPersistencia = new personaPersistencia();
				$idGenerado = $personaPersistencia->registrarPersona(
														$this->_documento,
														$this->_nombre,
														$this->_apellido,
														$this->_sexo,
														$this->_fechaNacimiento,
														$this->_telefono,
														$this->_direccion,
														$this->_correo
														);
				$this->_idPersona = $idGenerado;

				$retorna = 'exito';
			}
			else
			{
				$retorna = 'existeDocumento';
			}
			
			return $retorna;
		}
		
		public function modificar()
		{
			$idPersonaVerificada = $this->_verificarDocumento();

			if(empty($idPersonaVerificada) or $idPersonaVerificada[0]['id_persona'] == $this->_idPersona)
			{
				$personaPersistencia = new personaPersistencia();
				$idGenerado = $personaPersistencia->modificarPersona(
														$this->_idPersona,
														$this->_documento,
														$this->_nombre,
														$this->_apellido,
														$this->_sexo,
														$this->_fechaNacimiento,
														$this->_telefono,
														$this->_direccion,
														$this->_correo
														);
				$retorna = 'exito';
			}
			else
			{
				$retorna = 'existeDocumento';
			}
			
			return $retorna;
		}
		
		static public function buscar($documento)
		{
			$personaPersistencia = new personaPersistencia();
			$datosPersona = $personaPersistencia->buscarPersona($documento);
			
			if(!empty($datosPersona))
			{
				$retorna = new persona(
										$datosPersona[0]['id_persona'],
										$datosPersona[0]['documento'],
										$datosPersona[0]['nombre'],
										$datosPersona[0]['apellido'],
										$datosPersona[0]['sexo'],
										$datosPersona[0]['fecha_nacimiento'],
										$datosPersona[0]['telefono'],
										$datosPersona[0]['direccion'],
										$datosPersona[0]['correo']
									);
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}
		
		private function _verificarDocumento()
		{
			$personaPersistencia = new personaPersistencia();
			$idPersona = $personaPersistencia->verificarDocumento($this->_documento);
			return $idPersona;
		}
		
		static public function cargarPersona($idPersona)
		{
			$personaPersistencia = new personaPersistencia();
			$datosPersona = $personaPersistencia->cargarPersona($idPersona);
			
			if(!empty($datosPersona))
			{
				$retorna = new persona(
										$datosPersona[0]['id_persona'],
										$datosPersona[0]['documento'],
										$datosPersona[0]['nombre'],
										$datosPersona[0]['apellido'],
										$datosPersona[0]['sexo'],
										$datosPersona[0]['fecha_nacimiento'],
										$datosPersona[0]['telefono'],
										$datosPersona[0]['direccion'],
										$datosPersona[0]['correo']
									);
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}
		
	}
	
	
	
	