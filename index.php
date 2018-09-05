<?php 
	session_start();
if($_SESSION['status']!="login"){
  header("location:login.php?pesan=belum_login");
}
?>
<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Wulan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <script>
        // requirejs.config({
        //     baseUrl: '.'
        // });
        </script>
    <!-- Dashboard Core -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
    <!-- c3.js Charts Plugin -->
    <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/charts-c3/plugin.js"></script>
    <!-- Google Maps Plugin -->
    <link href="./assets/plugins/maps-google/plugin.css" rel="stylesheet" />
    <script src="./assets/plugins/maps-google/plugin.js"></script>
    <!-- Input Mask Plugin -->
    <script src="./assets/plugins/input-mask/plugin.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>

    <style>
    .footer{
        bottom: 0;
        position: fixed;
        left: 0;
        width: 100%;
    }
    </style>
    
  </head>
  <body class="">
    <div class="page">
      <div class="page-main">
        <div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./index.html">
                <!-- <img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo"> -->
                logo
              </a>
              <div class="d-flex order-lg-2 ml-auto">
                <div class="nav-item d-none d-md-flex">
                    <span class="text-default"><b>Hallo, <?php echo $_SESSION['username']; ?></b></span>
                </div>
                <div class="nav-item d-none d-md-flex">
                    <a href="logout.php" class="btn btn-info">
                        <i class="fe fe-log-out mr-2"></i>
                        Sign out
                    </a>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>

        <?php 
            include "menu.php";
        ?>

        <!-- content -->
        <div class="my-3 my-md-5">
            <?php
                if(isset($_GET['page'])){
                $page = $_GET['page'];

                    switch ($page) {
                        case 'login':
                            include "login.php";
                        break;

                        case 'dashboard':
                            include "pages/master/index.php";
                        break;

                        case 'item':
                            include "pages/item/inputItem.php";
                        break;

                        case 'perakitan':
                            include "pages/perakitan/inputPerakitan.php";
                        break;

                        case 'packing':
                            include "pages/packing/inputPacking.php";
                        break;

                        case 'qc':
                            include "pages/qc/inputQc.php";
                        break;

                        default:
                            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                        break;
                    }

                }else{
                    include "pages/master/index.php";
                }

            ?>
        </div>  


      </div>
      <footer class="footer">
        <div class="container">
          <div class="row align-items-center flex-row-reverse">
            <div class="col-auto ml-lg-auto">
              <div class="row align-items-center">
                <div class="col-auto">
                  <ul class="list-inline list-inline-dots mb-0">
                    <!-- <li class="list-inline-item"><a href="./docs/index.html">Documentation</a></li>
                    <li class="list-inline-item"><a href="./faq.html">FAQ</a></li> -->
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0 text-center">
              Copyright © iTech All rights reserved.
            </div>
          </div>
        </div>
      </footer>
    </div>
  </body>
</html>