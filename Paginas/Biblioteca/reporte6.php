<?php 
	session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");

	ob_start();	
    require_once('historiadonante.php');
    $content = ob_get_clean();
    // convert to PDF
    require_once('html2pdf/html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 3);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        $html2pdf->Output('genteconprestamos.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

?>