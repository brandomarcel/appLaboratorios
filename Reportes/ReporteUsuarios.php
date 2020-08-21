<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	
	
	$query = "SELECT * FROM usuarios ORDER BY tipo";
	$resultado = $mysqli->query($query);
	
    $pdf = new PDF();
    
  

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(60,6,'Cedula',1,0,'C',1);
	$pdf->Cell(40,6,'Nombre',1,0,'C',1);
	$pdf->Cell(40,6,'Apellido',1,0,'C',1);
	$pdf->Cell(40,6,'Tipo',1,1,'C',1);
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(60,6,utf8_decode($row['id']),1,0,'C');
		$pdf->Cell(40,6,$row['nombre'],1,0,'C');
		$pdf->Cell(40,6,$row['apellido'],1,0,'C');
		$pdf->Cell(40,6,utf8_decode($row['tipo']),1,1,'C');
	}
	$pdf->Output();
?>