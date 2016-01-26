<?php
	/* Este archivo nos permite conectarnos a la base de datos 
	debemos estar atentos a colocar los campos de forma correcta */
	$servidor="localhost";
	$usuario="root";
	$clave="";
	$base="sesion";
	$conexion=mysql_connect($servidor,$usuario,$clave);
	mysql_select_db($base) or die ("Problemas al conectar a la base de datos");
?>