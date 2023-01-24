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
$mysql = mysqli_query($conn, "SELECT s.id, s.client_id, c.name, s.finalized_at, s.created_at, s.address FROM sales s INNER JOIN clients c
WHERE s.id = '".$saleid."' AND s.client_id = c.id");
$invoice = mysqli_fetch_array($mysql);

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

//create pdf object
$pdf = new FPDF('L','mm',array(205,210));
//add new page
$pdf->AddPage();
//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',15);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'CV. BAGONG TEKNINDO CEMERLANG',0,0,'C');
$pdf->Cell(59 ,5,'INVOICE',0,1,'C');//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130 ,5,'Kompleks Pergudangan Tanrise Westgate Blok B No.30',0,0,'C');
$pdf->Cell(59 ,5,'',0,1);//end of line

$pdf->Cell(130 ,5,'Wedi, Gedangan, Sidoarjo-61254, Jawa Timur',0,0,'C');
$pdf->Cell(25 ,5,'Invoice #',0,0,'C');
$pdf->Cell(34 ,5,$invoice['id'],0,1,);//end of line

$pdf->Cell(130 ,5,'Phone [+12345678]',0,0,'C');
$pdf->Cell(25 ,5,'Date',0,0,'C');
$pdf->Cell(34 ,5,date("Y/m/d"),0,1);//end of line

$pdf->Cell(25 ,5,'',0,1);
$pdf->Cell(25 ,5,'Nama Customer: ',0,0);
$pdf->Cell(100 ,5,'Alamat:',0,1,'R');//end of line
$pdf->Cell(34 ,5,$invoice['name'],0,0);//end of line
$pdf->Cell(10 ,5,'',0,0,'R');
$pdf->Cell(100 ,5,$invoice['address'],0,1,'R');

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189 ,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',10);

$pdf->Cell(13 ,6,'Kode',1,0);
$pdf->Cell(80 ,6,'Deskripsi Barang',1,0,'C');
$pdf->Cell(28 ,6,'Jumlah Satuan',1,0,'C');
$pdf->Cell(31 ,6,'Harga Satuan',1,0,'C');
$pdf->Cell(37 ,6,'Total Harga',1,1,'C');//end of line

$pdf->SetFont('Arial','',11);

$query = mysqli_query($conn, "SELECT n.product_id, p.name, n.qty, n.price
FROM sold_products n INNER JOIN products p INNER JOIN sales s WHERE n.sale_id = '".$saleid."' AND n.product_id = p.id
AND n.sale_id = s.id");
$amount = 0;

while($produk = mysqli_fetch_array($query)){
    $pdf->Cell(13, 6,$produk['product_id'],1,0);
    $pdf->Cell(80, 6,$produk['name'],1,0,'L');
    $pdf->Cell(15, 6,$produk['qty'],1,0,'C');
    $pdf->Cell(13, 6,'lmbr',1,0,'C');
    $pdf->Cell(31, 6,'Rp.'.number_format($produk['price'], 3,",","."),1,0,'C');
    $pdf->Cell(37, 6,'Rp.'.number_format($produk['price']*$produk['qty'], 3,",","."),1,1,'C');//end of line
    $amount+= $produk['price']*$produk['qty'];
}

//summary

$pdf->Cell(121 ,5,'',0,0);
$pdf->Cell(31 ,6,'GRAND TOTAL: ',1,0);
$pdf->Cell(8 ,6,'Rp.',1,0);
$pdf->Cell(29 ,6,number_format($amount, 3,",","."),1,1,'R');

$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,8,'',0,1);
$pdf->Cell(50 ,5,'Sesuai Surat Jalan nomer:',0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(50 ,5,'xx/xxx/x/xxx/xx',0,1,'L');

$pdf->SetFont('Arial','',10);
$pdf->Cell(25 ,14,'',0,1);
$pdf->Cell(48 ,5,'Jangka Waktu Pembayaran: ',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(25 ,5,'14 hari dari tanggal pengiriman',0,1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(25 ,5,'Transfer : Bank BCA KCP Dharmahusada / ACC# 388-xxx-xxxx / An. CV. BAGONG TEKNINDO CEMERLANG',0,1);

$pdf->Cell(25 ,9,'',0,1);
$pdf->Cell(188 ,5,'Hormat Kami,                                  ',0,0,'R');
$pdf->Cell(25 ,20,'',0,1);
$pdf->Cell(188 ,5,'(MANSURY JAP)                              ',0,0,'R');

//output the result

$pdf->Output();
exit;
?>

