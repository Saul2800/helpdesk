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
    $this->Cell(110,10,'Reporte de comentarios',0,0,'C');
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
    $this->Cell(0,10,'Reporte de Comentarios',0,0);
    // Número de página
    $this->Cell(0,10,'Pag.: '.$this->PageNo().'/{nb}',0,0,'R');

}
}
/*Ejemplo básico*/
/*$pdf=new PDF_HTML();
$pdf->AddPage();
$pdf->SetFont('Arial');
$pdf->WriteHTML('');
$pdf->Output();
*/
//$query = "SELECT e.estado, m.id_municipio, m.municipio FROM t_municipio AS m INNER JOIN t_estado AS e ON m.id_estado=e.id_estado";
//$query = "SELECT id, title, description, created_at FROM ticket";
//if($kind == 1){ //ADMINISTRADOR VE SOLO LO SUYO
    $query = "SELECT cmt.id as IdComment, usr.username as Username ,cmt.comment as comment ,cmt.rating as rating,
    pj.name as project, tk.id as IdTicket, kd.name as kindTicket, cmt.created_at as created_at FROM ticket tk
     JOIN project pj ON tk.project_id = pj.id 
     JOIN kind kd ON tk.kind_id = kd.id
     JOIN comment cmt ON cmt.id_ticket = tk.id 
     JOIN user usr ON cmt.id_user = usr.id WHERE cmt.id_user =".$id;
    //var_dump($query);
/*} else if($kind == 2){ //USUARIO VE SOLO LO SUYO
    $query = "SELECT cmt.id as IdComment, usr.username as Username ,cmt.comment as comment ,cmt.rating as rating,
    pj.name as project, tk.id as IdTicket, kd.name as kindTicket, cmt.created_at as created_at FROM ticket tk
     JOIN project pj ON tk.project_id = pj.id 
     JOIN kind kd ON tk.kind_id = kd.id
     JOIN comment cmt ON cmt.id_ticket = tk.id 
     JOIN user usr ON cmt.id_user = usr.id WHERE cmt.id_user =".$id;
    //var_dump($query);
}else if($kind == 3){ //PROVEEDOR VE TODO DE LOS SUYOS
    $query = "SELECT cmt.id as IdComment, usr.username as Username ,cmt.comment as comment ,cmt.rating as rating,
    pj.name as project, tk.id as IdTicket, kd.name as kindTicket, cmt.created_at as created_at FROM ticket tk
     JOIN project pj ON tk.project_id = pj.id 
     JOIN kind kd ON tk.kind_id = kd.id
     JOIN comment cmt ON cmt.id_ticket = tk.id 
     JOIN user usr ON cmt.id_user = usr.id WHERE usr.kind =".$kind;
    //var_dump($query);
}else if($kind == 4){ //MONITORITE VE TODO DE LO SUYO
    $query = "SELECT cmt.id as IdComment, usr.username as Username ,cmt.comment as comment ,cmt.rating as rating,
    pj.name as project, tk.id as IdTicket, kd.name as kindTicket, cmt.created_at as created_at FROM ticket tk
     JOIN project pj ON tk.project_id = pj.id 
     JOIN kind kd ON tk.kind_id = kd.id
     JOIN comment cmt ON cmt.id_ticket = tk.id 
     JOIN user usr ON cmt.id_user = usr.id WHERE usr.kind =".$kind;
    //var_dump($query);
}*/
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
$pdf->Cell(15,6,utf8_decode('ID'),1,0,'C',1);
$pdf->Cell(40,6,'Username',1,0,'C',1);
$pdf->Cell(100,6,utf8_decode('Comentario'),1,0,'C',1);
$pdf->Cell(15,6,'Calificacion',1,0,'C',1);
$pdf->Cell(40,6,'Proceso electoral',1,0,'C',1);
$pdf->Cell(15,6,'ID ticket',1,0,'C',1);
$pdf->Cell(20,6,'Tipo de ticket',1,0,'C',1);
$pdf->Cell(30,6,utf8_decode('Fecha de creacion'),1,1,'C',1);

$pdf->SetFont('Arial','',10);
while($row = $resultado->fetch_assoc())
{
        $pdf->SetFont('Arial','B',6);
    
        //$pdf->Cell(20,6,utf8_decode($kind),1,0,'C');
        $pdf->Cell(15,6,utf8_decode($row['IdComment']),1,0,'C');
        $pdf->Cell(40,6,utf8_decode($row['Username']),1,0,'C');
        $pdf->Cell(100,6,utf8_decode($row['comment']),1,0,'C');
        $pdf->Cell(15,6,utf8_decode($row['rating']),1,0,'C');
        $pdf->Cell(40,6,utf8_decode($row['project']),1,0,'C');
        $pdf->Cell(15,6,utf8_decode($row['IdTicket']),1,0,'C');
        $pdf->Cell(20,6,utf8_decode($row['kindTicket']),1,0,'C');
        $pdf->Cell(30,6,utf8_decode($row['created_at']),1,1,'C');
}

$pdf->Output();
?> 