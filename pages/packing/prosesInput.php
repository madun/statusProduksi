<?php
include "../../config/db.php";
$produksi_id = $_POST['produksi_id'];
$item_id=$_POST['item_id'];
$packing=$_POST['packing'];
$tanggal = date('Y-m-d');

$yesterday = date ("Y-m-d", strtotime("-1 day"));
//get last total Gaikan2 hari ini
$getGaikan2 = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$tanggal'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='gaikan2'
";
$exeGetGaikan2=$conn->query($getGaikan2);
$rowGaikan2 = $exeGetGaikan2->fetch_assoc();
$totalGaikan2 = $rowGaikan2['total'];
//end get last total Gaikan2 hari ini

// get kabel total kemarin
$getPacking = "SELECT tb_state.*, tb_produksi.* FROM tb_state 
LEFT JOIN tb_produksi ON tb_produksi.id = tb_state.produksi_id
where tb_state.tanggal='$yesterday'
AND tb_produksi.item_id='$item_id'
AND tb_state.state='packing'
";
$exeGetPacking=$conn->query($getPacking);
$rowPacking = $exeGetPacking->fetch_assoc();
$totalPacking = $_POST['packing'];
if ($rowPacking > 0) {
    $totalPacking += $rowPacking['day'];
}
$sisaPacking = $totalGaikan2 - $totalPacking;
// end get kabel total kemarin

// insert Perakitan
// $query1 = "INSERT into tb_state values
//             ('','$produksi_id','$packing','$totalPacking','$sisaPacking','packing','$tanggal')
// ";
$query1 = "UPDATE tb_state
SET day='$packing', total='$totalPacking', sisa='$sisaPacking', tanggal='$tanggal'
WHERE produksi_id='$produksi_id' AND state='packing' ";
$exeQc=$conn->query($query1);

if($exeQc){
    header("Location:../../index.php?page=packing&status=success");
}


?>
