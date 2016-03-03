<?php  session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
	require_once("conexion.php");
	require_once("header.php");
	$r=0;
?>
		<div>
		<iframe width="900" height="400" src="historialdonacionespropiamentedicho.php?id=<?php echo $_REQUEST['id']; ?>"></iframe>
<?php require_once('footer.php'); ?>
