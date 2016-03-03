<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
require_once('header.php'); ?>
		<center><b>Bienvenido(a) <?php echo $_SESSION['nombre']; ?></b></center>
		<center>
		<img src="img/Temporales_(1).jpg" class="relleno3"/>
		<img src="img/Temporales_(2).jpg" class="relleno3"/>
		<img src="img/Temporales_(3).jpg" class="relleno3"/>
		<img src="img/Temporales_(4).jpg" class="relleno3"/>
		<img src="img/Temporales_(5).jpg" class="relleno3"/>
		<img src="img/Temporales_(6).jpg" class="relleno3"/>
		</center>
<?php require_once('footer.php'); ?>
