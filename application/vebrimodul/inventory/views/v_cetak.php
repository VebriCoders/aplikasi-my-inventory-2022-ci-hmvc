<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title><?php echo $title ?></title>

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

    <!--=================================================-->

    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="<?php echo base_url('assets/admin-template/') ?>plugins/pace/pace.min.css" rel="stylesheet">
    <script src="<?php echo base_url('assets/admin-template/') ?>plugins/pace/pace.min.js"></script>

    <!--Demo [ DEMONSTRATION ]-->
    <link href="<?php echo base_url('assets/admin-template/') ?>css/demo/nifty-demo.min.css" rel="stylesheet">

</head>

<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg print-content">

        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">

            <div class="panel">
                <div class="panel-body">
                    <div class="invoice-masthead">
                        <div class="invoice-text">
                            <h3 class="h1 text-uppercase text-thin mar-no text-primary">INVOICE INVENTORY</h3>
                        </div>
                        <div class="invoice-brand" style="white-space:nowrap">
                            <div class="invoice-logo">
                                <img src="<?php echo base_url('assets/') ?>img/iconlong.png" width="300">
                            </div>
                        </div>
                    </div>

                    <div class="invoice-bill row">
                        <div class="col-sm-6 text-xs-center">
                            <table class="invoice-details">
                                <tbody>
                                    <tr>
                                        <td class="text-main text-bold">Invoice</td>
                                        <td class="text-right text-info text-bold"><?php echo $tampilData_Inventory->nama_inventory ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">Status</td>
                                        <td class="text-right">
                                            <?php if ($tampilData_Inventory->status == 1) { ?>
                                                <span class="badge badge-success">Aktif</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            <?php } ?>
                                            -
                                            <?php if ($tampilData_Inventory->favorite == 1) { ?>
                                                <span class="badge badge-success">Favorite</span>
                                            <?php } else { ?>
                                                <span class="badge badge-danger">Tidak Favorite</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">Tanggal Di Tambahkan</td>
                                        <td class="text-right"><?php echo $tampilData_Inventory->created_on ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6 text-xs-center">
                            <table class="">
                                <tbody>
                                    <tr>
                                        <td class="text-main text-bold">Jumlah Barang :</td>
                                        <td class="text-left text-info text-bold"><?php echo $hitungJumlahBarang ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-main text-bold">Total Barang :</td>
                                        <td class="text-left text-info text-bold"><?php echo floor($hitungJumlahBarangTotal) ?></td>
                                    </tr>

                                    <?php
                                    $length     = 11;
                                    $str        = "";
                                    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
                                    $max        = strlen($characters) - 1;
                                    for ($i = 0; $i < $length; $i++) {
                                        $rand = mt_rand(0, $max);
                                        $str .= $characters[$rand];
                                    }
                                    $kode_invoice = $str;
                                    ?>
                                    <tr>
                                        <td class="text-main text-bold">KODE CETAK :</td>
                                        <td class="text-left text-info text-bold"><?php echo strtoupper($kode_invoice) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr class="new-section-sm bord-no">

                    <div class="row">
                        <div class="col-lg-12 table-responsive">
                            <table class="table table-bordered invoice-summary">
                                <thead>
                                    <tr class="bg-trans-dark">
                                        <th class="text-center text-uppercase">No</th>
                                        <th class="text-center text-uppercase">Foto</th>
                                        <th class="text-center text-uppercase">Nama Barang</th>
                                        <th class="min-col text-center text-uppercase">Jumlah</th>
                                        <th class="min-col text-center text-uppercase">Harga</th>
                                        <th class="min-col text-right text-uppercase">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($tampilData_Detail->result() as $data) { ?>
                                        <tr>
                                            <td class="min-width"><?php echo $i; ?></td>
                                            <td class="text-center">
                                                <?php if ($data->images == "default.jpg") { ?>
                                                    <img width="100" class="img-lg mar-ver" src="<?php echo base_url("assets/img/default.jpg") ?>">
                                                <?php } else { ?>
                                                    <img width="100" class="img-lg mar-ver" src="<?php echo base_url("assets/upload/images/data_barang_inventory/") ?><?php echo $data->images ?>">
                                                <?php } ?>
                                            </td>
                                            <td class="text-center"><?php echo $data->nama_barang ?></td>
                                            <td class="text-center"><?php echo $data->jumlah ?></td>
                                            <td class="text-center">Rp.<?php echo number_format($data->harga, 0, ',', '.') ?></td>
                                            <td class="text-right">Rp.<?php echo number_format($data->total, 0, ',', '.') ?></td>
                                        </tr>
                                    <?php $i++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="clearfix">
                        <table class="table invoice-total">
                            <tbody>
                                <!-- <tr>
                                    <td><strong>Sub Total :</strong></td>
                                    <td>$538.06</td>
                                </tr>
                                <tr>
                                    <td><strong>TAX :</strong></td>
                                    <td>$73.98</td>
                                </tr> -->
                                <tr>
                                    <td><strong>TOTAL </strong></td>
                                    <td class="text-bold h4">Rp.<?php echo number_format($hitungJumlahBarangHarga, 0, ',', '.') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="text-right no-print">
                        <a href="javascript:window.print()" class="btn btn-default"><i class="demo-pli-printer icon-lg"></i></a>
                        <a href="#" class="btn btn-primary">Nabung Dulu</a>
                    </div>

                    <hr class="new-section-sm bord-no">

                    <div class="well well-sm">
                        <p class="text-bold text-main text-uppercase">Notes &amp; Information</p>
                        <p>Barang Untuk Simulasi, Harga Akan Berubah Sewaktu Waktu.</p>
                        <p>Semangat Nabung Untuk Membeli Barang Impian <strong class="text-main">billing[at]mycompany.com</strong></p>
                        <p>Bismillah Bakomsus TI 2022 Masukkkk!!! <strong class="text-main"><a href="https://penerimaan.polri.go.id/" target="_blank">MASUK POLRI</a></strong></p>
                    </div>
                </div>
            </div>

        </div>
        <!--===================================================-->
        <!--End page content-->


        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->

    <!--JAVASCRIPT-->
    <!--=================================================-->

    <!--jQuery [ REQUIRED ]-->
    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="<?php echo base_url('assets/admin-template/') ?>js/jquery.min.js"></script>

    <!--BootstrapJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url('assets/admin-template/') ?>js/bootstrap.min.js"></script>

    <!--NiftyJS [ RECOMMENDED ]-->
    <script src="<?php echo base_url('assets/admin-template/') ?>js/nifty.min.js"></script>

    <!--=================================================-->

    <!--Demo script [ DEMONSTRATION ]-->
    <script src="<?php echo base_url('assets/admin-template/') ?>js/demo/nifty-demo.min.js"></script>

</body>

</html>