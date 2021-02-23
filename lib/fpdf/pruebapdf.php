<?php
require('FPDF/fpdf.php');

class PDF extends FPDF
	{
// Cabecera de página
	function Header()
	{

	    // Logo
	    $this->Image('images/logovv.jpg',10,8,33);
	    // Arial bold 15
	    $this->SetFont('Times','B',15);
	    // Movernos a la derecha
	    $this->Cell(60);
	    // Título
	    $this->Cell(130,15,'FORMATO DE VISA DE NO INMIGRANTE DS-160',0,0,'C');
	    //$this->SetFillColor(232,232,232);
	    // Salto de línea
	    $this->Ln(20);
	}

// Pie de página
	function Footer()
	{
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Times','I',12);
	    // Número de página
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}


?>