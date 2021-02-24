<?php
//require('fpdf/fpdf.php'); Para Usar la librería
require('fpdf/WriteHTML.php'); //Para usar el writeHTML

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('images/logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(30,10,'Reporte de tickets',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Observaciones
    $this->Cell(0,10,'Observaciones: ',0,0);
    // Número de página
    $this->Cell(0,10,'Pag.: '.$this->PageNo().'/{nb}',0,0,'R');

}
}

$tipo = isset($_REQUEST['t']) ? $_REQUEST['t'] : 'excel';
$extension = '.xls';

if($tipo == 'word') $extension = '.doc';

// Si queremos exportar a PDF
if($tipo == 'pdf'){
/*Datos aleatorios para el ejemplo*/
/* //Ejemplo1
$nombres=array('Manuel','Nuria','Angela','Andrea','Ramiro','Victor','Miguel','Vanessa');
$apellidos=array('Molina','Aguirre','Cobos','Santos','Gurruchaga','Pino','Navarro','Medina');
$grados=array('1','2','3');
$cursos=array('A','B','C','D','E','F');
$habilidades=array('Hace esto muy bien','Hace aquello ni fu ni fa','Evoluciona en la materia','Sabe mucho de esto','Tiene una buena actitud','Tiene buenas aptitudes');
$asignaturas=array('Matemáticas','Lengua española','Geometría','Religión');


// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
for($i=1;$i<=10;$i++){
    $alumno=$nombres[rand(0, 7)].' '.$apellidos[rand(0, 7)].' '.$apellidos[rand(0, 7)];
    $grado=$grados[rand(0, 2)];
    $curso=$cursos[rand(0, 5)];

    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->Cell(4,2,'Alumno: '.$alumno);
    $pdf->SetX(100);
    $pdf->Cell(4,2,'Grado: '.$grado.utf8_decode('º'));
    $pdf->SetX(140);
    $pdf->Cell(4,2,'Curso: '.$curso,0,1);
    $pdf->Ln(7);
    $pdf->Cell(0,2,utf8_decode('Num. Identificación').': '.$i,0,0);
    $pdf->Ln(12);
    $pdf->Line(12,47,200,47);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(0,2,'Materias-Asignaturas:',0,0);
    
    
    for($a=0;$a<4;$a++){
        $pdf->SetFont('Times','B',16);
        $pdf->Ln(12);
        $nota=rand(10,100)/10;
        $pdf->Cell(0,2,utf8_decode($asignaturas[$a]).' ('.rand(0,100).'%) - Nota: '.$nota,0,0);
        $pdf->Ln(12);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,2,'Logros evaluados:',0,0);
        $pdf->Ln(7);
        $pdf->SetFont('Times','',12);
        shuffle($habilidades);
        $pdf->Cell(0,2,'  - '.$habilidades[0],0,0);
        $pdf->Ln(7);
        $pdf->Cell(0,2,'  - '.$habilidades[1],0,0);
        $pdf->Ln(7);
        $pdf->Cell(0,2,'  - '.$habilidades[2],0,0);
        $pdf->Ln(7);
        
        $pdf->Cell(0,2,'_________________________________________________________________________',0,0,'C');
    }

    foreach($model->Listar() as $r): 
       
            $pdf->Cell(utf8_decode($r->__GET('Nombre')));
            $pdf->Cell(utf8_decode($r->__GET('Apellido')));
            $pdf->Cell(utf8_decode($r->__GET('Sexo') == 1 ? 'H' : 'F'));
            $pdf->Cell(utf8_decode($r->__GET('FechaNacimiento')));
        
     endforeach;

    
    }
$pdf->Output(); */
//Ejemplo2
$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML(file_get_contents('http://localhost/xampp/examplepdf/alumnos.php'));
$pdf->Output();

} else{
    require_once 'alumnos.php';
    
    header("Content-type: application/vnd.ms-$tipo");
    header("Content-Disposition: attachment; filename=mi_archivo$extension");
    header("Pragma: no-cache");
    header("Expires: 0");    
}

