<?php 
if($_SESSION['status']!="login"){
  header("location:login.php?pesan=belum_login");
}
?>
<style>
.page-header{
    display: block;
}
th{
    vertical-align: middle !important;
}
</style>

<div class="container">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6">
                <h1 class="page-title">
                Dashboard
                <small>
                    <?php
                        if(isset($_POST['item']) && $_POST['item'] != null){
                            include "config/db.php";
                            $getNameItem = "SELECT * FROM tb_item where id='".$_POST['item']."'";
                            $exeGetNameItem = $conn->query($getNameItem);
                            $rowItem = $exeGetNameItem->fetch_assoc();
                            echo ', Item : <b>'.$rowItem['item_name'].'</b>';
                        }
                    ?>
                <?php
                    if(isset($_POST['tanggal'])){
                        $date = date('d-m-Y');
                        if($_POST['tanggal'] == ''){
                            echo "Semua Tanggal";
                        }else if(date("d-m-Y", strtotime($_POST['tanggal'])) == $date){
                            echo "Hari Ini";
                        }else{
                            echo 'Tanggal : <b>'.date("d-m-Y", strtotime($_POST['tanggal'])).'</b>';
                        }
                    }
                ?>
                </small>
                </h1>
            </div>
            <div class="col-md-6">

                <span class="pull-right ml-3">
                    <a href="pages/master/print.php?<?php if(isset($_POST['tanggal'])){echo 'tanggal='.date('Y-m-d', strtotime($_POST['tanggal']));} ?><?php if(isset($_POST['item'])){echo 'item='.$_POST['item'];} ?>" 
                    class="btn btn-success" target="_blank"> <span class="fa fa-print"></span>&nbsp;PRINT</a>
                </span>
                <form id="myform" action="index.php?page=dashboard" method="post">

                    <span class="pull-right">
                        <select name="item" id="item" class="form-control">
                            <option value="">-- Pilih Item --</option>
                            <?php
                                // ambil data dari table perakitan
                                include "config/db.php";
                                $tanggal = date('Y-m-d');
                                $sql = "SELECT tb_item.*, tb_produksi.* FROM tb_produksi
                                LEFT JOIN tb_item ON tb_item.id = tb_produksi.item_id
                                where tb_produksi.tanggal = '".$_POST['tanggal']."'
                                ";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // output data of each row
                                    while($row = $result->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $row['item_id'] ?>" <?php if(isset($_POST['item']) == $row['item_id'] && $_POST['item'] != null){ echo "selected";} ?>><?php echo $row['item_name'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </span>
                    <span class="pull-right mr-3">
                        <select name="tanggal" id="tanggal" class="form-control">  
                            <?php
                            // Start date
                            $date = date('d-m-Y');
                            ?>
                            <option value="" <?php if(isset($_POST['tanggal']) && $_POST['tanggal'] == '') echo "selected"?>>All</option>    
                            <option value="<?php echo date ("Y-m-d", strtotime($date)); ?>" <?php if(isset($_POST['tanggal']) && $_POST['tanggal'] == date ("Y-m-d", strtotime($date))) echo "selected"?>>Hari Ini</option>
                            <?php
                            // End date
                            $end_date = date('d-m-Y', strtotime('-5 day'));
                            while (strtotime($date) >= strtotime($end_date)) {
                                $date = date ("d-m-Y", strtotime("-1 day", strtotime($date)));
                            ?>
                            <option value="<?php echo date ("Y-m-d", strtotime($date)); ?>" <?php if(isset($_POST['tanggal']) && $_POST['tanggal'] == date ("Y-m-d", strtotime($date))) echo "selected"?>><?php echo $date; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </span>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-center">
                    <span>Status Produksi</span>
                </div>
                <div class="card-body" style="overflow-x:auto;">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="3" class="text-center" nowrap><b>No</b></th>
                            <th rowspan="3" class="text-center" nowrap><b>Buyer</b></th>
                            <th rowspan="3" class="text-center" nowrap style="width:200px"><b>Item</b></th>
                            <th rowspan="3" class="text-center" nowrap><b>Jumlah</b> Kabel</th>
                            <th rowspan="3" class="text-center" nowrap><b>Kode</b> Produksi</th>
                            <th rowspan="3" class="text-center" nowrap><b>Jumlah</b></th>
                            <th rowspan="3" class="text-center" nowrap style="width:100px"><b>Tanggal</b></th>
                            <th colspan="9" class="text-center"><b>Perakitan</b></th>
                            <th colspan="9" class="text-center"><b>QC</b></th>
                            <!-- packing -->
                            <th colspan="3" rowspan="2" class="text-center"><b>Packing</b></th>
                        </tr>
                        <tr>
                            <!-- perakitan -->
                            <th colspan="3" class="text-center"><b>Pasang Kabel</b></th>
                            <th colspan="3" class="text-center"><b>Tape</b></th>
                            <th colspan="3" class="text-center"><b>Korget</b></th>

                            <!-- qc -->
                            <th colspan="3" class="text-center"><b>Dotsu</b></th>
                            <th colspan="3" class="text-center"><b>Gaikan</b> 1</th>
                            <th colspan="3" class="text-center"><b>Gaikan</b> 2</th>

                        </tr>
                        <tr>
                            <!-- perakitan -->
                            <th class="text-center">/day</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Sisa</th>

                            <th class="text-center">/day</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Sisa</th>

                            <th class="text-center">/day</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Sisa</th>

                            <!-- QC -->
                            <th class="text-center">/day</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Sisa</th>

                            <th class="text-center">/day</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Sisa</th>

                            <th class="text-center">/day</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Sisa</th>

                            <!-- Packing -->
                            <th class="text-center">/day</th>
                            <th class="text-center">Total</th>
                            <th class="text-center">Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $query = '';
                        if(isset($_POST['item']) && $_POST['item'] != null){
                            $query = "WHERE tb_produksi.item_id ='".$_POST['item']."' ";
                        }else if(isset($_POST['tanggal']) && $_POST['tanggal'] != null){
                            $query = "WHERE tb_produksi.tanggal ='".$_POST['tanggal']."' ";
                        }else if(isset($_POST['tanggal']) && $_POST['tanggal'] != null && isset($_POST['item']) && $_POST['item'] != null){
                            $query = "WHERE tb_produksi.item_id ='".$_POST['item']."' 
                                AND tb_produksi.tanggal ='".$_POST['tanggal']."'
                            ";
                        }
                        include "config/db.php";
                        $sql = "SELECT tb_produksi.*, tb_item.*, 
                        tb_item.tanggal as tanggal_item, 
                        tb_produksi.tanggal as tanggal_produksi, 
                        tb_produksi.id as id_produksi
                        FROM tb_produksi
                        LEFT JOIN tb_item ON tb_item.id = tb_produksi.item_id
                        $query
                        ";
                        $exeProduksi=$conn->query($sql);
                        $i=1;
                        while($whileProduksi = $exeProduksi->fetch_assoc()){
                    ?>
                        <tr>
                            
                            <td class="text-center"><?php echo $i++ ?></td>
                            <td class="text-center"></td>
                            <td class="text-center"><b><?php echo $whileProduksi['item_name'] ?></b></td>
                            <td class="text-center"><?php echo $whileProduksi['jumlah_kabel'] ?></td>
                            <td class="text-center"><?php echo $whileProduksi['kode_produksi'] ?></td>
                            <td class="text-center"><?php echo $whileProduksi['jumlah'] ?></td>
                            <td class="text-center"><?php echo date('d-m-Y', strtotime($whileProduksi['tanggal_produksi'])) ?></td>
                            <?php 
                                $sql = "SELECT tb_state.*, tb_produksi.*
                                FROM tb_produksi
                                LEFT JOIN tb_state ON tb_state.produksi_id = tb_produksi.id
                                $query
                                ";
                                $exeGet=$conn->query($sql);
                                
                                while($row = $exeGet->fetch_assoc()){
                            ?>
                                <?php
                                    if($row['state'] == 'kabel' && $whileProduksi['id_produksi'] == $row['produksi_id']){
                                ?>
                            <td class="text-center"><?php echo $row['day'] ?></td>
                            <td class="text-center"><?php echo $row['total'] ?></td>
                            <td class="text-center"><?php echo $row['sisa'] ?></td>
                                <?php
                                    }
                                ?>

                                <?php
                                    if($row['state'] == 'tape' && $whileProduksi['id_produksi'] == $row['produksi_id']){
                                ?>
                            <td class="text-center"><?php echo $row['day'] ?></td>
                            <td class="text-center"><?php echo $row['total'] ?></td>
                            <td class="text-center"><?php echo $row['sisa'] ?></td>
                                <?php
                                    }
                                ?>

                                <?php
                                    if($row['state'] == 'korget' && $whileProduksi['id_produksi'] == $row['produksi_id']){
                                ?>
                            <td class="text-center"><?php echo $row['day'] ?></td>
                            <td class="text-center"><?php echo $row['total'] ?></td>
                            <td class="text-center"><?php echo $row['sisa'] ?></td>
                                <?php
                                    }
                                ?>

                                <?php
                                    if($row['state'] == 'dotsu' && $whileProduksi['id_produksi'] == $row['produksi_id']){
                                ?>
                            <td class="text-center"><?php echo $row['day'] ?></td>
                            <td class="text-center"><?php echo $row['total'] ?></td>
                            <td class="text-center"><?php echo $row['sisa'] ?></td>
                                <?php
                                    }
                                ?>

                                <?php
                                    if($row['state'] == 'gaikan1' && $whileProduksi['id_produksi'] == $row['produksi_id']){
                                ?>
                            <td class="text-center"><?php echo $row['day'] ?></td>
                            <td class="text-center"><?php echo $row['total'] ?></td>
                            <td class="text-center"><?php echo $row['sisa'] ?></td>
                                <?php
                                    }
                                ?>

                                <?php
                                    if($row['state'] == 'gaikan2' && $whileProduksi['id_produksi'] == $row['produksi_id']){
                                ?>
                            <td class="text-center"><?php echo $row['day'] ?></td>
                            <td class="text-center"><?php echo $row['total'] ?></td>
                            <td class="text-center"><?php echo $row['sisa'] ?></td>
                                <?php
                                    }
                                ?>

                                <?php
                                    if($row['state'] == 'packing' && $whileProduksi['id_produksi'] == $row['produksi_id']){
                                ?>
                            <td class="text-center"><?php echo $row['day'] ?></td>
                            <td class="text-center"><?php echo $row['total'] ?></td>
                            <td class="text-center"><?php echo $row['sisa'] ?></td>
                                <?php
                                    }
                                ?>
                            <?php 
                                }
                            ?>
                        </tr>
                    <?php
                        }
                    ?>
                        <!-- </tr> -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="7" class="text-center"><b>TOTAL</b></td>
                            <?php
                                include "config/db.php";
                                $query = '';
                                if(isset($_POST['item']) && $_POST['item'] != null){
                                    $query = "WHERE tb_produksi.item_id ='".$_POST['item']."' ";
                                }else if(isset($_POST['tanggal']) && $_POST['tanggal'] != null){
                                    $query = "WHERE tb_produksi.tanggal ='".$_POST['tanggal']."' ";
                                }else if(isset($_POST['tanggal']) && $_POST['tanggal'] != null && isset($_POST['item']) && $_POST['item'] != null){
                                    $query = "WHERE tb_produksi.item_id ='".$_POST['item']."' 
                                        AND tb_produksi.tanggal ='".$_POST['tanggal']."'
                                    ";
                                }
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
                            ?>
                            <td class="text-center"><b><?php echo $rowSum['kabel_day'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['kabel_total'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['kabel_sisa'] ?></b></td>

                            <td class="text-center"><b><?php echo $rowSum['tape_day'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['tape_total'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['tape_sisa'] ?></b></td>

                            <td class="text-center"><b><?php echo $rowSum['korget_day'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['korget_total'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['korget_sisa'] ?></b></td>

                            <td class="text-center"><b><?php echo $rowSum['dotsu_day'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['dotsu_total'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['dotsu_sisa'] ?></b></td>

                            <td class="text-center"><b><?php echo $rowSum['gaikan1_day'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['gaikan1_total'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['gaikan1_sisa'] ?></b></td>

                            <td class="text-center"><b><?php echo $rowSum['gaikan2_day'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['gaikan2_total'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['gaikan2_sisa'] ?></b></td>

                            <td class="text-center"><b><?php echo $rowSum['packing_day'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['packing_total'] ?></b></td>
                            <td class="text-center"><b><?php echo $rowSum['packing_sisa'] ?></b></td>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $("#tanggal").on('change', function(e){
        var data = this.value;
        myform.submit();
    });

    $("#item").on('change', function(e){
        var data = this.value;
        myform.submit();
    });
    
</script>
