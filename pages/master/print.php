<?php
include "../../config/db.php";
require('../../assets/pdf/fpdf.php');

$pdf = new FPDF('L','mm','A3');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',18);

//Image( file name , x position , y position , width [optional] , height [optional] )
// $pdf->Image('images/Aerovisualstudio_02_Flat.png',2,9,60,30);
// $pdf->SetX(4);


//invoice contents
$pdf->SetFont('Arial','B',10);

// $pdf->Cell(10	,5,'No',1,0);
// $pdf->Cell(20	,5,'Buyer',1,0);//end of line
// $pdf->Cell(30	,5,'Item',1,0);
// $pdf->Cell(28	,5,'Jumlah Kabel',1,0);
// $pdf->Cell(28	,5,'Kode Produksi',1,0);
// $pdf->Cell(20	,5,'Jumlah',1,0);
// $pdf->Cell(27	,5,'Tanggal',1,0);
$pdf->Cell(10	,15,'No',1,0,'C');
$pdf->Cell(20	,15,'Buyer',1,0,'C');
$pdf->Cell(30	,15,'Item',1,0,'C');
$pdf->Cell(40	,15,'Jumlah Kabel',1,0,'C');
$pdf->Cell(40	,15,'Kode Produksi',1,0,'C');
$pdf->Cell(20	,15,'Jumlah',1,0,'C');
$pdf->Cell(30	,15,'Tanggal',1,0,'C');
$pdf->Cell(90	,5,'Perakitan',1,0,'C');
$pdf->Cell(90	,5,'QC',1,0,'C');
$pdf->Cell(30	,10,'Packing',1,0,'C');
$pdf->Cell(0	,5,'',0,1);

//second thead
$pdf->Cell(190	,5,'',0,0);
$pdf->Cell(30	,5,'Pasang Kabel',1,0,'C');
$pdf->Cell(30	,5,'Tape',1,0,'C');
$pdf->Cell(30	,5,'Korget',1,0,'C');
$pdf->Cell(30	,5,'Dotsu',1,0,'C');
$pdf->Cell(30	,5,'Gaikan 1',1,0,'C');
$pdf->Cell(30	,5,'Gaikan 2',1,1,'C');

// pasang kabel
$pdf->Cell(190	,5,'',0,0);
$pdf->Cell(10	,5,'/day',1,0);
$pdf->Cell(10	,5,'Total',1,0);
$pdf->Cell(10	,5,'Sisa',1,0);

// tape
$pdf->Cell(10	,5,'/day',1,0);
$pdf->Cell(10	,5,'Total',1,0);
$pdf->Cell(10	,5,'Sisa',1,0);

// korget
$pdf->Cell(10	,5,'/day',1,0);
$pdf->Cell(10	,5,'Total',1,0);
$pdf->Cell(10	,5,'Sisa',1,0);

// dotsu
$pdf->Cell(10	,5,'/day',1,0);
$pdf->Cell(10	,5,'Total',1,0);
$pdf->Cell(10	,5,'Sisa',1,0);

// gaikan 1
$pdf->Cell(10	,5,'/day',1,0);
$pdf->Cell(10	,5,'Total',1,0);
$pdf->Cell(10	,5,'Sisa',1,0);

// gaikan 2
$pdf->Cell(10	,5,'/day',1,0);
$pdf->Cell(10	,5,'Total',1,0);
$pdf->Cell(10	,5,'Sisa',1,0);

// packing
$pdf->Cell(10	,5,'/day',1,0);
$pdf->Cell(10	,5,'Total',1,0);
$pdf->Cell(10	,5,'Sisa',1,1);

$pdf->SetFont('Arial','',10);

