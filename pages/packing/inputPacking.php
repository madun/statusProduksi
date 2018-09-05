<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script> -->
<?php 
if($_SESSION['status']!="login"){
  header("location:login.php?pesan=belum_login");
}
?>
<div class="container">
    <div class="page-header">
        <h1 class="page-title">
            Input Packing
        </h1>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <form method="post" action="pages/packing/prosesInput.php">
                    <div class="card-body">
                        <input type="hidden" name="produksi_id">
                        <?php
                            if(isset($_GET['status']) == 'success'){
                        ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"></button>
                            Data Sukses di Tambahkan!
                        </div>
                        <?php
                            }
                        ?>
                        <div class="form-group">
                            <label class="form-label">Item</label>
                            <select name="item_id" id="select-beast" class="form-control custom-select" onchange="getDetailProduksi(this.value)"  required>
                                <option value="">-- Select Item --</option>
                                <?php
                                    // ambil data dari table perakitan
                                    include "config/db.php";
                                    $tanggal = date('Y-m-d');
                                    $sql = "SELECT tb_item.*, tb_produksi.* FROM tb_produksi
                                    LEFT JOIN tb_item ON tb_item.id = tb_produksi.item_id
                                    LEFT JOIN tb_state ON tb_state.produksi_id = tb_produksi.id
                                    where tb_state.day = 0
                                    ";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['item_id'] ?>"><?php echo $row['item_name'] ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kode Produksi</label>
                            <input type="text" name="kode_produksi" class="form-control" placeholder="Kode Produksi" readonly required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Kabel</label>
                            <input type="text" name="jumlah_kabel" class="form-control" placeholder="Jumlah Kabel" readonly required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="form-label">Packing</label>
                            <input type="text" name="packing" class="form-control" placeholder="Jumlah Yang Akan Dipacking" required>
                        </div>
                    </div> <!-- card body -->
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function getDetailProduksi(val){
    // console.log(val);
    $.ajax({
        url: 'pages/qc/getDetailProduksi.php',
        type: 'POST',
        data: {
            val: val,
        },
        success: function(data){
            var toJson = JSON.parse(data);
            $('[name=produksi_id]').val("");
            $('[name=kode_produksi]').val("");
            $('[name=jumlah_kabel]').val("")
            $('[name=produksi_id]').val(toJson.produksi_id);
            $('[name=kode_produksi]').val(toJson.kode_produksi);
            $('[name=jumlah_kabel]').val(toJson.jumlah_kabel);
        }
    });
}
require(['jquery', 'selectize'], function ($, selectize) {
    $(document).ready(function () {

        $('#select-beast').selectize();
        
    });


});
</script>