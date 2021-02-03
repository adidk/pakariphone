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
<?php if (!empty($authURL)) { ?>

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
            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative" style="background:url(<?= base_url() ?>/assets/images/big/auth-bg.jpg) no-repeat center center;">
                <div class="auth-box row">
                    <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(<?= base_url() ?>/assets/images/big/3.jpg);">
                    </div>
                    <div class="col-lg-5 col-md-7 bg-white">
                        <div class="p-3">
                            <div class="text-center">
                                <img src="<?= base_url() ?>/assets/images/big/icon.png" alt="wrapkit">
                            </div>
                            <h2 class="mt-3 text-center">Sign In</h2>
                            <p class="text-center">Enter your email address and password to access admin panel.</p>
                            <form class="mt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="text-dark" for="uname">Username</label>
                                            <input class="form-control" id="uname" type="text" placeholder="enter your username">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="text-dark" for="pwd">Password</label>
                                            <input class="form-control" id="pwd" type="password" placeholder="enter your password">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <button type="submit" class="btn btn-block btn-dark">Sign In</button>
                                    </div>

                            </form>
                            <div class="col-lg-12 text-center mt-3">
                                <a href="<?php echo $authURL; ?>" class="btn btn-block btn-dark">Facebook Sign In</a>
                            </div>
                            <div class="col-lg-12 text-center mt-5">
                                Don't have an account? <a href="#" class="text-danger">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php } else { ?>
        <h2>Facebook Profile Details</h2>
        <div class="ac-data">
            <img src="<?php echo $userData['picture']; ?>" />
            <p><b>Facebook ID:</b> <?php echo $userData['oauth_uid']; ?></p>
            <p><b>Name:</b> <?php echo $userData['first_name'] . ' ' . $userData['last_name']; ?></p>
            <p><b>Email:</b> <?php echo $userData['email']; ?></p>
            <p><b>Gender:</b> <?php echo $userData['gender']; ?></p>
            <p><b>Logged in with:</b> Facebook</p>
            <p><b>Profile Link:</b> <a href="<?php echo $userData['link']; ?>" target="_blank">Click to visit Facebook page</a></p>
            <p><b>Logout from <a href="<?php echo $logoutURL; ?>">Facebook</a></p>
            <a href="<?= base_url() ?>Auth/logout" class="btn btn-primary">Logout</a>
        </div>
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