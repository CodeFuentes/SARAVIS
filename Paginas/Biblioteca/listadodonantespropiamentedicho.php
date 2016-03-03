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
$pdf->Cell(30,7,"ID Donante",1,0,'C',1);
$pdf->Cell(40,7,"Nombres",1,0,'C',1);
$pdf->Cell(40,7,utf8_decode("Apellidos"),1,0,'C',1);
$pdf->Cell(40,7,"Tipo de Donante",1,0,'C',1);
$pdf->Cell(30,7,utf8_decode("RIF"),1,0,'C',1);
$pdf->Cell(30,7,utf8_decode("Teléfono"),1,0,'C',1);
$pdf->Cell(30,7,utf8_decode("Cédula"),1,0,'C',1);
$pdf->Ln();

$pre = mysql_query("select * from donante where activo='1'");
		$p = mysql_fetch_assoc($pre);
$pdf->SetFont("Helvetica","",11);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetTextColor(93, 148, 245);
		if(!$p)
			$pdf->Cell(150,7,"Sin lectores");
		else do
		{	
			$pdf->Cell(30,7,utf8_decode($p['id']),1,0,'C',1);
			$pdf->Cell(40,7,utf8_decode($p['nombre']),1,0,'C',1);
			$pdf->Cell(40,7,utf8_decode($p['apellido']),1,0,'C',1);
			$pdf->Cell(40,7,utf8_decode($p['tipo']),1,0,'C',1);
			$pdf->Cell(30,7,utf8_decode($p['rif']),1,0,'C',1);
			$pdf->Cell(30,7,"$p[telefono]",1,0,'C',1);
			$pdf->Cell(30,7,utf8_decode($p['cedula']),1,0,'C',1);
			$pdf->Ln();
		}
		while($p = mysql_fetch_assoc($pre));
$pdf->Output();
?>
