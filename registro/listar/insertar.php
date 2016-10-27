<?php include ("../sesion/seguridad.php");?> 
<!-- Este archivo contiene el formulario para ingresar datos a la tabla clientes
Se incluye el archivo seguridad.php, el cual verifica si existe alguna sesion iniciada -->
<HTML>
<HEAD>
<TITLE>Insertar.php</TITLE>
</HEAD>
<BODY>
<div align="center">
<h1>Insertar un Registro</h1>
<br>
<!-- El formulario nos envia al archivo insertar1.php-->
<form action="insertar1.php" method="post">

Nombre<br>
<INPUT TYPE="TEXT" NAME="nombre"><br>

Teléfono<br>
<INPUT TYPE="TEXT" NAME="telefono"><br>

<INPUT TYPE="SUBMIT" value="Insertar">
</FORM>
</div>
<br> 
<br> 
<a href="../sesion/salir.php">Salir</a> 
</BODY>
</HTML> 
