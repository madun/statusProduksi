<?php
include "../../config/db.php";
$produksi_id = $_POST['produksi_id'];
$item_id=$_POST['item_id'];
$dotsu=$_POST['dotsu'];
$gaikan1=$_POST['gaikan1'];
$gaikan2=$_POST['gaikan2'];
$tanggal = date('Y-m-d');

$yesterday = date ("Y-m-d", strtotime("-1 day"));
//get last total korget hari ini
$getKorget = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$tanggal'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='korget'
";
$exeGetKorget=$conn->query($getKorget);
$rowKorget = $exeGetKorget->fetch_assoc();
$totalKorget = $rowKorget['total'];
//end get last total korget hari ini

// get kabel total kemarin
$getDotsu = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$yesterday'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='dotsu'
";
$exeGetDotsu=$conn->query($getDotsu);
$rowDotsu = $exeGetDotsu->fetch_assoc();
$totalDotsu = $_POST['dotsu'];
if ($rowDotsu > 0) {
    $totalDotsu += $rowDotsu['day'];
}
$sisaDotsu = $totalKorget - $totalDotsu;
// end get kabel total kemarin

// get gaikan1 total kemarin
$getGaikan1 = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$yesterday'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='gaikan1'
";
$exeGetGaikan1=$conn->query($getGaikan1);
$rowGaikan1 = $exeGetGaikan1->fetch_assoc();
$totalGaikan1 = $_POST['gaikan1'];
if ($rowGaikan1 > 0) {
    $totalGaikan1 += $rowGaikan1['day'];
}
$sisaGaikan1 = $totalDotsu - $totalGaikan1;
// end get gaikan1 total kemarin

// get gaikan2 total kemarin
$getGaikan2 = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$yesterday'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='gaikan2'
";
$exeGetGaikan2=$conn->query($getGaikan2);
$rowGaikan2 = $exeGetGaikan2->fetch_assoc();
$totalGaikan2 = $_POST['gaikan2'];
if ($rowGaikan2 > 0) {
    $totalGaikan2 += $rowGaikan2['day'];
}
$sisaGaikan2 = $totalGaikan1 - $totalGaikan2;
// end get gaikan2 total kemarin

// insert Perakitan
// $query1 = "INSERT into tb_state values
//             ('','$produksi_id','$dotsu','$totalDotsu','$sisaDotsu','dotsu','$tanggal'),
//             ('','$produksi_id','$gaikan1','$totalGaikan1','$sisaGaikan1','gaikan1','$tanggal'),
//             ('','$produksi_id','$gaikan2','$totalGaikan2','$sisaGaikan2','gaikan2','$tanggal')
// ";

$query1 = "UPDATE tb_state
SET day='$dotsu', total='$totalDotsu', sisa='$sisaDotsu', tanggal='$tanggal'
WHERE produksi_id='$produksi_id' AND state='dotsu' ";
$exeQc1=$conn->query($query1);

$query2 = "UPDATE tb_state
SET day='$gaikan1', total='$totalGaikan1', sisa='$sisaGaikan1', tanggal='$tanggal'
WHERE produksi_id='$produksi_id' AND state='gaikan1' ";
$exeQc2=$conn->query($query2);

$query3 = "UPDATE tb_state
SET day='$gaikan2', total='$totalGaikan2', sisa='$sisaGaikan2', tanggal='$tanggal'
WHERE produksi_id='$produksi_id' AND state='gaikan2' ";
$exeQc3=$conn->query($query3);

if($exeQc3){
    header("Location:../../index.php?page=qc&status=success");
}


?>
