<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	//$registro=$_GET["reg"];
	//$registro=35;

	
	
	
    $pdf = new PDF();
    

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
//datos devueltos

	//$row = $resultado->fetch_assoc()
//
	$pdf->Cell(60);
	$pdf->Cell(40,6,'Disponibilidad Laboratorios');
	$pdf->Ln(10);
///
	
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(10);
	//$pdf->Cell(10);
	$pdf->Cell(40,6,'Laboratorios');
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',10);
//$pdf->Cell(10);
///query 2
	$query2 = "Select L.nombre, TL.nombre as tipo,L.capacidad , L.disponibilidad , L.ubicacion from laboratorio L,tipolaboratorio TL where TL.id = L.tipo";
	$resultado2 = $mysqli->query($query2);
	$pdf->Cell(40,6,'Nombre',0,0,'C',1);	
	$pdf->Cell(40,6,'Tipo Laboratorio',0,0,'C',1);	
	$pdf->Cell(25,6,'Capacidad',0,0,'C',1);
	$pdf->Cell(40,6,'Disponibilidad',0,0,'C',1);
	$pdf->Cell(40,6,'Ubicacion',0,0,'C',1);
$pdf->Ln(10);

$pdf->SetFont('Arial','',10);
while($row = $resultado2->fetch_assoc())
	{
		
		$pdf->Cell(40,6,$row['nombre'],1,0,'C');
		$pdf->Cell(40,6,$row['tipo'],1,0,'C');
		$pdf->Cell(25,6,$row['capacidad'],1,0,'C');
		$pdf->Cell(40,6,$row['disponibilidad'],1,0,'C');	
		$pdf->Cell(40,6,$row['ubicacion'],1,0,'C');
$pdf->Ln(7);
	}
	$pdf->Output();
?>