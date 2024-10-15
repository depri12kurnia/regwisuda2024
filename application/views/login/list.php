<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- icon -->
  <link rel="shortcut icon" href="<?php echo $this->website->icon(); ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/adminlte.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- SWEETALERT -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style type="text/css" media="screen">
    body {
      /* background-image: url("<?php echo base_url() ?>assets/upload/beckground-beasiswa.png"); */
      background-position: center;
      /* Center the image */
      background-repeat: no-repeat;
      /* Do not repeat the image */
      background-size: cover;
      /* Resize the background image to cover the entire container */
    }
  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="login-logo">
      <img src="<?php echo $this->website->icon(); ?>" alt="" class="img img-responsive img-thumbnail" style="max-width: 30%; height: auto;"> 
    </div>
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="<?php echo base_url('login') ?>" class="h1"><b>Login Form</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?php
        // Notifikasi error
        echo validation_errors('<p class="alert alert-warning">', '</p>');

        // Form open 
        echo form_open(base_url('login'));
        ?>
        <div class="input-group mb-3">
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          <input type="username" name="username" class="form-control" placeholder="Username" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        <?php echo form_close(); ?>

        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
          <a href="<?php echo base_url('lupa_password'); ?>">Lupa Password</a>
        </p> -->
        <!-- <p class="mb-1">
          <a href="<?php echo base_url('registrasi'); ?>" class="text-center">Registrasi Akun Baru</a>
        </p> -->
        <!-- <p class="mb-0">
          <a href="<?php echo base_url('guide/verifikasi'); ?>" class="text-center">Panduan Verifikasi</a>
        </p> -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  <!-- SWEETALERT -->
  <?php if ($this->session->flashdata('sukses')) { ?>
    <script>
      swal("Berhasil", "<?php echo $this->session->flashdata('sukses'); ?>", "success")
    </script>
  <?php } ?>

  <?php if ($this->session->flashdata('warning')) { ?>
    <script>
      swal("Oops...", "<?php echo $this->session->flashdata('warning'); ?>", "warning")
    </script>
  <?php } ?>
  <!-- jQuery -->
  <script src="<?php echo base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url() ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      })
    })
  </script>
</body>

</html>