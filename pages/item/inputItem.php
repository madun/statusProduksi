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
            Input Item
        </h1>
    </div>
    <div class="row">
        <div class="col-lg-9">
            <div class="card">
                <form method="post" action="pages/item/prosesInput.php">
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
                            <label class="form-label">Item Name</label>
                            <input type="text" name="item_name" class="form-control" placeholder="Item Name" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jumlah Kabel</label>
                            <input type="text" name="jumlah_kabel" class="form-control" placeholder="Jumlah Kabel" required>
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
</script>