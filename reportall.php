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
//$users = mysqli_query($con, "select * from ticket order by created_at desc");

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
//$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
//$query = "SELECT id, title, description, created_at FROM ticket";
$query = "SELECT title, pj.name as project ,kd.name as tipo ,cat.name as categoria, prt.name as priority,
st.name as status, created_at, updated_at FROM ticket tk
LEFT JOIN project pj ON tk.project_id = pj.id LEFT JOIN kind kd ON tk.kind_id = kd.id
LEFT JOIN category cat ON tk.category_id = cat.id
LEFT JOIN priority prt ON tk.priority_id = prt.id
LEFT JOIN status st ON tk.status_id = st.id";

$resultado = mysqli_query($con,$query);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',6);
$pdf->Cell(20,6,'title',1,0,'C',1);
$pdf->Cell(20,6,'project',1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('tipo'),1,0,'C',1);
$pdf->Cell(30,6,'categoria',1,0,'C',1);
$pdf->Cell(20,6,'priority',1,0,'C',1);
$pdf->Cell(20,6,'status',1,0,'C',1);
$pdf->Cell(30,6,'create',1,0,'C',1);
$pdf->Cell(30,6,'update',1,1,'C',1);

$pdf->SetFont('Arial','',10);

while($row = $resultado->fetch_assoc())
{
    $pdf->SetFont('Arial','B',6);
    $pdf->Cell(20,6,$row['title'],1,0,'C');
    $pdf->Cell(20,6,utf8_decode($row['project']),1,0,'C');
    $pdf->Cell(20,6,utf8_decode($row['tipo']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['categoria']),1,0,'C');
    $pdf->Cell(20,6,utf8_decode($row['priority']),1,0,'C');
    $pdf->Cell(20,6,utf8_decode($row['status']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['created_at']),1,0,'C');
    $pdf->Cell(30,6,utf8_decode($row['updated_at']),1,1,'C');
}
$pdf->Output();
?> 