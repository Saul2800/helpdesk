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
    require('lib/fpdf/fpdf.php'); //Para usar el writeHTML
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
    $this->Image('images/logo.PNG',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(120,10,'Reporte de tickets',0,0,'C');
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
    $this->Cell(0,10,'Reporte de Tickets',0,0);
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
if($kind == 1){ //ADMINISTRADOR VE TODO
    $query = "SELECT title, pj.name as project ,kd.name as tipo ,cat.name as categoria, prt.name as priority,
    st.name as status, created_at, updated_at FROM ticket tk
    LEFT JOIN project pj ON tk.project_id = pj.id LEFT JOIN kind kd ON tk.kind_id = kd.id
    LEFT JOIN category cat ON tk.category_id = cat.id
    LEFT JOIN priority prt ON tk.priority_id = prt.id
    LEFT JOIN status st ON tk.status_id = st.id";
    //var_dump($query);
}else if($kind == 2){ //Si es tipo usuario, solo muestra los tickets que el usuario creo
    $query = "SELECT title, pj.name as project ,kd.name as tipo ,cat.name as categoria, prt.name as priority,
    st.name as status, created_at, updated_at FROM ticket tk
    LEFT JOIN project pj ON tk.project_id = pj.id LEFT JOIN kind kd ON tk.kind_id = kd.id
    LEFT JOIN category cat ON tk.category_id = cat.id
    LEFT JOIN priority prt ON tk.priority_id = prt.id
    LEFT JOIN status st ON tk.status_id = st.id WHERE tk.user_id =".$id;
    //var_dump($query);
}else if($kind == 3){//Si es tipo proveedor, muestra todos los tickets
    $query = "SELECT title, pj.name as project ,kd.name as tipo ,cat.name as categoria, prt.name as priority,
    st.name as status, created_at, updated_at FROM ticket tk
    LEFT JOIN project pj ON tk.project_id = pj.id LEFT JOIN kind kd ON tk.kind_id = kd.id
    LEFT JOIN category cat ON tk.category_id = cat.id
    LEFT JOIN priority prt ON tk.priority_id = prt.id
    LEFT JOIN status st ON tk.status_id = st.id WHERE tk.asigned_id =".$id;
    //var_dump($query);
}else if($kind == 4){//Si es tipo monitorETI, muestra todos los tickets
    $query = "SELECT title, pj.name as project ,kd.name as tipo ,cat.name as categoria, prt.name as priority,
    st.name as status, created_at, updated_at FROM ticket tk
    LEFT JOIN project pj ON tk.project_id = pj.id LEFT JOIN kind kd ON tk.kind_id = kd.id
    LEFT JOIN category cat ON tk.category_id = cat.id
    LEFT JOIN priority prt ON tk.priority_id = prt.id
    LEFT JOIN status st ON tk.status_id = st.id WHERE tk.asigned_id =".$id;
    //var_dump($query);
}
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
$pdf->Cell(50,6,utf8_decode('Título'),1,0,'C',1);
$pdf->Cell(50,6,'ProcesoE',1,0,'C',1);
$pdf->Cell(20,6,utf8_decode('Tipo'),1,0,'C',1);
$pdf->Cell(60,6,'Categoria',1,0,'C',1);
$pdf->Cell(20,6,'Prioridad',1,0,'C',1);
$pdf->Cell(20,6,'Estatus',1,0,'C',1);
$pdf->Cell(30,6,'Fecha',1,0,'C',1);
$pdf->Cell(30,6,utf8_decode('Actualización'),1,1,'C',1);

$pdf->SetFont('Arial','',10);
while($row = $resultado->fetch_assoc())
{
        $pdf->SetFont('Arial','B',6);
    
        //$pdf->Cell(20,6,utf8_decode($kind),1,0,'C');
        $pdf->Cell(50,6,utf8_decode($row['title']),1,0,'C');
        $pdf->Cell(50,6,utf8_decode($row['project']),1,0,'C');
        $pdf->Cell(20,6,utf8_decode($row['tipo']),1,0,'C');
        $pdf->Cell(60,6,utf8_decode($row['categoria']),1,0,'C');
        $pdf->Cell(20,6,utf8_decode($row['priority']),1,0,'C');
        $pdf->Cell(20,6,utf8_decode($row['status']),1,0,'C');
        $pdf->Cell(30,6,utf8_decode($row['created_at']),1,0,'C');
        $pdf->Cell(30,6,utf8_decode($row['updated_at']),1,1,'C');
}

$pdf->Output();
?> 