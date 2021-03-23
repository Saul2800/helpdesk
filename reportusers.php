<?php
/*Inicio: José Luis Caamal Ic, se usa para crear el reporte, se puede adaptar a cualquier reporte 24/02/2021*/
    $id="";
    session_start();
    include "config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
    }
    else{
        $id=$_SESSION['user_id'];
        $kind=$_SESSION['user_kind'];
    }
require('lib/fpdf/fpdf.php');?>
<?php
$tipo = isset($_REQUEST['t']);
$title ="Imprimir Reporte | ";
$users= array();
//$users = mysqli_query($con, "select * from ticket order by created_at desc");

/*Inicia la clase del reporte: Jose Luis Caamal Ic 23/02/2020*/
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('images/logo.PNG',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(120,10,'Reporte de usuarios',0,0,'C');
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
    $this->Cell(0,10,'Reporte de usuarios',0,0);
    // Número de página
    $this->Cell(0,10,'Pag.: '.$this->PageNo().'/{nb}',0,0,'R');

}
}

    $query = "SELECT usr.id as IDUSER, usr.username as USERNAME, usr.dni as DNI, usr.name as NAME,usr.phone as PHONE, usr.email as EMAIL,kd.name as KIND, created_at from user usr
        JOIN kind kd ON kd.id=usr.kind";

$resultado = mysqli_query($con,$query);

$pdf = new PDF('L');
//SIN MARGEN
//$pdf = new PDF('P'); //Vertical
//$pdf = new PDF('L'); //Horizontal
//CON MARGEN
//$pdf=new PDF('P', 'mm', 'A4');  Vertical
//$pdf=new PDF('L','mm','A4'); Horizontal
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',6);
//$pdf->Cell(20,6,'id',1,0,'C',1);
$pdf->Cell(10,6,utf8_decode('ID'),1,0,'C',1);
$pdf->Cell(60,6,'Username',1,0,'C',1);
$pdf->Cell(15,6,utf8_decode('DNI'),1,0,'C',1);
$pdf->Cell(70,6,'Nombre',1,0,'C',1);
$pdf->Cell(13,6,'Telefono',1,0,'C',1);
$pdf->Cell(80,6,'Email',1,0,'C',1);
$pdf->Cell(25,6,utf8_decode('Fecha de creacion'),1,1,'C',1);

$pdf->SetFont('Arial','',10);
while($row = $resultado->fetch_assoc())
{
        $pdf->SetFont('Arial','B',6);
    
        //$pdf->Cell(20,6,utf8_decode($kind),1,0,'C');
        $pdf->Cell(10,6,utf8_decode($row['IDUSER']),1,0,'C');
        $pdf->Cell(60,6,utf8_decode($row['USERNAME']),1,0,'C');
        $pdf->Cell(15,6,utf8_decode($row['DNI']),1,0,'C');
        $pdf->Cell(70,6,utf8_decode($row['NAME']),1,0,'C');
        $pdf->Cell(13,6,utf8_decode($row['PHONE']),1,0,'C');
        $pdf->Cell(80,6,utf8_decode($row['EMAIL']),1,0,'C');
        $pdf->Cell(25,6,utf8_decode($row['created_at']),1,1,'C');
}

$pdf->Output();
?> 