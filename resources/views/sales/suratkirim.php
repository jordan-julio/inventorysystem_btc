<?php
$saleid = $sale->id;
// Send headers
header("Content-Type: application/pdf");

// Set a filename
$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "db_inventory";

$conn = mysqli_connect($servername,$dBUsername,$dBPassword, $dBName);

if(!$conn){
    die("connection failed: " . mysqli_connect_error());  

}
//call the FPDF library
require_once("C:/xampp/htdocs/invetorymanagement/laravel-inventory/resources/views/sales/fpdf/fpdf.php");

$mysql = mysqli_query($conn, "SELECT s.id, s.client_id, c.name, s.finalized_at, s.created_at, s.address, s.ponumber 
FROM sales s INNER JOIN clients c WHERE s.id = '".$saleid."' AND s.client_id = c.id");
$invoice = mysqli_fetch_array($mysql);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//create pdf object
$pdf = new FPDF('L','mm',array(180,219));
//add new page
$pdf->AddPage();
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',15);

//Cell(width , height , text , border , end line , [align] )
$pdf->Cell(15 ,5,'',0,0,'L');
$pdf->Cell(105 ,5,'CV. BAGONG TEKNINDO CEMERLANG',0,0,'L');
$pdf->SetFont('Arial','',12);
$pdf->Cell(59 ,5,'Sidoarjo        '.date("d-M-y").'',0,1,'L');//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);
$pdf->Cell(15 ,5,'',0,0,'L');
$pdf->Cell(105 ,5,'Kompleks Pergudangan Tanrise Westgate',0,0,'L');
$pdf->Cell(59 ,5,'Kepada Yth:',0,1,'L');//end of line

$pdf->Cell(15 ,5,'',0,0,'L');
$pdf->Cell(105 ,5,'Blok B No.30, Wedi, Gedangan, Sidoarjo',0,0,'L');
$pdf->Cell(59 ,5,'Customer  :  '.$invoice['name'].'',0,1,'L');

$pdf->Cell(15 ,5,'',0,0,'L');
$pdf->Cell(105 ,5,'Telp. 031-8015289',0,0,'L');
$pdf->Cell(59 ,5,'Alamat   :   '.$invoice['address'].'',0,1,'L');


$pdf->Cell(25 ,5,'',0,1);
$pdf->Cell(25 ,5,'SURAT JALAN: SJ/'.$invoice['id'].'/'.date("y").'',0,1);




//make a dummy empty cell as a vertical spacer
$pdf->SetFont('Arial','',9);
$pdf->Cell(189 ,7,'kami kirimkan barang-barang tersebut dibawah ini dengan kendaraan',0,1);//end of line


//invoice contents
$pdf->SetFont('Arial','B',10);

$pdf->Cell(50 ,6,'BANYAKNYA',1,0,'C');
$pdf->Cell(139,6,'NAMA BARANG',1,1,'C');

$pdf->SetFont('Arial','',11);

//Numbers are right-aligned so we give 'R' after new line parameter
$query = mysqli_query($conn, "SELECT  s.id, n.product_id, p.name, n.qty, n.price, p.length, p.width, p.thickness
FROM sold_products n INNER JOIN products p INNER JOIN sales s WHERE n.sale_id = '".$saleid."' AND n.product_id = p.id
AND n.sale_id = s.id");
$amount = 0;


while($produk = mysqli_fetch_array($query)){
    $pdf->Cell(50, 6,$produk['qty'].'   LBR',1,0,'C');
    $pdf->Cell(139, 6,strtoupper($produk['name'].' '.$produk['length'].' x '.$produk['width'].' x '.$produk['thickness'].' mm'),1,1,'L');
}

//summary
$mysql = mysqli_query($conn, "SELECT s.id
FROM sales s INNER JOIN clients c WHERE s.id ='".$saleid."'");
$invoice = mysqli_fetch_array($mysql);

$pdf->SetFont('Arial','',10);
$pdf->Cell(25 ,8,'Putih: Customer   Merah: CV.Bagong   Kuning: CV.Bagong   Hijau: Customer',0,1,'L');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(50 ,5,'Sesuai Invoice: '.$invoice['id'].'',0,1,'L');

$pdf->SetFont('Arial','',10);
$pdf->Cell(25 ,9,'',0,1);
$pdf->Cell(62.7 ,5,'Dikeluarkan oleh,',0,0,'L');
$pdf->Cell(62.7 ,5,'Mengetahui,',0,0,'L');
$pdf->Cell(62.7,5,'     Diterima oleh,',0,0,'L');
$pdf->Cell(25 ,25,'',0,1);
$pdf->Cell(62.7 ,5,'(                                 )',0,0,'L');
$pdf->Cell(62.7 ,5,'(                                 )',0,0,'L');
$pdf->Cell(62.7 ,5,'   (                                        )',0,1,'L');

//output the result

$pdf->Output();
exit;
?>

