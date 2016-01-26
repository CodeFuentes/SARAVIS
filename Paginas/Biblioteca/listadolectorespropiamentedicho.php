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
$pdf->Cell(30,7,"ID Lector",1,0,'C',1);
$pdf->Cell(40,7,"Nombres",1,0,'C',1);
$pdf->Cell(40,7,utf8_decode("Apellidos"),1,0,'C',1);
$pdf->Cell(40,7,"Tipo de Lector",1,0,'C',1);
$pdf->Cell(30,7,utf8_decode("Ocupación"),1,0,'C',1);
$pdf->Cell(30,7,"Turno",1,0,'C',1);
$pdf->Cell(30,7,utf8_decode("Grado"),1,0,'C',1);
$pdf->Ln();

$pre = mysql_query("select * from lector where activo='1'");
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
			$pdf->Cell(30,7,utf8_decode($p['ocupacion']),1,0,'C',1);
			if($p['ocupacion']=='externo')
			{
				$pdf->Cell(20,7,"N/A",1,0,'C',1);
				$pdf->Cell(30,7,utf8_decode("N/A"),1,0,'C',1);
			}
			else
			{
				$pre2 = mysql_query("select * from informacion where id_lector='$p[id]'");
				$p2 = mysql_fetch_assoc($pre2);
				$pdf->Cell(30,7,"$p2[turno]",1,0,'C',1);
				$pdf->Cell(30,7,utf8_decode($p2['grado']),1,0,'C',1);
			}
			$pdf->Ln();
		}
		while($p = mysql_fetch_assoc($pre));
$pdf->Output();
?>
