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
    <link rel="icon" href="./favicon.ico" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Login</title>
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
  </head>
  <body class="">
    <div class="page">
      <div class="page-single">
        <div class="container">
          <div class="row">
            <div class="col col-login mx-auto">
              <div class="text-center mb-6">
                <!-- <img src="./demo/brand/tabler.svg" class="h-6" alt=""> -->
              <h3>Login</h3>
              </div>
              <form class="card" action="cek_login.php" method="post">
                <div class="card-body p-6">

                  <?php 
                  if(isset($_GET['pesan'])){
                    if($_GET['pesan'] == "gagal"){
                  ?>
                  <center>
                    <div class="card-title text-danger">Login gagal! username atau password salah!</div>
                  </center>
                  <?php
                    }else if($_GET['pesan'] == "logout"){
                  ?>
                  <center>
                    <div class="card-title text-success">Anda telah berhasil logout</div>
                  </center>
                  <?php
                    }else if($_GET['pesan'] == "belum_login"){
                  ?>
                  <center>
                    <div class="card-title text-danger">Anda Harus Login Untuk Mengakses Halaman Admin!</div>
                  </center>
                  <?php
                    }
                  ?>
                  <br>
                  <?php
                  }
                  ?>
                  
                  <div class="form-group">
                    <label class="form-label">Usernmae</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="Enter Username">
                  </div>
                  <div class="form-group">
                    <label class="form-label">
                      Password
                      <!-- <a href="./forgot-password.html" class="float-right small">I forgot password</a> -->
                    </label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                  </div>
                  <!-- <div class="form-group">
                    <label class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input" />
                      <span class="custom-control-label">Remember me</span>
                    </label>
                  </div> -->
                  <div class="form-footer">
                    <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                  </div>
                </div>
              </form>
              <div class="text-center text-muted">
                <!-- Don't have account yet? <a href="./register.html">Sign up</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>