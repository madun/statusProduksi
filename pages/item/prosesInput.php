<?php
include "../../config/db.php";
$item_name=$_POST['item_name'];
$jumlah_kabel=$_POST['jumlah_kabel'];
$tanggal = date('Y-m-d');

$query="insert into tb_item values('','$item_name','$jumlah_kabel','$tanggal','')";
$exe=$conn->query($query);


if($exe){
    header("Location:../../index.php?page=item&status=success");
}


?>