// isi data
$query='';
if(isset($_GET['item']) && $_GET['item'] != null){
    $query = "WHERE tb_produksi.item_id ='".$_GET['item']."' ";
}else if(isset($_GET['tanggal']) && $_GET['tanggal'] != null){
    $query = "WHERE tb_produksi.tanggal ='".$_GET['tanggal']."' ";
}else if(isset($_GET['tanggal']) && $_GET['tanggal'] != null && isset($_GET['item']) && $_GET['item'] != null){
    $query = "WHERE tb_produksi.item_id ='".$_GET['item']."' 
        AND tb_produksi.tanggal ='".$_GET['tanggal']."'
    ";
}

$sql = "SELECT tb_produksi.*, tb_item.*, 
tb_item.tanggal as tanggal_item, 
tb_produksi.tanggal as tanggal_produksi, 
tb_produksi.id as id_produksi
FROM tb_produksi
LEFT JOIN tb_item ON tb_item.id = tb_produksi.item_id
$query";

// $data=$mysqli->query()->fetch_assoc();

$exeProduksi=$conn->query($sql);
$i=1;
while($whileProduksi = $exeProduksi->fetch_assoc()){

$pdf->Cell(10	,5,$i++,1,0,'C');
$pdf->Cell(20	,5,'',1,0,'C');
$pdf->Cell(30	,5,$whileProduksi['item_name'],1,0,'C');
$pdf->Cell(40	,5,$whileProduksi['jumlah_kabel'],1,0,'C');
$pdf->Cell(40	,5,$whileProduksi['kode_produksi'],1,0,'C');
$pdf->Cell(20	,5,$whileProduksi['jumlah'],1,0,'C');
$pdf->Cell(30	,5,date('d-m-Y', strtotime($whileProduksi['tanggal_produksi'])),1,0,'C');

$sql = "SELECT tb_state.*, tb_produksi.*
FROM tb_produksi
LEFT JOIN tb_state ON tb_state.produksi_id = tb_produksi.id
$query
";
$exeGet=$conn->query($sql);

    while($row = $exeGet->fetch_assoc()){
        if($row['state'] == 'kabel' && $whileProduksi['id_produksi'] == $row['produksi_id']){
            $pdf->Cell(10	,5,$row['day'],1,0,'C');
            $pdf->Cell(10	,5,$row['total'],1,0,'C');
            $pdf->Cell(10	,5,$row['sisa'],1,0,'C');
        }

        if($row['state'] == 'tape' && $whileProduksi['id_produksi'] == $row['produksi_id']){
            $pdf->Cell(10	,5,$row['day'],1,0,'C');
            $pdf->Cell(10	,5,$row['total'],1,0,'C');
            $pdf->Cell(10	,5,$row['sisa'],1,0,'C');
        }

        if($row['state'] == 'korget' && $whileProduksi['id_produksi'] == $row['produksi_id']){
            $pdf->Cell(10	,5,$row['day'],1,0,'C');
            $pdf->Cell(10	,5,$row['total'],1,0,'C');
            $pdf->Cell(10	,5,$row['sisa'],1,0,'C');
        }

        if($row['state'] == 'dotsu' && $whileProduksi['id_produksi'] == $row['produksi_id']){
            $pdf->Cell(10	,5,$row['day'],1,0,'C');
            $pdf->Cell(10	,5,$row['total'],1,0,'C');
            $pdf->Cell(10	,5,$row['sisa'],1,0,'C');
        }

        if($row['state'] == 'gaikan1' && $whileProduksi['id_produksi'] == $row['produksi_id']){
            $pdf->Cell(10	,5,$row['day'],1,0,'C');
            $pdf->Cell(10	,5,$row['total'],1,0,'C');
            $pdf->Cell(10	,5,$row['sisa'],1,0,'C');
        }

        if($row['state'] == 'gaikan2' && $whileProduksi['id_produksi'] == $row['produksi_id']){
            $pdf->Cell(10	,5,$row['day'],1,0,'C');
            $pdf->Cell(10	,5,$row['total'],1,0,'C');
            $pdf->Cell(10	,5,$row['sisa'],1,0,'C');
        }

        if($row['state'] == 'packing' && $whileProduksi['id_produksi'] == $row['produksi_id']){
            $pdf->Cell(10	,5,$row['day'],1,0,'C');
            $pdf->Cell(10	,5,$row['total'],1,0,'C');
            $pdf->Cell(10	,5,$row['sisa'],1,1,'C');
        }

    }
}
// $pdf->Cell(90	,5,'QC',1,0,'C');
// $pdf->Cell(30	,5,'Packing',1,0,'C');

