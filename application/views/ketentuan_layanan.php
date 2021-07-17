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
    <title>Adminmart Template - The Ultimate Multipurpose admin template</title>
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
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(<?= base_url() ?>assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-12 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <!-- <img src="<?= base_url() ?>/assets/images/big/icon.png" alt="wrapkit"> -->
                        </div>
                        <h2 class="mt-3 text-center">Ketentuan Layanan</h2>
                        <p>Dengan menggunakan login melalui facebook maka kita akan mengakses data anda pada Facebook seperti gambar profil, nama, dan email. Kami berhak menggunakan data tersebut untuk melakukan hal - hal berikut :
                        <ul>
                            <li>Memberikan tawaran promosi melalui e-mail</li>
                            <li>Memberikan pemberitahuan tentang kami melalui e-mail.</li>
                        </ul>
                        Namun jika anda merasa tidak perlu lagi menggunakan aplikasi dan tidak ingin data anda tersimpan di dalam sistem maka anda dapat melakukan penghapusan akun dengan konsekuensi anda tidak dapat lagi mengakses aplikasi sistem pakar kami sebelum anda membuat akun baru atau login kembali menggunakan facebook.
                        </p>
                        <a href="<?= base_url() ?>auth" class="btn btn-block btn-dark">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
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