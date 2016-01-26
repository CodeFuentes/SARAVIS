<?php
session_start();
if(!isset($_SESSION['sesioniniciada'])) header("location:index.php");
include('fpdf/fpdf.php');
include("conexion.php");
	
$pdf = new FPDF();
$pdf->AddPage("L");
$pdf->SetFont("Helvetica","B",12);
$pdf->SetDrawColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$cat = mysql_query("select * from categoria;");
$c = mysql_fetch_assoc($cat);
if(!$c)
	$pdf->Cell(190,7,utf8_decode("Coño, no esperaron ni siquiera a implementar el proyecto y ya la cagaron?"),1,0,'C');
else do
{
$pdf->SetFont("Helvetica","B",12);
$pdf->Cell(0,7,$c['nombre'],0,1,'C',0);
$pre = mysql_query("select libro.*
 from libro 
 where activo='1' 
 and materia='$c[id_dewey]';") or die(mysql_error());
$p = mysql_fetch_assoc($pre);
$pdf->SetFont("Helvetica","",12);
if(!$p)
$pdf->Cell(0,7,utf8_decode("Sin libros"),0,1,'C');
else do
{	
	$pdf->Cell(0,7,utf8_decode("Cota:".$p['cota']),0,1,'L',0);
	$pdf->Cell(0,7,utf8_decode("Título:".$p['titulo']),0,1,'L',0);
	$pdf->Cell(0,7,utf8_decode("Autor:".$p['autor']),0,1,'L',0);
	$pdf->Cell(0,7,utf8_decode("Editorial:".$p['editorial']),0,1,'L',0);
	$pdf->Cell(0,7,utf8_decode("Año:".$p['ano']),0,1,'L',0);
	$pdf->Ln();
	$eje = mysql_query("select * from ejemplar where cota='$p[cota]';");
	$e = mysql_fetch_assoc($eje);
	$pdf->SetFillColor(84, 125, 255);
	$pdf->Cell(90,7,utf8_decode("Cota Particular"),1,0,'L',1);
	$pdf->Cell(90,7,utf8_decode("Estado"),1,1,'L',1);
	$pdf->SetFillColor(255, 255,255);
	if(!$e)
		$pdf->Cell(180,7,utf8_decode("No se poseen ejemplares de este libro"),1,1,'C',1);
	else do
	{
		$pre2 = mysql_query("select prestamo.*,
		lector.nombre, lector.apellido
		from prestamo inner join lector on prestamo.id_lector=lector.id
		where estado LIKE '%NO DEVUELTO%' 
		and id_ejemplar='$e[cota_particular]';") or die(mysql_error());
		$p2 = mysql_fetch_assoc($pre2);
		if(!$p2) $estado = "Disponible";
		else $estado = "Prestado";
		$pdf->Cell(90,7,utf8_decode($e['cota_particular']),1,0,'L',1);
		$pdf->Cell(90,7,utf8_decode($estado),1,0,'L',1);
	$pdf->Ln();	
	}while($e = mysql_fetch_assoc($eje));
	$pdf->Ln();	
}
while($p = mysql_fetch_assoc($pre));
$pdf->Ln();
}
while($c = mysql_fetch_assoc($cat));
$pdf->Output();
?>
