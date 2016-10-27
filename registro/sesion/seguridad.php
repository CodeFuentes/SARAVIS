<?php
session_start(); 
//Inicio la sesión 

//COMPRUEBA QUE EL USUARIO ESTA AUTENTIFICADO 
if ($_SESSION["autentificado"] != "SI") { 
   	//si no existe, envio a la página de autentificacion 
   	header("Location: ../sesion/index.php"); 
   	//ademas salgo de este script 
   	exit(); 
}	
?>
