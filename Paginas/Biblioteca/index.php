<?php  session_start();
if(isset($_SESSION['sesioniniciada'])) header("location:home.php");
require_once('header.php'); ?>
		<img src="img/fotocolegio.jpg" class="relleno"/>
		<div class="contenido"><b>Visi&oacute;n</b>
<p>La Unidad Educativa Privada &quot;Libertador y General&iacute;simo Bol&iacute;var&quot; es una instituci&oacute;n educativa que desarrolla una educaci&oacute;n de calidad que atienda a la diversidad, proporcionando un servicio educativo de formaci&oacute;n integral al m&aacute;s alto nivel a estudiantes desde primaria hasta media, bajo una perspectiva cient&iacute;fica, Humanista, Bolivariana, Robinsoniana, Zamorana y Bandurana, centrada en valores para materializar la conciencia republicana, solidaria y que involucre a las familias y al entorno en el proceso educativo.</p>
<b>Misi&oacute;n</b>
<p>La Unidad Educativa dirige su misi&oacute;n en la formaci&oacute;n de individuos responsables, creativos, participativos y competitivos. Se esfuerza en la formaci&oacute;n del saber cr&iacute;tico de sus estudiantes, en la formaci&oacute;n de valores esenciales tales como la honestidad, la lealtad, la responsabilidad, el amor y el respeto a s&iacute; mismo y hacia los dem&aacute;s, la valoraci&oacute;n de la vida y su ambiente, todo ello sobre la base de la disciplina entendida como factor generador interno de motivaci&oacute;n y alegr&iacute;a, y como camino a la libertad responsable.</p>
		</div>
<?php require_once('footer.php'); ?>
