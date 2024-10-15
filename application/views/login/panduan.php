<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <link rel="shortcut icon" href="<?php echo $this->website->icon(); ?>">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/dist/css/adminlte.min.css">
    <style type="text/css" media="screen">
        .login-box {
            min-width: 60% !important;
            min-height: 100% !important;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <!-- Main content -->

    <!-- ---------------------------------------------------- -->


    <div class="card-body">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#english" data-toggle="tab">English</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#indonesia" data-toggle="tab">Indonesia</a></li>
                                </ul>

                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="english">
                                        <p>Registration Guide</p>
                                        <iframe src="<?php echo base_url() ?>assets/guide/guide_english.pdf" width="100%" height="400">
                                        </iframe>
                                        <a href="<?php echo base_url() ?>assets/guide/guide_english.pdf" target="_blank" class=" btn btn-info"><i class="fa fa-download mr-2"></i>Download</a>
                                        <a href="<?php echo base_url('regis'); ?>" class="btn btn-success float-right"><i class="fa fa-arrow-right mr-2"></i>Registration</a>
                                    </div>

                                    <div class="tab-pane" id="indonesia">
                                        <p>Panduan Registrasi</p>
                                        <iframe src="<?php echo base_url() ?>assets/guide/guide_indonesia.pdf" width="100%" height="400">
                                        </iframe>
                                        <a href="<?php echo base_url() ?>assets/guide/guide_indonesia.pdf" target="_blank" class="btn btn-info"><i class="fa fa-download mr-2"></i>Unduh</a>
                                        <a href="<?php echo base_url('regis'); ?>" class="btn btn-success float-right"><i class="fa fa-arrow-right mr-2"></i>Registrasi</a>
                                    </div>
                                </div>
                                <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.social-auth-links -->
    </div>




    <!-- ---------------------------------------------------- -->

    <!-- jQuery -->
    <script src=" <?php echo base_url() ?>assets/admin/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url() ?>assets/admin/dist/js/adminlte.min.js"></script>
</body>

</html>