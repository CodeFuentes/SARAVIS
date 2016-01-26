<?php
session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
include('fpdf/fpdf.php');
include("conexion.php");
	
$pdf = new FPDF();
$pdf->AddPage("L");
$pdf->SetFont("Helvetica","B",12);
$pdf->SetFillColor(84, 125, 255);
$pdf->SetDrawColor(255,255,255);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(70,7,"Libro",1,0,'C',1);
$pdf->Cell(40,7,"ID Ejemplar",1,0,'C',1);
$pdf->Cell(40,7,utf8_decode("Fecha Solicitud"),1,0,'C',1);
$pdf->Cell(40,7,utf8_decode("Fecha Devolución"),1,0,'C',1);
$pdf->Cell(80,7,"Estado",1,0,'C',1);
$pdf->Ln();

$pre = mysql_query("select prestamo.*,libro.titulo as nombre from prestamo 
	inner join ejemplar on ejemplar.id=prestamo.id_ejemplar
	inner join libro on ejemplar.cota=libro.cota
	 where id_lector='$_REQUEST[id]'
	 and libro.activo='1' order by fecha_c desc;");
		$p = mysql_fetch_assoc($pre);
$pdf->SetFont("Helvetica","",11);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(93, 148, 245);
		if(!$p)
			$pdf->Cell(190,7,utf8_decode("Sin préstamos"),1,0,'C');
		else do
		{	
			$pdf->Cell(70,7,utf8_decode($p['nombre']),1,0,'C',1);
			$pdf->Cell(40,7,utf8_decode($p['id_ejemplar']),1,0,'C',1);
			$pdf->Cell(40,7,utf8_decode($p['fecha_c']),1,0,'C',1);
			$pdf->Cell(40,7,utf8_decode($p['fecha_r']),1,0,'C',1);
			$pdf->Cell(80,7,utf8_decode($p['estado']),1,0,'C',1);
			$pdf->Ln();
		}
		while($p = mysql_fetch_assoc($pre));
$pdf->Output();
?>
