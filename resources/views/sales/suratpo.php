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
$pdf = new FPDF('P','mm',array(210,250));
//add new page
$pdf->AddPage();
$pdf->Cell(195 ,10,'',0,1,);
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',10);
$pdf->Cell(195 ,10,'ORDER PEMESANAN DAN PENGIRIMAN BARANG',0,1,'C');
//Cell(width , height , text , border , end line , [align] )
$pdf->SetFont('Arial','B',15);
$pdf->Cell(195 ,7,'CV. BAGONG TEKNINDO CEMERLANG',0,1,'C');

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);
$pdf->Cell(195 ,5,'No.'.$invoice['id'].' / '.date("m").'/ BTC / '.date("Y").'',0,1,'C');


$pdf->Cell(25 ,5,'',0,1);
$pdf->Cell(25 ,5,'Nama Customer : ',0,0);
$pdf->Cell(135 ,5,'Tanggal OPPB: '.date("d-m-Y").'',0,1,'R');//end of line
$pdf->SetFont('Arial','B',12);
$pdf->Cell(34 ,5,$invoice['name'],0,1);//end of line
$pdf->SetFont('Arial','',11);
$pdf->Cell(25 ,2,'',0,1);
$pdf->Cell(105,5,'#Address toko#',0,0,'L');
$pdf->Cell(34 ,5,'Permintaan Tanggal Pengiriman : ',0,1,'L');
$pdf->Cell(105 ,5,'',0,0,'R');
$pdf->Cell(40 ,5,date("l, d F Y",strtotime($invoice["finalized_at"])),0,1,'L');
$pdf->Cell(25 ,2,'',0,1);
$pdf->Cell(105 ,5,'Alamat Pengiriman : ',0,0,'L');
$pdf->Cell(40 ,5,'nomer PO:'.$invoice['ponumber'].'',0,1);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(34 ,5,$invoice['address'],0,1,'L');

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',10);

$pdf->Cell(90 ,6,'Deskripsi Barang',1,0,'C');
$pdf->Cell(14 ,6,'Satuan',1,0,'C');
$pdf->Cell(14 ,6,'Jumlah',1,0,'C');
$pdf->Cell(31 ,6,'Harga Satuan',1,0,'C');
$pdf->Cell(37 ,6,'Total Harga',1,1,'C');//end of line

$pdf->SetFont('Arial','',11);

//Numbers are right-aligned so we give 'R' after new line parameter
$query = mysqli_query($conn, "SELECT  n.product_id, p.name, n.qty, n.price, p.length, p.width, p.thickness
FROM sold_products n INNER JOIN products p INNER JOIN sales s WHERE n.sale_id = '".$saleid."' AND n.product_id = p.id
AND n.sale_id = s.id");
$amount = 0;

while($produk = mysqli_fetch_array($query)){
    $pdf->Cell(90, 6,strtoupper($produk['name'].' '.$produk['length'].' x '.$produk['width'].' x '.$produk['thickness'].' mm'),1,0,'L');
    $pdf->Cell(14, 6,$produk['qty'],1,0,'C');
    $pdf->Cell(14, 6,'lmbr',1,0,'C');
    $pdf->Cell(31, 6,'Rp.'.number_format($produk['price'], 3,",","."),1,0,'C');
    $pdf->Cell(37, 6,'Rp.'.number_format($produk['price']*$produk['qty'], 3,",","."),1,1,'C');//end of line
    $amount+= $produk['price']*$produk['qty'];
}

//summary

$pdf->Cell(118 ,5,'',0,0);
$pdf->Cell(31 ,6,'TOTAL',1,0,'C');
$pdf->Cell(8 ,6,'Rp.',1,0);
$pdf->Cell(29 ,6,number_format($amount, 3,",","."),1,1,'R');

$pdf->SetFont('Arial','',10);
$pdf->Cell(25 ,3,'',0,1);
$pdf->Cell(48 ,5,'Jangka Waktu Pembayaran: ',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,5,'14 hari',0,1,'C');
$pdf->SetFont('Arial','',9);
$pdf->Cell(25 ,5,'Penjual : ******',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(25 ,9,'',0,1);
$pdf->Cell(62.7 ,5,'Mengetahui',0,0,'R');
$pdf->Cell(60 ,5,'Menyetujui,',0,0,'R');
$pdf->Cell(62.7,5,'Mengajukan:',0,0,'R');
$pdf->Cell(25 ,25,'',0,1);

//output the result

$pdf->Output();
exit;
?>

