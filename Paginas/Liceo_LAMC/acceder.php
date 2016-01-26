<?php
include "verificar_usuario.php";
include "conexion.php";

//usuario y clave pasados por el formulario
$usuario = mysql_real_escape_string($_POST['usuario']);
$contrasena =mysql_real_escape_string($_POST['contrasena']);
//usa la funcion conexiones() que se ubica dentro de funciones.php
	//sentencia sql para consultar el nombre del usuario
	 $sql = "SELECT * FROM usuarios WHERE n_usuario='$usuario' AND contrasena='$contrasena'";
	//ejecucion de la sentencia anterior
	$ejecutar_sql=mysql_query($sql);
	$num=mysql_num_rows($ejecutar_sql);
	
	//si existe inicia una sesion y guarda el nombre del usuario
	
	
	if ($num){
		//inicio de sesion
		session_start();

		//configurar un elemento usuario dentro del arreglo global $_SESSION
		//deben colocar la ubicaion de el campo teniendo en cuenta que es un arreglo y que comienza por 0, 
		//en mi caso la ubicacion de mi name esta de segundo, segun el arreglo queda de primero

		$datos=mysql_fetch_array($ejecutar_sql);
		$_SESSION['usuario']=$datos['1'];
		$_SESSION['tipo']=$datos['5'];
		//retornar verdadero
	//si es valido accedemos a inicio

	header('Location:inicio_prueba.php');
	
	
	
} else {
?>
<script language="javascript">
alert("Datos Incorrectos");
location.href='index.php';
</script>
<?php
	//header('location:index.php');
}
	?>
