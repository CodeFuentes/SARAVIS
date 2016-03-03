<?php
	$servidor="localhost";
	$usuario="root";
	$clave="";
	$base="relacion_prueba";
	$conexion=mysql_connect($servidor,$usuario,$clave);
	mysql_select_db($base) or die ("Problemas al conectar a la base de datos");
?>