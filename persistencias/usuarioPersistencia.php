<?php

require_once 'nucleo/bdGestor.php';

	final class usuarioPersistencia
	{
		public function cargarUsuario($id)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM usuarios WHERE id_usuario = '$id'";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
			
			return $retorna;
		}

		public function traerColUsuarios()
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM usuarios WHERE permisos != 'admin' ORDER BY estado, nombre_completo ASC ";
			
			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
					
			return $retorna;
		}

		public function verificarUsuario($usuario)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "SELECT * FROM usuarios WHERE usuario = '$usuario'";

			$retorna = $GBD->resultadoQuery($query);
			$GBD->cerrarConexion();
		
			return $retorna;
		}

		public function registrarUsuario($nombre, $usuario, $clave, $permisos, $estado)
		{
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "INSERT INTO usuarios 
					(nombre_completo, usuario, clave, permisos, estado) 
					VALUES 
					('$nombre', '$usuario', '$clave', '$permisos', '$estado')";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		

		public function modificarUsuario($idUsuario, $nombre, $permisos)
		{		
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "UPDATE usuarios SET nombre_completo = '$nombre', permisos = '$permisos' WHERE id_usuario = '$idUsuario'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
		public function cambiarEstado($idUsuario, $estado)
		{		
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "UPDATE usuarios SET estado = '$estado' WHERE id_usuario = '$idUsuario'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
		public function cambiarClave($idUsuario, $nuevaClave)
		{		
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "UPDATE usuarios SET clave = '$nuevaClave', estado = 'activo' WHERE id_usuario = '$idUsuario'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
		
		public function restablecerClave($idUsuario)
		{		
			$GBD = new baseDatosGestor();				
			$GBD->abrirConexion();
			
			$query = "UPDATE usuarios SET clave = '123456', estado = 'restablecer' WHERE id_usuario = '$idUsuario'";
			
			$idGenerado = $GBD->insertarQuery($query);
			$GBD->cerrarConexion();
			
			return $idGenerado;
		}
	}
