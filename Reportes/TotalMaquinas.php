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
	$pdf->Cell(40,6,'Numero de Maquinas por Laboratorio');
	$pdf->Ln(10);
///
	
	
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(10);
	$pdf->Cell(10);
	$pdf->Cell(40,6,'Numero de Equipos');
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',10);
//$pdf->Cell(10);
///query 2
	$query2 = "Select L.nombre ,count(DL.idLaboratorio) as NumeroEquipos from detallelaboratorio DL, laboratorio L where L.id = DL.idLaboratorio GROUP by idLaboratorio";
	$resultado2 = $mysqli->query($query2);
$pdf->Cell(10);
	$pdf->Cell(40,6,'Nombre Laboratorio',0,0,'C',1);	
	$pdf->Cell(40,6,'Numero de Equipos',0,0,'C',1);	
$pdf->Ln(10);

$pdf->SetFont('Arial','',10);
while($row = $resultado2->fetch_assoc())
	{
		$pdf->Cell(10);
		$pdf->Cell(40,6,$row['nombre'],1,0,'C');
		$pdf->Cell(40,6,$row['NumeroEquipos'],1,0,'C');

$pdf->Ln(7);
	}
	$pdf->Output();
?>