$pdf->SetFont('Arial','B',10);
// total
$pdf->Cell(190	,5,'TOTAL',1,0,'C');
$getSum = "SELECT 
SUM(CASE WHEN tb_state.state='kabel' THEN tb_state.day END) as kabel_day,
SUM(CASE WHEN tb_state.state='kabel' THEN tb_state.total END) as kabel_total,
SUM(CASE WHEN tb_state.state='kabel' THEN tb_state.sisa END) as kabel_sisa,

SUM(CASE WHEN tb_state.state='tape' THEN tb_state.day END) as tape_day,
SUM(CASE WHEN tb_state.state='tape' THEN tb_state.total END) as tape_total,
SUM(CASE WHEN tb_state.state='tape' THEN tb_state.sisa END) as tape_sisa,

SUM(CASE WHEN tb_state.state='korget' THEN tb_state.day END) as korget_day,
SUM(CASE WHEN tb_state.state='korget' THEN tb_state.total END) as korget_total,
SUM(CASE WHEN tb_state.state='korget' THEN tb_state.sisa END) as korget_sisa,

SUM(CASE WHEN tb_state.state='dotsu' THEN tb_state.day END) as dotsu_day,
SUM(CASE WHEN tb_state.state='dotsu' THEN tb_state.total END) as dotsu_total,
SUM(CASE WHEN tb_state.state='dotsu' THEN tb_state.sisa END) as dotsu_sisa,

SUM(CASE WHEN tb_state.state='gaikan1' THEN tb_state.day END) as gaikan1_day,
SUM(CASE WHEN tb_state.state='gaikan1' THEN tb_state.total END) as gaikan1_total,
SUM(CASE WHEN tb_state.state='gaikan1' THEN tb_state.sisa END) as gaikan1_sisa,

SUM(CASE WHEN tb_state.state='gaikan2' THEN tb_state.day END) as gaikan2_day,
SUM(CASE WHEN tb_state.state='gaikan2' THEN tb_state.total END) as gaikan2_total,
SUM(CASE WHEN tb_state.state='gaikan2' THEN tb_state.sisa END) as gaikan2_sisa,

SUM(CASE WHEN tb_state.state='packing' THEN tb_state.day END) as packing_day,
SUM(CASE WHEN tb_state.state='packing' THEN tb_state.total END) as packing_total,
SUM(CASE WHEN tb_state.state='packing' THEN tb_state.sisa END) as packing_sisa


FROM tb_state
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
$query
";
$exeSum=$conn->query($getSum);
$rowSum = $exeSum->fetch_assoc();

$pdf->Cell(10	,5,$rowSum['kabel_day'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['kabel_total'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['kabel_sisa'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['tape_day'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['tape_total'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['tape_sisa'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['korget_day'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['korget_total'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['korget_sisa'],1,0,'C');

$pdf->Cell(10	,5,$rowSum['dotsu_day'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['dotsu_total'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['dotsu_sisa'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['gaikan1_day'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['gaikan1_total'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['gaikan1_sisa'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['gaikan2_day'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['gaikan2_total'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['gaikan2_sisa'],1,0,'C');

$pdf->Cell(10	,5,$rowSum['packing_day'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['packing_total'],1,0,'C');
$pdf->Cell(10	,5,$rowSum['packing_sisa'],1,1,'C');


// $pdf->Cell(400	,5,$sql,1,0,'C');

$pdf->Output("master_.pdf","I");

?>
