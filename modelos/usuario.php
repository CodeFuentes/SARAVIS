<?php

require_once 'persistencias/usuarioPersistencia.php';

	class usuario
	{
		private $_idUsuario;
		private $_nombre;
		private $_usuario;
		private $_clave;
		private $_permisos;
		private $_estado;
	
		public function __construct($idUsuario, $nombre, $usuario, $clave, $permisos, $estado)
		{
			$this->_idUsuario = $idUsuario;
			$this->_nombre = $nombre;
			$this->_usuario = $usuario;
			$this->_clave = $clave;
			$this->_permisos = $permisos;
			$this->_estado = $estado;
		}

		//
		//++
		//+++++
		//		METODOS GETTERS
		//+++++
		//++
		//
		
		public function dameId(){
			return $this->_idUsuario;
		}
		
		public function dameNombre(){
			return $this->_nombre;
		}
		
		public function dameUsuario(){
			return $this->_usuario;
		}
		
		public function dameClave(){
			return $this->_clave;
		}
		
		public function damePermisos(){
			return $this->_permisos;
		}
		
		public function damePermisosMostrar(){
			
			$misPermisos = explode(',', $this->_permisos);
			
			$permisosMostrar = '';
			
			foreach($misPermisos as $valor) {
				if($valor == 'cursos') {
					$permisosMostrar .= 'Curso/Taller/Facilitador,';
				} elseif($valor == 'personas') {
					$permisosMostrar .= 'Persona/Participante,';
				} elseif($valor == 'documentos') {
					$permisosMostrar .= 'Documentos,';
				} elseif($valor == 'impresiones') {
					$permisosMostrar .= 'Impresiones,';
				}
			}

			$permisosMostrar = preg_replace('/\,/', ' - ', $permisosMostrar);
			$permisosMostrar = substr($permisosMostrar, 0, (strlen($permisosMostrar) - 2));
			
			return $permisosMostrar;
		}

		public function dameEstado(){
			return $this->_estado;
		}
	
		//
		//++
		//+++++
		//		METODOS NORMALES
		//+++++
		//++
		//
		
		public function guardarEstado()
		{
			if($this->dameEstado() == 'activo' OR $this->dameEstado() == 'restablecer')
			{				
				$nuevoEstado = 'bloqueado';
			}
			else
			{
				$nuevoEstado = 'activo';
			}
			
			$usuarioPersistencia = new usuarioPersistencia();
			$datosUsuario = $usuarioPersistencia->cambiarEstado($this->dameId(), $nuevoEstado);
		}
		
		public function guardarRestablecer()
		{
			$usuarioPersistencia = new usuarioPersistencia();
			$datosUsuario = $usuarioPersistencia->restablecerClave($this->dameId());
		}
		
		public function cambiarClave($nuevaClave)
		{
			$usuarioPersistencia = new usuarioPersistencia();
			$datosUsuario = $usuarioPersistencia->cambiarClave($this->dameId(), $nuevaClave);
		}
		
		static public function cargarUsuario($idUsuario)
		{
			$usuarioPersistencia = new usuarioPersistencia();
			$datosUsuario = $usuarioPersistencia->cargarUsuario($idUsuario);
			
			if(!empty($datosUsuario))
			{
				$retorna = new usuario(
										$datosUsuario[0]['id_usuario'],
										$datosUsuario[0]['nombre_completo'],
										$datosUsuario[0]['usuario'],
										$datosUsuario[0]['clave'],
										$datosUsuario[0]['permisos'],
										$datosUsuario[0]['estado']
									);
			}
			else
			{
				$retorna = NULL;
			}
			
			return $retorna;
		}
		
		public function dameColUsuarios()
		{
			$usuarioPersistencia = new usuarioPersistencia();
			$datosColUsuarios = $usuarioPersistencia->traerColUsuarios();

			if(!empty($datosColUsuarios))
			{
				foreach($datosColUsuarios as $datosUsuario)
				{
					$usuario = new usuario(
											$datosUsuario['id_usuario'],
											$datosUsuario['nombre_completo'],
											$datosUsuario['usuario'],
											$datosUsuario['clave'],
											$datosUsuario['permisos'],
											$datosUsuario['estado']
										);

					$colUsuarios[] = $usuario;
				}
			}
			else
			{
				$colUsuarios = array();
			}
			
			return $colUsuarios;
		}
		

		public function registrar()
		{
			$idUsuarioVerificado = $this->_verificarUsuaruio();

			if(empty($idUsuarioVerificado))
			{
				$usuarioPersistencia = new usuarioPersistencia();
				$idGenerado = $usuarioPersistencia->registrarUsuario(
														$this->_nombre,
														$this->_usuario,
														$this->_clave,
														$this->_permisos,
														$this->_estado
														);
				$retorna = 'exito';
			}
			else
			{
				$retorna = 'existeUsuario';
			}
			
			return $retorna;
		}

		public function modificar()
		{

			$usuarioPersistencia = new usuarioPersistencia();
			 $usuarioPersistencia->modificarUsuario(
										$this->_idUsuario,
										$this->_nombre,
										$this->_permisos
										);
		}

		private function _verificarUsuaruio()
		{
			$usuarioPersistencia = new usuarioPersistencia();
			$idUsuario = $usuarioPersistencia->verificarUsuario($this->_usuario);
			return $idUsuario;
		}
		
	}
	
	
	
	