<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <div id="page-head">

        <div class="pad-all text-center">
            <h3>Welcome back to the Dashboard.</h3>
            <p1>Scroll down to see quick links and overviews of your Server, To do list, Order status or get some Help using Nifty.</p>
        </div>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">

        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-warning panel-colorful media middle pad-all">
                    <div class="media-left">
                        <div class="pad-hor">
                            <i class="ti-bookmark-alt icon-3x"></i>
                        </div>
                    </div>
                    <div class="media-body">
                        <p class="text-2x mar-no text-semibold"><?= $hitungJumlahInventory; ?></p>
                        <p class="mar-no">Jumlah Inventory</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-info panel-colorful media middle pad-all">
                    <div class="media-left">
                        <div class="pad-hor">
                            <i class="ti-layers icon-3x"></i>
                        </div>
                    </div>
                    <div class="media-body">
                        <p class="text-2x mar-no text-semibold"><?= $hitungJumlahBarang; ?></p>
                        <p class="mar-no">Jumlah Barang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-mint panel-colorful media middle pad-all">
                    <div class="media-left">
                        <div class="pad-hor">
                            <i class="ti-layers-alt icon-3x"></i>
                        </div>
                    </div>
                    <div class="media-body">
                        <p class="text-2x mar-no text-semibold"><?= floor($hitungJumlahBarangTotal); ?></p>
                        <p class="mar-no">Jumlah Total Barang</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-danger panel-colorful media middle pad-all">
                    <div class="media-left">
                        <div class="pad-hor">
                            <i class="icon-3x">Rp.</i>
                        </div>
                    </div>
                    <div class="media-body">
                        <p class="text-2x mar-no text-semibold"><?= number_format($hitungJumlahBarangTotalHarga, 0, ',', '.'); ?></p>
                        <p class="mar-no">Jumlah Harga Barang</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="row blog">
            <div class="col-lg-3">

                <div class="panel">
                    <div class="blog-header">
                        <img class="img" src="<?php echo base_url('assets/tik.gif') ?>" width="300" alt="Image">
                    </div>
                    <div class="blog-content">
                        <div class="blog-title media-block">
                            <div class="media-right textright">
                                <a href="#" class="btn btn-icon demo-psi-twitter icon-lg add-tooltip" data-original-title="Twitter" data-container="body"></a>
                                <a href="#" class="btn btn-icon demo-psi-instagram icon-lg add-tooltip" data-original-title="Instagram" data-container="body"></a>
                            </div>
                            <div class="media-body">
                                <a href="#" class="btn-link">
                                    <h2>Hi... Calon Polri!</h2>
                                </a>
                            </div>
                        </div>
                        <div class="blog-body">
                            <p>Semangat Ngoding Ya. </p>
                        </div>
                    </div>
                    <div class="blog-footer">
                        <div class="media-left">
                            <span class="label label-success">Now</span>
                        </div>
                        <div class="media-body text-right">
                            <span class="mar-rgt"><i class="demo-pli-heart-2 icon-fw"></i>1.1M</span>
                            <i class="demo-pli-speech-bubble-5 icon-fw"></i>5.248
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--===================================================-->
    <!--End page content-->

</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->