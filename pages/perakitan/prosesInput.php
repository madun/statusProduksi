<?php
include "../../config/db.php";
$item_id=$_POST['item_id'];
$kode_produksi=$_POST['kode_produksi'];
$jumlah= substr($kode_produksi, strpos($kode_produksi, "-") + 1);
$jumlah_kabel=$_POST['jumlah_kabel'];
$kabel=$_POST['kabel'];
$full_tape=($_POST['full_tape'] == '') ? 0 : $_POST['full_tape'];
$korget=($_POST['korget'] == '') ? 0 : $_POST['korget'];
$tanggal = date('Y-m-d');

$query="insert into tb_produksi values('','$item_id','$kode_produksi','$jumlah','$tanggal')";
$exe=$conn->query($query);
$produksi_id = $conn->insert_id;

$yesterday = date ("Y-m-d", strtotime("-1 day"));
// get kabel total kemarin
$getKabel = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$yesterday'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='kabel'
";
$exeGetKabel=$conn->query($getKabel);
$rowKabel = $exeGetKabel->fetch_assoc();
$totalKabel = $_POST['kabel'];
if ($rowKabel > 0) {
    $totalKabel += $rowKabel['day'];
}
$sisaKabel = $jumlah - $totalKabel;
// end get kabel total kemarin

// get tape total kemarin
$getTape = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$yesterday'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='tape'
";
$exeGetTape=$conn->query($getTape);
$rowTape = $exeGetTape->fetch_assoc();
$totalTape = $_POST['full_tape'];
if ($rowTape > 0) {
    $totalTape += $rowTape['day'];
}
$sisaTape = $totalKabel - $totalTape;
// end get tape total kemarin

// get korget total kemarin
$getKorget = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$yesterday'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='korget'
";
$exeGetKorget=$conn->query($getKorget);
$rowKorget = $exeGetKorget->fetch_assoc();
$totalKorget = $_POST['korget'];
if ($rowKorget > 0) {
    $totalKorget += $rowKorget['day'];
}
$sisaKorget = $totalTape - $totalKorget;
// end get korget total kemarin

// insert Perakitan
$query1 = "INSERT into tb_state values
            ('','$produksi_id','$kabel','$totalKabel','$sisaKabel','kabel','$tanggal'),
            ('','$produksi_id','$full_tape','$totalTape','$sisaTape','tape','$tanggal'),
            ('','$produksi_id','$korget','$totalKorget','$sisaKorget','korget','$tanggal'),

            ('','$produksi_id','0','0','0','dotsu','$tanggal'),
            ('','$produksi_id','0','0','0','gaikan1','$tanggal'),
            ('','$produksi_id','0','0','0','gaikan2','$tanggal'),

            ('','$produksi_id','0','0','0','packing','$tanggal')
";
$exePerakitan=$conn->query($query1);

if($exePerakitan){
    header("Location:../../index.php?page=perakitan&status=success");
}


?>
