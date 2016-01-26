<!--solo cambiar el $nombre y el $_SESSION[];-->
	<?php
		include "verificar_usuario.php";
		//uso de la funcion verificar_usuario()
		if (verificar_usuario()){
			//si el usuario es verificado puede acceder al contenido permitido a el

		} else {
			//si el usuario no es verificado volvera al formulario de ingreso
		?>
		<script language="javascript">
		alert("Debe Iniciar Sesion");
		location.href='index.php';
		</script>
		 <?php
		}
		$nombre=$_SESSION['usuario']; 
		?>