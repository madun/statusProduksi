<?php
    include "../../config/db.php";
    $sql = "SELECT tb_state.*, tb_produksi.*, 
    MAX(CASE WHEN tb_state.state = 'kabel' THEN tb_state.sisa END) as kabel_sisa,
    MAX(CASE WHEN tb_state.state = 'tape' THEN tb_state.sisa END) as korget_sisa
    FROM tb_produksi
    LEFT JOIN tb_state ON tb_state.produksi_id = tb_produksi.id";
    $exeGetGaikan2=$conn->query($sql);
    
    while($row = $exeGetGaikan2->fetch_assoc()){
        echo $row['kabel_sisa'].'<br>';
    }
?>