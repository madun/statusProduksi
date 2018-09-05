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
            Input Perakitan
        </h1>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <form method="post" action="pages/perakitan/prosesInput.php">
                    <div class="card-body">
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
                            <select name="item_id" id="select-beast" class="form-control custom-select" onchange="getDetailItem(this.value)" required>
                                <option value="">-- Select Item --</option>
                                <?php
                                    include "config/db.php";
                                    $sql = "SELECT * FROM tb_item";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        // output data of each row
                                        while($row = $result->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['item_name'] ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kode Produksi</label>
                            <input type="text" name="kode_produksi" class="form-control" placeholder="Kode Produksi" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Kabel</label>
                            <input type="text" name="jumlah_kabel" class="form-control" placeholder="Jumlah Kabel" readonly required>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label">Kemarin</label>
                                    <input type="text" name="kabelKemarin" class="form-control" placeholder="0" readonly>
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label">Pasang Kabel</label>
                                    <input type="text" name="kabel" class="form-control" placeholder="Kabel" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label">Kemarin</label>
                                    <input type="text" name="tapeKemarin" class="form-control" placeholder="0" readonly>
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label">Full Tape</label>
                                    <input type="text" name="full_tape" class="form-control" placeholder="Kabel" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="form-label">Kemarin</label>
                                    <input type="text" name="korgetKemarin" class="form-control" placeholder="0" readonly>
                                </div>
                                <div class="col-md-10">
                                    <label class="form-label">Korget</label>
                                    <input type="text" name="korget" class="form-control" placeholder="Kabel" required>
                                </div>
                            </div>
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
    function getDetailItem(val){
        $.ajax({
            url: 'pages/perakitan/getDetailItem.php',
            type: 'POST',
            data: {
                val: val
            },
            success: function(data){
                console.log(data);
                var toJson = JSON.parse(data);
                console.log(toJson);
                $('[name=kode_produksi]').val("");
                $('[name=kabelKemarin]').val("");
                $('[name=jumlah_kabel]').val("");
                $('[name=kode_produksi]').val(toJson.kode_produksi);
                $('[name=kabelKemarin]').val(toJson.dayKabel);
                $('[name=tapeKemarin]').val(toJson.dayTape);
                $('[name=korgetKemarin]').val(toJson.dayKorget);
                $('[name=jumlah_kabel]').val(toJson.jumlah_kabel);
            }
        });
    }
require(['jquery', 'selectize'], function ($, selectize) {
    $(document).ready(function () {

        $('#select-beast').selectize({});

    });
});
</script>