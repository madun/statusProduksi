<?php
include "../../config/db.php";
$id_item = $_POST['val'];
$yesterday = date ("Y-m-d", strtotime("-1 day"));
$sql = "SELECT * FROM tb_item
LEFT JOIN tb_produksi on tb_produksi.item_id = tb_item.id
LEFT JOIN tb_state on tb_state.produksi_id = tb_produksi.id
where tb_item.id = '$id_item'
AND tb_produksi.tanggal = '$yesterday'
";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if($row['id'] == null){
    $sql = "SELECT * FROM tb_item
    LEFT JOIN tb_produksi on tb_produksi.item_id = tb_item.id
    LEFT JOIN tb_state on tb_state.produksi_id = tb_produksi.id
    where tb_item.id = '$id_item'
    ";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

$dayKabel = '';
$dayTape = '';
$dayKorget = '';
while($day = $result->fetch_assoc()){

    if($day['state'] == 'kabel'){
        $dayKabel = $day['day'];
    }
    if($day['state'] == 'tape'){
        $dayTape = $day['day'];
    }
    if($day['state'] == 'korget'){
        $dayKorget = $day['day'];
    }
}
$data = [
    'kode_produksi' => $row['kode_produksi'],
    'dayKabel' => $dayKabel,
    'dayTape' => $dayTape,
    'dayKorget' => $dayKorget,
    'item_name' => $row['item_name'],
    'jumlah_kabel' => $row['jumlah_kabel']
];

echo json_encode($data);
// echo $sql;
?>