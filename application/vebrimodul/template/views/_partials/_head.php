<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?= $title; ?> - <?php echo $this->M_Setting->tampilNamaWebsite()['isi_setting'] ?></title>

<!--STYLESHEET-->
<!--=================================================-->

<!--Open Sans Font [ OPTIONAL ]-->
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>


<!--Bootstrap Stylesheet [ REQUIRED ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>css/bootstrap.min.css" rel="stylesheet">


<!--Nifty Stylesheet [ REQUIRED ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>css/nifty.min.css" rel="stylesheet">


<!--Nifty Premium Icon [ DEMONSTRATION ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>css/demo/nifty-demo-icons.min.css" rel="stylesheet">

<!-- Logo Icon-->
<link rel="shortcut icon" href="<?php echo base_url('assets/login-template/') ?>images/ico-pindus.png">

<!--=================================================-->

<!--Pace - Page Load Progress Par [OPTIONAL]-->
<link href="<?php echo base_url('assets/admin-template/') ?>plugins/pace/pace.min.css" rel="stylesheet">
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/pace/pace.min.js"></script>

<!--Demo [ DEMONSTRATION ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>css/demo/nifty-demo.min.css" rel="stylesheet">

<!--Themify Icons [ OPTIONAL ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>plugins/themify-icons/themify-icons.min.css" rel="stylesheet">

<!--CSS Loaders [ OPTIONAL ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>plugins/css-loaders/css/css-loaders.css" rel="stylesheet">

<!--Bootstrap Select [ OPTIONAL ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">

<!--DataTables [ OPTIONAL ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url('assets/admin-template/') ?>plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css" rel="stylesheet">

<!--Animate.css [ OPTIONAL ]-->
<link href="<?php echo base_url('assets/admin-template/') ?>plugins/animate-css/animate.min.css" rel="stylesheet">

<style type="text/css">
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background-color: #fff;
    }

    .preloader .loading {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        font: 14px arial;
    }
</style>