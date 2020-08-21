<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	//$registro=$_GET["reg"];
	$registro=$_GET["reg"];

	
	$query = "Select R.fechaRegistro, R.horaInicio,R.horaFin,R.Tema,CONCAT(CONCAT(U.NOMBRE,' '),U.APELLIDO) as Laboratorista,CONCAT(CONCAT(US.NOMBRE,' '),US.APELLIDO) as Solicitante,M.Nombre AS Materia,L.nombre as Laboratorio from registro R,usuario U,usuarios US,materia M,laboratorio L where  R.idLaboratorista=U.id and R.idUsuarios = US.id and R.idMateria = M.id and R.idLaboratorio = L.id and R.id=".$registro;
	$resultado = $mysqli->query($query);
	
    $pdf = new PDF();
    

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
//datos devueltos

	//$row = $resultado->fetch_assoc()
//
	$pdf->Cell(80);
	$pdf->Cell(40,6,'Detalle de Registro');
	$pdf->Ln(10);
///
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(10);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(40,6,'Fecha:',0,0,'C',1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,$row['fechaRegistro'],0,0,'C',0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(40,6,'Laboratorista:',0,0,'C',1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,$row['Laboratorista'],0,0,'C',0);
		$pdf->Ln(7);$pdf->Cell(10);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(40,6,'Hora de Inicio:',0,0,'C',1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,$row['horaInicio'],0,0,'C',0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(40,6,'Hora de Salida:',0,0,'C',1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,$row['horaFin'],0,0,'C',0);
		$pdf->Ln(7);$pdf->Cell(10);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(40,6,'Solicitante:',0,0,'C',1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,$row['Solicitante'],0,0,'C',0);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(40,6,'Materia:',0,0,'C',1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,$row['Materia'],0,0,'C',0);
		$pdf->Ln(7);$pdf->Cell(10);
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(40,6,'Laboratorio:',0,0,'C',1);
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(40,6,$row['Laboratorio'],0,0,'C',0);
		//$pdf->Cell(60,6,utf8_decode($row['horaInicio']),0,0,'C');
		//$pdf->Cell(40,6,$row['nombre'],0,0,'C');
		//$pdf->Cell(40,6,$row['apellido'],0,0,'C');
		//$pdf->Cell(40,6,utf8_decode($row['tipo']),0,1,'C');
	}
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(10);
	$pdf->Cell(10);
	$pdf->Cell(40,6,'Detalle de Maquinas');
	$pdf->Ln(10);
	$pdf->SetFont('Arial','B',10);
$pdf->Cell(10);
///query 2
	$query2 = "Select D.nombrePC,D.idEstudiante as Ocupante,D.observacion from detalleregistro D,usuarios U where D.idRegistro = $registro  GROUP by D.idEstudiante";
	$resultado2 = $mysqli->query($query2);
	$pdf->Cell(40,6,'Maquina',0,0,'C',1);	
	$pdf->Cell(40,6,'Ocupante',0,0,'C',1);
	$pdf->Cell(80,6,'Observacion',0,0,'C',1);
$pdf->Ln(10);

$pdf->SetFont('Arial','',10);
while($row = $resultado2->fetch_assoc())
	{
		$pdf->Cell(10);
		$pdf->Cell(40,6,$row['nombrePC'],1,0,'C');
		$pdf->Cell(40,6,$row['Ocupante'],1,0,'C');
		$pdf->Cell(80,6,$row['observacion'],1,0,'C');
$pdf->Ln(7);
	}
	$pdf->Output();
?>