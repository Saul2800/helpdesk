<?php
	include 'pruebapdf.php';
	require 'conexionbd.php';
	
	//$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
	$query = "SELECT id, name, email FROM login ";
	$resultado = $mysqli->query($query);
	
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	
	$pdf->SetFillColor(232,232,232);
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(70,6,'ID',1,0,'C',1);
	$pdf->Cell(20,6,'NAME',1,0,'C',1);
	$pdf->Cell(70,6,'EMAIL',1,1,'C',1);
	//$pdf->Cell(70,6,'password',1,1,'C',1);
	$pdf->SetFont('Arial','',10);
	
	while($row = $resultado->fetch_assoc())
	{
		$pdf->Cell(70,6,utf8_decode($row['id']),1,0,'C');
		$pdf->Cell(20,6,$row['name'],1,0,'C');
		$pdf->Cell(70,6,utf8_decode($row['email']),1,1,'C');
		//$pdf->Cell(70,6,utf8_decode($row['password']),1,1,'C');
	}
	$pdf->Output();

?>