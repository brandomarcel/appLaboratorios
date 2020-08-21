<?php
	include 'plantilla.php';
	require 'conexion.php';
	
	$query = "SELECT
    ve.Id,
    ve.Fecha,
    au.Placa,
    cli.Cedula,
    cli.Nombre,
    cli.Apellido,
    cli.Direccion,
    cli.Telefono,
    dis.Descripcion,
    maq.Descripcion as DesMaquina,
    isl.Descripcion as DesIsla,
    usr.Cedula as CedUsr,
    CONCAT(usr.Nombre,' ' ,usr.Apellido) as NomUsr,
    com.Nombre as NombreCom,
    com.Precio ,
    ve.Cantidad,
    ve.Total
FROM
    ventas ve,
    Autos au,
    Clientes cli,
    dispensador dis,
    combustibles com,
    maquias maq,
    islas isl,
    usuarios usr
WHERE
    ve.ID_Placa=au.Id
    AND au.Id_cliente=cli.Id
    AND ve.ID_Dispensador=dis.Id
    AND dis.Id_Combustible=com.Id
    AND dis.Id_Maquina=maq.Id
    AND maq.Id_Isla=isl.Id
    AND isl.Id_Usuario=usr.Id
    AND ve.Id=".$_GET['id'];
	$resultado = $mysqli->query($query);
	
    $pdf = new PDF();
    
  

	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	//$pdf->Cell(100,6,'Nombre',1,0,'C',1);
	//$pdf->Cell(40,6,'Precio',1,1,'C',1);
	
	
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
       // $pdf->Text(10, 10, 'string txt');
		$pdf->Cell(70,6,'Factura',1,0,'C');
        $pdf->Cell(70,6,$row['Id'],1,1,'C');

        $pdf->Cell(70,6,'Fecha',1,0,'C');
        $pdf->Cell(70,6,$row['Fecha'].'',1,1,'C');

        $pdf->SetFillColor(232,232,232);
        $pdf->Cell(140,6,'Datos del Cliente',1,1,'C');

        $pdf->Cell(70,6,'Cedula',1,0,'C');
        $pdf->Cell(70,6,$row['Cedula'],1,1,'C');
        $pdf->Cell(70,6,'Nombre',1,0,'C');
        $pdf->Cell(70,6,$row['Nombre'].' '.$row['Apellido'],1,1,'C');
        
        $pdf->Cell(35,6,'Telefono',1,0,'C');
        $pdf->Cell(35,6,$row['Telefono'],1,0,'C');
        $pdf->Cell(35,6,'Direccion',1,0,'C');
        $pdf->Cell(35,6,$row['Direccion'],1,1,'C');
        $pdf->Cell(35,6,'Placa',1,0,'C');
        $pdf->Cell(105,6,$row['Placa'],1,1,'C');
        
        $pdf->SetFillColor(232,232,232);
        $pdf->Cell(140,6,'Datos del Combustible',1,1,'C');


        $pdf->Cell(35,6,'Combustible',1,0,'C');
        $pdf->Cell(35,6,'P/GL',1,0,'C');
        $pdf->Cell(35,6,'Cantidad',1,0,'C');
        $pdf->Cell(35,6,'Total',1,1,'C');

        $pdf->Cell(35,6,$row['NombreCom'],1,0,'C');
        $pdf->Cell(35,6,$row['Precio'].' $',1,0,'C');
        $pdf->Cell(35,6,$row['Cantidad'].' GL',1,0,'C');
        $pdf->Cell(35,6,$row['Total'].' $',1,1,'C');

        $pdf->SetFillColor(232,232,232);
        $pdf->Cell(140,6,'Datos de la Venta',1,1,'C');

        $pdf->Cell(35,6,'Usuario',1,0,'C');
        $pdf->Cell(35,6,'Isla',1,0,'C');
        $pdf->Cell(35,6,'Maquina',1,0,'C');
        $pdf->Cell(35,6,'Dispensador',1,1,'C');

        $pdf->Cell(35,6,$row['CedUsr'],1,0,'C');
        $pdf->Cell(35,6,$row['DesIsla'],1,0,'C');
        $pdf->Cell(35,6,$row['DesMaquina'],1,0,'C');
        $pdf->Cell(35,6,$row['Descripcion'],1,1,'C');


	}
	$pdf->Output();
?>