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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>
    <div class="main-wrapper">
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
                        <h2 class="mt-3 text-center">Kebijakan Privasi</h2>
                        <p class="">Aplikasi sistem pakar kerusakan iphone akan menggunakan data facebook anda. Kami tentunya paham akan keamanan akun anda oleh sebab itu kami mengambil data data berikut untuk autentiktikasi login menggunakan akun facebook.
                            Data yang kami ambil adalah :
                        </p>
                        <ul>
                            <li>first name , last name </li>
                            <li>email</li>
                            <li>profil picture</li>
                        </ul>

                        <p>Kami akan menggunakan data diatas untuk kepentingan promosi dan follow up penawaran produk penggantian part sesuai dengan konsultasi yang telah anda lakukan didalam sistem pakar. Jika anda merasa keberatan untuk menginggalkan data anda didalam sistem kami
                            anda dapat melakukan penghapusan akun melalui<a href="<?= base_url() ?>admin/personalitation/deactive" class="text-danger"> Deactive Account</a>.
                        </p>
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