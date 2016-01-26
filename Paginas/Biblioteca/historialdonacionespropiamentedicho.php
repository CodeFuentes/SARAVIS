<?php
session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
include('fpdf/fpdf.php');
include("conexion.php");
	
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Helvetica","B",12);
$pdf->SetFillColor(84, 125, 255);
$pdf->SetDrawColor(255,255,255);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(100,7,"Libro",1,0,'C',1);
$pdf->Cell(40,7,"ID Ejemplar",1,0,'C',1);
$pdf->Cell(40,7,utf8_decode("Fecha Solicitud"),1,0,'C',1);
$pdf->Ln();

$pre = mysql_query("select ejemplar.*,libro.titulo as nombre from ejemplar 
	inner join libro on ejemplar.cota=libro.cota
	 where id_donante='$_REQUEST[id]'
	 and libro.activo='1' order by fecha_donado desc;") or die(mysql_error());
		$p = mysql_fetch_assoc($pre);
$pdf->SetFont("Helvetica","",11);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(93, 148, 245);
		if(!$p)
			$pdf->Cell(180,7,utf8_decode("Sin préstamos"),1,0,'C');
		else do
		{	
			$pdf->Cell(100,7,utf8_decode($p['nombre']),1,0,'C',1);
			$pdf->Cell(40,7,utf8_decode($p['id']),1,0,'C',1);
			$pdf->Cell(40,7,utf8_decode($p['fecha_donado']),1,0,'C',1);
			$pdf->Ln();
		}
		while($p = mysql_fetch_assoc($pre));
$pdf->Output();
?>
