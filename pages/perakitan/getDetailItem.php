<?php
include "../../config/db.php";
$id_item = $_POST['val'];
$sql = "SELECT * FROM tb_item
where id = '$id_item'
";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$data = [
    'item_name' => $row['item_name'],
    'jumlah_kabel' => $row['jumlah_kabel']
];

echo json_encode($data);
?>