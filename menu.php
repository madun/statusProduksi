
<?php
if(isset($_GET['page'])){
    $page = '';
    $page = $_GET['page'];
} else {
    $page = 'dashboard';
}
?>

<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                    <li class="nav-item">
                        <a href="?page=dashboard" class="nav-link <?php if($page == 'dashboard'){echo 'active';} ?>"><i class="fe fe-pie-chart"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=item" class="nav-link <?php if($page == 'item'){echo 'active';} ?>"><i class="fe fe-database"></i> Item</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=perakitan" class="nav-link <?php if($page == 'perakitan'){echo 'active';} ?>"><i class="fe fe-layers"></i> Perakitan</a>
                    </li>
                    <li class="nav-item">
                    <a href="?page=qc" class="nav-link <?php if($page == 'qc'){echo 'active';} ?>" ><i class="fe fe-award"></i> Quality Control</a>
                    </li>
                    <li class="nav-item">
                    <a href="?page=packing" class="nav-link <?php if($page == 'packing'){echo 'active';} ?>"><i class="fe fe-package"></i> Packing</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>