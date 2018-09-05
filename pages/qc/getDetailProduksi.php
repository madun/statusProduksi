<?php
include "../../config/db.php";
$id_item = $_POST['val'];
$tanggal = date('Y-m-d');
$sql = "SELECT tb_item.*, tb_produksi.*, tb_produksi.id as produksi_id FROM tb_produksi
LEFT JOIN tb_item ON tb_item.id = tb_produksi.item_id
-- where tb_produksi.tanggal = '$tanggal'
AND tb_produksi.item_id = '$id_item'
";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$data = [
    'produksi_id' => $row['produksi_id'],
    'kode_produksi' => $row['kode_produksi'],
    'jumlah_kabel' => $row['jumlah_kabel']
];

echo json_encode($data);
?>