<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <div id="page-head">
        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow"><?= $title ?></h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="demo-pli-home"></i></a></li>
            <!-- <li><a href="#">UI</a></li> -->
            <li class="active"><?= $title ?></li>
        </ol>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End breadcrumb-->

    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">

        <div class="row">
            <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Setting Basic</h3>
                    </div>

                    <!--Hover Rows-->
                    <!--===================================================-->
                    <div class="panel-body">
                        <table class="table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th class="min-width">Icon</th>
                                    <th>Setting</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><i class="demo-pli-monitor-2 icon-2x"></i></td>
                                    <td>
                                        <span class="text-main text-semibold">Nama Aplikasi</span>
                                        <br>
                                        <small class="text-muted"><?= $tampilNamaWebsite['isi_setting']; ?></small>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#demo-modal-edit-nama-aplikasi" data-toggle="modal" class="btn btn-success btn-labeled"><i class="btn-label ti-pencil"></i> Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="ti-image icon-2x"></i></td>
                                    <td>
                                        <span class="text-main text-semibold">Logo Aplikasi</span>
                                        <br>
                                        <small class="text-muted">
                                            <img class="img-responsive" width="300px" src="<?php echo base_url('assets/img/') ?><?= $tampilLogoWebsite['isi_setting']; ?>" alt="Image">
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#demo-modal-edit-logo-aplikasi" data-toggle="modal" class="btn btn-success btn-labeled"><i class="btn-label ti-pencil"></i> Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--===================================================-->
                    <!--End Hover Rows-->

                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Setting Email</h3>
                    </div>

                    <!--Hover Rows-->
                    <!--===================================================-->
                    <div class="panel-body">
                        <table class="table table-hover table-vcenter">
                            <thead>
                                <tr>
                                    <th class="min-width">Icon</th>
                                    <th>Setting</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><i class="ti-email icon-2x"></i></td>
                                    <td>
                                        <span class="text-main text-semibold">Email</span>
                                        <br>
                                        <small class="text-muted"><?= $tampilEmailWebsite['isi_setting']; ?></small>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#demo-modal-edit-email" data-toggle="modal" class="btn btn-success btn-labeled"><i class="btn-label ti-pencil"></i> Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center"><i class="ti-key icon-2x"></i></td>
                                    <td>
                                        <span class="text-main text-semibold">Password Email</span>
                                        <br>
                                        <small class="text-muted"><?= $tampilPswdEmailWebsite['isi_setting']; ?></small>
                                    </td>
                                    <td class="text-center">
                                        <button data-target="#demo-modal-edit-password-email" data-toggle="modal" class="btn btn-success btn-labeled"><i class="btn-label ti-pencil"></i> Edit</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--===================================================-->
                    <!--End Hover Rows-->

                </div>
            </div>
        </div>

    </div>
    <!--===================================================-->
    <!--End page content-->

    <!--Modal Edit Nama Aplikasi-->
    <!--===================================================-->
    <?php echo form_open_multipart('setting/edit/nama-aplikasi'); ?>
    <div id="demo-modal-edit-nama-aplikasi" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title" id="mySmallModalLabel">Edit Nama Aplikasi</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group input-group mar-btm">
                                <span class="input-group-addon"><i class="demo-pli-monitor-2"></i></span>
                                <input type="text" class="form-control" name="isi_setting" placeholder="Nama Aplikasi" value="<?= $tampilNamaWebsite['isi_setting']; ?>" required oninvalid="this.setCustomValidity('Nama Aplikasi Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <!--===================================================-->
    <!--Modal Edit Nama Aplikasi-->

    <!--Modal Edit Logo Aplikasi-->
    <!--===================================================-->
    <?php echo form_open_multipart('setting/edit/logo-aplikasi'); ?>
    <div id="demo-modal-edit-logo-aplikasi" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title" id="mySmallModalLabel">Edit Logo Aplikasi</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-image"></i></span>
                                <img src="<?php echo base_url('assets/img/') ?>image-upload-default.png" id="foto" width="400px"><br><br>
                                <input type="file" accept="image/png, .jpeg, .jpg" onchange="gambar(this.value)" class="form-control" name="isi_setting" value="<?= $tampilLogoWebsite['isi_setting']; ?>" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <!--===================================================-->
    <!--Modal Edit Logo Aplikasi-->


    <!--Modal Edit Email-->
    <!--===================================================-->
    <?php echo form_open_multipart('setting/edit/email-aplikasi'); ?>
    <div id="demo-modal-edit-email" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title" id="mySmallModalLabel">Edit Email</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-email"></i></span>
                                <input type="text" class="form-control" name="isi_setting" placeholder="Email Aplikasi" value="<?= $tampilEmailWebsite['isi_setting']; ?>" required oninvalid="this.setCustomValidity('Email Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <!--===================================================-->
    <!--Modal Edit Email-->

    <!--Modal Edit Password Email-->
    <!--===================================================-->
    <?php echo form_open_multipart('setting/edit/password-email-aplikasi'); ?>
    <div id="demo-modal-edit-password-email" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title" id="mySmallModalLabel">Edit Password Email</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-key"></i></span>
                                <input type="text" class="form-control" name="isi_setting" placeholder="Password Email Aplikasi" value="<?= $tampilPswdEmailWebsite['isi_setting']; ?>" required oninvalid="this.setCustomValidity('Password Email Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <!--===================================================-->
    <!--Modal Edit Password Email-->


</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->