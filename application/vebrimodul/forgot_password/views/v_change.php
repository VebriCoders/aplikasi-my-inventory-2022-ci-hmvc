<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <title><?= $title; ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?php echo base_url('assets/login-template/') ?>images/ico-pindus.png">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login-template/') ?>vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login-template/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login-template/') ?>vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login-template/') ?>vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login-template/') ?>vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login-template/') ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/login-template/') ?>css/main.css">

</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="<?php echo base_url('assets/login-template/') ?>images/img-01.png" alt="IMG">
                </div>


                <form class="login100-form validate-form" method="POST" action="<?= base_url('forgot_password/change'); ?>">
                    <span class="login100-form-title">
                        Forgot Password
                    </span>

                    <?= $this->session->flashdata('message'); ?>

                    <div class="form-group wrap-input100 validate-input" data-validate="Password is required">
                        <input class="form-control input100" type="password" id="password1" name="password1" minlength="7" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                        </span>
                        <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group wrap-input100 validate-input" data-validate="Password confirm is required">
                        <input class="form-control input100" type="password" id="password2" name="password2" minlength="7" placeholder="Password confirm">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                        <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Simpan Password
                        </button>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="<?php echo base_url('login') ?>">
                            Back to Login
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/login-template/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="<?php echo base_url('assets/login-template/') ?>vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url('assets/login-template/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url('assets/login-template/') ?>vendor/select2/select2.min.js"></script>

    <script src="<?php echo base_url('assets/login-template/') ?>vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>

    <script src="<?php echo base_url('assets/login-template/') ?>js/main.js"></script>
</body>

</html>