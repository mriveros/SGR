<?php 
session_start();
?>
<?php
//Example FPDF script with PostgreSQL
//Ribamar FS - ribafs@dnocs.gov.br

require('fpdf.php');

class PDF extends FPDF{
function Footer()
{
    
    /***********************************OBTENER DATOS DEL FORMULARIO Y DATOS CABECERA***********************************/
    if  (empty($_POST['txtDesdeFecha'])){$fechadesde='00/00/0000';}else{$fechadesde=$_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$fechahasta='00/00/0000';}else{$fechahasta=$_POST['txtHastaFecha'];}
    if  (empty($_POST['txtDepartamento'])){$departamento=0;}else{$departamento=$_POST['txtDepartamento'];}
    $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"select depar_desc as departamento from departamentos_unidad where depar_cod=$departamento"); 
    $row1 = pg_fetch_array($consulta);
    $nombre_departamento=$row1['departamento'];
    /********************************************************************************************************************/
        $this->SetFont('Arial','B',8);
//        $consulta=pg_exec($conectate,"select sum(pre.prec_cantprecinto) as prec_cantprecinto, sum(pre.prec_precio) as prec_precio
//        from puestos pues,precintado pre,emblemas em
//        where pues.pues_cod=pre.pues_cod
//        and em.em_cod=pre.em_cod
//        and pre.prec_fecha>='$fechadesde' 
//        and pre.prec_fecha <= '$fechahasta'
//        and em.em_cod=$emblema");
//        $row1 = pg_fetch_array($consulta);
//        $precinto_total=$row1['prec_cantprecinto'];
//        $precio_total=$row1['prec_precio'];
        
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(237,380,15,380);//largor,ubicacion derecha,inicio,ubicacion izquierda
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial','I',8);
//        $this->text(15,220,'Total de Reactivos Retirados: '.$precinto_total);
//        $this->text(15,225,'Total Precio: '.$precio_total);
        // Print centered page number
	$this->Cell(0,2,utf8_decode('Página: ').$this->PageNo().' de {nb}',0,0,'R');
	$this->text(15,378,'Consulta Generada: '.date('d-M-Y').' '.date('h:i:s'));
}

function Header()
{
    // Select Arial bold 15
        $this->SetFont('Arial','',9);
	$this->Image('img/intn.jpg',15,10,-300,0,'','../../InformeCargos.php');
        // Move to the right
        $this->Cell(80);
        // Framed title
	$this->text(15,32,utf8_decode('Instituto Nacional de Tecnología, Normalización y Metrología'));
	$this->text(185,32,utf8_decode('Sistema de Gestión de Reactivos'));
        //$this->text(315,37,'Mes: '.utf8_decode(genMonth_Text($mes).' Año: 2016'));
	//$this->Cell(30,10,'noc',0,0,'C');
        // Line break
        $this->Ln(30);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.2);
	$this->Line(237,33,10,33);//largor,ubicacion derecha,inicio,ubicacion izquierda
    
    
    
    if  (empty($_POST['txtDesdeFecha'])){$fechadesde='00/00/0000';}else{$fechadesde=$_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$fechahasta='00/00/0000';}else{$fechahasta=$_POST['txtHastaFecha'];}
    if  (empty($_POST['txtDepartamento'])){$departamento=0;}else{$departamento=$_POST['txtDepartamento'];}
    $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"select depar_desc as departamento from departamentos_unidad where depar_cod=$departamento"); 
    $row1 = pg_fetch_array($consulta);
    $nombre_departamento=$row1['departamento'];
    
    $this->SetFont('Arial','B',8);
    $this->SetTitle('Informe-Departamentos/Unidad');
    $this->Cell(230,1,'INFORME DE REACTIVOS POR DEPARTAMENTOS - UNIDAD',100,100,'C');//Titulo
    $this->text(15,50,'DEPARTAMENTO - UNIDAD:  ');
    $this->text(55,50,$nombre_departamento);
    $this->text(15,55,'DESDE: ');
    $this->text(30,55,$fechadesde);
    $this->text(15,60,'HASTA: ');
    $this->text(30,60,$fechahasta);
    $this->SetFillColor(153,192,141);
    $this->SetTextColor(255);
    $this->SetDrawColor(153,192,141);
    $this->SetLineWidth(.3);
    
    $this->SetXY(10,65 );
    
    $this->Cell(15,10,'Item',1,0,'C',1);
    $this->Cell(70,10,'Reactivo',1,0,'C',1);
    $this->Cell(25,10,'Fecha Retiro',1,0,'C',1);
    $this->Cell(30,10,'Cantidad',1,0,'C',1);
    $this->Cell(30,10,'Cantidad Actual',1,0,'C',1);
    $this->Cell(55,10,'Encargado',1,1,'C',1);
}
}

