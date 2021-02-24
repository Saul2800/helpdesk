<?php
    $id="";
    session_start();
    include "config/config.php";
    if (!isset($_SESSION['user_id'])&& $_SESSION['user_id']==null) {
        header("location: index.php");
    }
    else{
        $id=$_SESSION['user_id'];
    }
    require('lib/fpdf/WriteHTML.php'); //Para usar el writeHTML
?>
<?php
$tipo = isset($_REQUEST['t']);
$title ="Imprimir Reporte | ";
$users= array();
$users = mysqli_query($con, "select * from ticket order by created_at desc");

/*Inicia la clase del reporte: Jose Luis Caamal Ic 23/02/2020*/
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
/*$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML('');
$pdf->Output();
*/
$hola=file_get_contents('http://localhost/xampp/HelpDesk2021/reports.php');
echo $hola;
?> 