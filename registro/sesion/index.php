<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<head> 
<title>Autentificación PHP</title> 
</head> 
<body> 
<h2><center>INGRESE SUS DATOS</center></h2><br> 
<!-- Creamos un formulario con el metodo POST que envia los campos al archivo control -->
<form action="control.php" method="POST"> 
<table align="center" width="225" cellspacing="2" cellpadding="2" border="0"> 
<tr> 
	<td colspan="2" align="center" 

<?php 
/* Este codigo verifica si los datos de usuario introducidos son correctos */
if ($_GET["errorusuario"]=="si"){ ?> 
bgcolor=red><span style="color:ffffff"><b>Datos incorrectos</b></span> 
<?php }else{ ?> 
bgcolor=#cccccc> Introduce tus Datos de Acceso  
<?php } ?></td> 
</tr> 
<tr> 
	<td align="right">USUARIO:</td> 
	<td><input type="Text" name="usuario" size="10" maxlength="50"></td> 
</tr> 
<tr> 
	<td align="right">CONTRASEÑA:</td> 
	<td><input type="password" name="contrasena" size="10" maxlength="50"></td> 
</tr> 
<tr> 
	<td colspan="2" align="center"><input type="Submit" value="ENTRAR"></td>
</tr> 
</table> 
</form> 
</body> 
</html>