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

        <div class="panel">
            <div class="panel-body">

                <?php echo $this->session->flashdata('edit-profile'); ?>



                <?php
                $i = 1;
                foreach ($tampilData->result() as $data) { ?>
                    <div class="fluid">

                        <div class="text-right">
                            <button class="btn btn-sm btn-info btn-labeled" data-target="#modal-edit-password" data-toggle="modal"><i class="btn-label ti-key"></i> Ubah Password</button>
                            <button class="btn btn-sm btn-success btn-labeled" data-target="#modal-edit-profile" data-toggle="modal"><i class="btn-label ti-pencil-alt"></i> Edit Profile</button>
                        </div>

                        <!-- Simple profile -->
                        <div class="text-center">
                            <div class="pad-ver">

                                <?php if ($data->image == "default.jpg") { ?>
                                    <img src="<?php echo base_url("assets/img/user_default.jpg") ?>" class="img-lg img-circle" alt="Profile Picture">
                                <?php } else { ?>
                                    <img src="<?php echo base_url('assets/upload/images/user_management/') ?><?php echo $data->image ?>" class="img-lg img-circle" alt="Profile Picture">
                                <?php } ?>
                            </div>
                            <h4 class="text-lg text-overflow mar-no"><?php echo $data->name ?></h4>
                            <p class="text-sm text-muted"><?php echo $data->email ?></p>

                        </div>
                        <hr>

                        <!-- Profile Details -->
                        <p class="pad-ver text-main text-sm text-uppercase text-bold">Detail</p>
                        <p><i class="ti-user icon-lg icon-fw"></i> <b>Nama Lengkap :</b> <?php echo $data->name ?></p>
                        <p><i class="ti-email icon-lg icon-fw"></i> <b>Email :</b> <?php echo $data->email ?></p>
                        <p><i class="ti-medall icon-lg icon-fw"></i> <b>Role : </b> <?php if ($data->role_id == 1) {
                                                                                        echo "Administrator";
                                                                                    } else {
                                                                                        echo "User";
                                                                                    } ?></p>
                        <p><i class="ti-check-box icon-lg icon-fw"></i> <b>Status :</b> <?php if ($data->is_active == 1) {
                                                                                            echo "Aktif";
                                                                                        } else {
                                                                                            echo "Non-Aktif";
                                                                                        } ?></p>
                        <p><i class="ti-timer icon-lg icon-fw"></i> <b>Akun Di Buat : </b> <?php echo date('d/m/Y H:i:s', $data->date_created); ?></p>



                    </div>
                <?php $i++;
                } ?>
            </div>
        </div>

    </div>
    <!--===================================================-->
    <!--End page content-->

</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->


<?php
$i = 1;
foreach ($tampilData->result() as $data) { ?>

    <!--Moddal Edit-->
    <!--===================================================-->
    <?php echo form_open_multipart('profile/Edit_profile'); ?>
    <div class="modal fade" id="modal-edit-profile" role="dialog" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Edit Data - <?= $title; ?> (<?php echo $data->name ?>)</h4>
                </div>

                <!-- ID Untuk Query Where -->
                <input type="hidden" name="query_id" value="<?php echo $data->id ?>">

                <!--Modal body-->
                <div class="modal-body">
                    <div class="form-group">

                        <label class="control-label"><b>Nama Lengkap</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-user"></i></span>
                            <input type="text" class="form-control" name="name" value="<?php echo $data->name ?>" placeholder="Nama Lengkap" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>

                        <label class="control-label"><b>Email</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-email"></i></span>
                            <input type="email" class="form-control" name="email" value="<?php echo $data->email ?>" placeholder="Email" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>

                        <label class="control-label"><b>Foto</b></label>
                        <div class="input-group mar-btm">
                            <input type="hidden" name="image_lama" value="<?php echo $data->image ?>">
                            <span class="input-group-addon"><i class="ti-image"></i></span>
                            <input type="file" class="form-control" name="image" value="<?php echo $data->image ?>" id="userfile" onchange="tampilkanPreview<?php echo $i; ?>(this,'preview-<?php echo $i; ?>')" />
                            <p>Foto Anda Sebelumnya : <?php echo $data->image ?></p>
                            <img id="preview-<?php echo $i; ?>" width="100" />
                        </div>

                    </div>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-success">Simpan Perubahan</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <!--===================================================-->
    <!--End Modal Edit-->

    <script src="<?php echo base_url('assets/admin-template/') ?>js/jquery.min.js"></script>
    <script type="text/javascript">
        function tampilkanPreview<?php echo $i; ?>(userfile, idpreview) {
            var gb = userfile.files;
            for (var i = 0; i < gb.length; i++) {
                var gbPreview = gb[i];
                var imageType = /image.*/;
                var preview = document.getElementById(idpreview);
                var reader = new FileReader();
                if (gbPreview.type.match(imageType)) {
                    //jika tipe data sesuai
                    preview.file = gbPreview;
                    reader.onload = (function(element) {
                        return function(e) {
                            element.src = e.target.result;
                        };
                    })(preview);
                    //membaca data URL gambar
                    reader.readAsDataURL(gbPreview);
                } else {
                    //jika tipe data tidak sesuai
                    alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
                }
            }
        }
    </script>



    <!--Moddal Edit Password-->
    <!--===================================================-->
    <?php echo form_open_multipart('profile/Edit_password'); ?>
    <div class="modal fade" id="modal-edit-password" role="dialog" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Ubah Password - <?= $title; ?> (<?php echo $data->name ?>)</h4>
                </div>

                <!-- ID Untuk Query Where -->
                <input type="hidden" name="query_id" value="<?php echo $data->id ?>">

                <!--Modal body-->
                <div class="modal-body">

                    <div class="alert alert-warning">
                        <strong>Perhatian!</strong> Gunakan Password Lebih Dari 7 Kata Dengan Huruf Besar Dan Kecil Serta Nomror, Agar Akun Anda Aman!.
                    </div>

                    <div class="form-group">

                        <label class="control-label"><b>Password Baru</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-key"></i></span>
                            <input type="text" class="form-control" name="password_baru" placeholder="Password Baru" required minlength="7" oninvalid="this.setCustomValidity('Data Harus Di Isi Minimal 7 Kata')" oninput="setCustomValidity('')">
                        </div>

                        <label class="control-label"><b>Konfirmasi Password Baru</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-key"></i></span>
                            <input type="text" class="form-control" name="konfirmasi_password_baru" placeholder="Konfirmasi Password Baru" minlength="7" required oninvalid="this.setCustomValidity('Data Harus Di Isi Minimal 7 Kata')" oninput="setCustomValidity('')">
                        </div>

                    </div>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-info">Simpan Password</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <!--===================================================-->
    <!--End Modal Edit Password-->

<?php $i++;
} ?>