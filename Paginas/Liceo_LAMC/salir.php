<!-- de aqui no tocar nada-->
<?php
session_start();

include "verificar_usuario.php";


if (verificar_usuario()){
	//si el usuario es verificado, se elimina los valores,se destruye la sesion y volvemos al formulario de ingreso
	session_unset();
	session_destroy();
	header ('Location:index.php');
} else {
	//si el usuario no es verificado vuelve al formulario de ingreso
	header ('Location:index.php');
}
?>
