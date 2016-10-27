<?php

	final class baseDatosGestor
	{
		private $_servidor;
		private $_usuario;
		private $_clave;
		private $_baseDatos;
		
		private $_numFilas = NULL;
		private $_ultimoId = NULL;
		private $_filas = array();
		
		private $conexion;
		
		public function abrirConexion() 
		{			
			$this->_servidor = (string)BD_SERVIDOR;
			$this->_usuario = (string)BD_USUARIO;
			$this->_clave = (string)BD_CLAVE;
			$this->_baseDatos = (string)BD_NOMBRE;

			$this->conexion = new mysqli($this->_servidor, $this->_usuario, $this->_clave, $this->_baseDatos);
			
			if(mysqli_connect_error()) 
			{
				//errorAdministrador::errorQuery();
				exit("ERROR AL CONECTARSE");
			}
		}

		public function dameURL(){
			$url = "http://".$_SERVER['HTTP_HOST'].":".$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
			return $url;
		}
		
		public function cerrarConexion() 
		{
			$this->conexion->close();
		}
		
		public function insertarQuery($query) 
		{			
			if($this->conexion->query($query) === FALSE)
			{
				//errorAdministrador::errorQuery($query);
				echo $query . " ++ " . mysqli_error($this->conexion);
				exit();
			}
			
			$this->_ultimoId = $this->conexion->insert_id;
			
			return $this->_ultimoId;
		}
		
		public function resultadoQuery($query)
		{			
			$this->_filas = array();
			
			if($resultado = $this->conexion->query($query)) 
			{
				$this->_numFilas = $resultado->num_rows;
				
				while($this->_filas[] = $resultado->fetch_assoc());
				array_pop($this->_filas);
				
				$resultado->close();
				
				return $this->_filas;
			}
			else
			{
				//errorAdministrador::errorQuery($query);
				echo $query . " ++ " . mysqli_error($this->conexion);
				exit();
				
			}
		}
		
		public function ultimoId() 
		{
			return $this->_ultimoId;
		}
	}