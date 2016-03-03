<?php
function verificar_usuario(){
	session_start();
	//comprobar la existencia del usuario
	//cambialo segun tu nombre de usuario en la bd
	if ($_SESSION['usuario'])
	{
		return true;
	}
	}
?>