$pdf=new PDF();//'P'=vertical o 'L'=horizontal,'mm','A4' o 'Legal'
/***********************************OBTENER DATOS DEL FORMULARIO Y DATOS CABECERA***********************************/
    if  (empty($_POST['txtDesdeFecha'])){$fechadesde='00/00/0000';}else{$fechadesde=$_POST['txtDesdeFecha'];}
    if  (empty($_POST['txtHastaFecha'])){$fechahasta='00/00/0000';}else{$fechahasta=$_POST['txtHastaFecha'];}
    if  (empty($_POST['txtDepartamento'])){$departamento=0;}else{$departamento=$_POST['txtDepartamento'];}
    $conectate=pg_connect("host=localhost port=5432 dbname=SGR user=postgres password=postgres"
                    . "")or die ('Error al conectar a la base de datos');
    $consulta=pg_exec($conectate,"select depar_desc as departamento from departamentos_unidad where depar_cod=$departamento"); 
    $row1 = pg_fetch_array($consulta);
    $nombre_departamento=$row1['departamento'];
/********************************************************************************************************************/
  
//------------------------------------------------------------------------------      
$pdf->AddPage('P', 'legal');
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',10);

$consulta=pg_exec($conectate,"select pro_nombre,reti_fecha,retidet_cantidad,retidet_cantidad_actual,en_nom || ' ' || en_ape as encargado from
producto,retiro,retiro_detalle,encargado,departamentos_unidad,stock_detalle where
producto.pro_cod=stock_detalle.pro_cod and
retiro.en_cod=encargado.en_cod and 
retiro.depar_cod=departamentos_unidad.depar_cod
and stock_detalle.stockdet_cod=retiro_detalle.stockdet_cod
and retiro.reti_cod=retiro_detalle.reti_cod and retiro.reti_fecha>='$fechadesde' and retiro.reti_fecha<='$fechahasta' and retiro.depar_cod=$departamento");

$numregs=pg_numrows($consulta);
$pdf->SetFont('Arial','',10);
$pdf->SetFillColor(224,255,255);
$pdf->SetDrawColor(0,0,0);
$pdf->SetTextColor(0);
//Build table
$fill=false;
$i=0;
while($i<$numregs)
{
    $producto=pg_result($consulta,$i,'pro_nombre');
    $fechareti=pg_result($consulta,$i,'reti_fecha');
    $cantidad=pg_result($consulta,$i,'retidet_cantidad');
    $cantidadactual=pg_result($consulta,$i,'retidet_cantidad_actual');
    $encargado=pg_result($consulta,$i,'encargado');
   
    
    
    
    $pdf->Cell(15,5,$i+1,1,0,'C',$fill);
    $pdf->Cell(70,5,$producto,1,0,'L',$fill);
    $pdf->Cell(25,5,$fechareti,1,0,'C',$fill);
    $pdf->Cell(30,5,$cantidad,1,0,'C',$fill);
    $pdf->Cell(30,5,$cantidadactual,1,0,'C',$fill);
    $pdf->Cell(55,5,$encargado,1,1,'L',$fill);
    $fill=!$fill;
    $i++;
}


//Add a rectangle, a line, a logo and some text
/*
$pdf->Rect(5,5,170,80);
$pdf->Line(5,90,90,90);
//$pdf->Image('mouse.jpg',185,5,10,0,'JPG','http://www.dnocs.gov.br');
$pdf->SetFillColor(224,235);
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(5,95);
$pdf->Cell(170,5,'PDF gerado via PHP acessando banco de dados - Por Ribamar FS',1,1,'L',1,'mailto:ribafs@dnocs.gov.br');
*/
ob_end_clean();
$pdf->Output();
$pdf->Close();
// generamos los meses 
function genMonth_Text($m) { 
 switch ($m) { 
  case '01': $month_text = "Enero"; break; 
  case '02': $month_text = "Febrero"; break; 
  case '03': $month_text = "Marzo"; break; 
  case '04': $month_text = "Abril"; break; 
  case '05': $month_text = "Mayo"; break; 
  case '06': $month_text = "Junio"; break; 
  case '07': $month_text = "Julio"; break; 
  case '08': $month_text = "Agosto"; break; 
  case '09': $month_text = "Septiembre"; break; 
  case '10': $month_text = "Octubre"; break; 
  case '11': $month_text = "Noviembre"; break; 
  case '12': $month_text = "Diciembre"; break; 
 } 
 return ($month_text); 
} 
?>