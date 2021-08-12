<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url() ?>/assets/images/favicon.png">
    <title>Sistem Pakar Kerusakan iPhone</title>
    <!-- Custom CSS -->
    <link href="<?= base_url() ?>/dist/css/style.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>/dist/css/custom.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<?php if (!empty($authURL)) { ?>

    <body>
        <div class="main-wrapper bg-custom">
            <!-- ============================================================== -->
            <!-- Preloader - style you can find in spinners.css -->
            <!-- ============================================================== -->
            <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Preloader - style you can find in spinners.css -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Login box.scss -->
            <!-- ============================================================== -->
            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
                <div class="auth-box row">
                    <div class="col-lg-6 col-md-6 modal-bg-img" style="background-image: url(<?= base_url() ?>/assets/images/big/3.jpg);">
                    </div>
                    <div class="col-lg-6 col-md-6 bg-white">
                        <div class="p-3">
                            <div class="text-center">
                                <img src="<?= base_url() ?>/assets/images/big/icon.png" width="60" alt="wrapkit">
                            </div>
                            <h2 class="mt-3 text-center">Sign In</h2>
                            <p class="text-center">Masukkan E-mail dan password atau login menggunakan Facebook anda untuk mengakses Sistem Pakar diagnosa iPhone.</p>
                            <?= $this->session->flashdata('message') ?>
                            <form action="<?= base_url() ?>auth/login" class="mt-4" method="POST">
                                <div class="row">
                                    <div class="form-group col-lg-12">
                                        <input type="text" class="form-control" id="current_pass" aria-describedby="name" placeholder="Masukkan Email" name="email" value="" required>
                                        <?php echo form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                                    </div>
                                    <div class="form-group col-lg-12">
                                        <input type="password" class="form-control" id="" aria-describedby="name" placeholder="Masukkan Password" name="password" value="" required>
                                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                    <div class="col-lg-12 text-center mt-3">
                                        <button type="sumbit" class="btn btn-block btn-dark">Log In</button>
                                    </div>
                            </form>
                            <div class="col-lg-12 text-center mt-3">
                                <p class="text-center">Gunakan Akun Social Media Untuk Log-in</p>
                                <a href="<?php echo $authURL; ?>" class="btn btn-block btn-primary"><i class="fab fa-facebook-square"></i> Sign In</a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-12 text-center p-3 bg-white">
                    Jika anda belum mengetahui kami anda bisa klil link <a href="<?= base_url() ?>welcome/tentang_kami" class="text-danger"> Tentang Sistem Pakar Kerusakan iPhone</a>.
                    Saya telah membaca dan menerima <a href="<?= base_url() ?>welcome/ketentuan_layanan" class="text-danger">Ketentuan Layanan Pengguna</a> dan
                    <a href="<?= base_url() ?>welcome/kebijakan_privasi" class="text-danger"> Kebijakan Privasi Sistem Pakar iPhone.</a>
                </div>
            </div>
        </div>

    <?php } else { ?>
        <?php redirect('admin/dashboard'); ?>
    <?php } ?>
    <!-- ============================================================== -->
    <!-- Login box.scss -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="<?= base_url() ?>/assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= base_url() ?>/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?= base_url() ?>/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader ").fadeOut();
    </script>
    </body>

</html>