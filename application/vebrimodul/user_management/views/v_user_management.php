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

        <!-- Contact Toolbar -->
        <!---------------------------------->
        <div class="row pad-btm">
            <div class="col-sm-12 toolbar-right text-right">
                <button class="btn btn-success btn-labeled" data-target="#modal-tambah" data-toggle="modal"><i class="btn-label ti-import"></i> Tambah</button>
                <button class="btn btn-default"><i class="demo-pli-printer"></i></button>
            </div>
        </div>
        <!---------------------------------->

        <?php echo $this->session->flashdata('edit-profile'); ?>

        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Data User Management</h3>
            </div>
            <div class="panel-body">
                <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Foto</th>
                            <th>Nama Lengkap</th>
                            <th class="min-tablet">Email</th>
                            <th class="min-tablet">Role Akses</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($tampilData->result() as $data) { ?>
                            <tr>
                                <td class="min-width"><?php echo $i; ?></td>
                                <td>
                                    <?php if ($data->image == "default.jpg") { ?>
                                        <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="<?php echo base_url("assets/img/default.jpg") ?>">
                                    <?php } else { ?>
                                        <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="<?php echo base_url("assets/upload/images/user_management/") ?><?php echo $data->image ?>">
                                    <?php } ?>
                                </td>
                                <td><?php echo $data->name ?></td>
                                <td><?php echo $data->email ?></td>
                                <td class="min-width">
                                    <?php if ($data->role_id == '1') { ?>
                                        <div class="label label-table label-primary">Administrator</div>
                                    <?php } else { ?>
                                        <div class="label label-table label-info">User</div>
                                    <?php } ?>
                                </td>
                                <td class="min-width">
                                    <?php if ($data->is_active == '1') { ?>
                                        <div class="label label-table label-success">Aktif</div>
                                    <?php } else { ?>
                                        <div class="label label-table label-danger">Tidak Aktif</div>
                                    <?php } ?>
                                </td>
                                <td class="min-width">
                                    <?php if ($this->session->userdata('id') == $data->id) { ?>
                                        <div class="btn-groups">
                                            <button disabled class="btn btn-warning btn-labeled" data-target="#modal-edit-<?php echo $data->id ?>" data-toggle="modal"><i class="btn-label ti-pencil"></i> Edit</button>
                                            <button disabled class="btn btn-info btn-labeled" data-target="#modal-password-<?php echo $data->id ?>" data-toggle="modal"><i class="btn-label ti-key"></i> Ganti Password</button>
                                            <button disabled class="btn btn-danger btn-labeled" data-target="#modal-hapus-<?php echo $data->id ?>" data-toggle="modal"><i class="btn-label ti-trash"></i> Hapus</button>
                                        </div>
                                    <?php } else { ?>
                                        <div class="btn-groups">
                                            <button class="btn btn-warning btn-labeled" data-target="#modal-edit-<?php echo $data->id ?>" data-toggle="modal"><i class="btn-label ti-pencil"></i> Edit</button>
                                            <button class="btn btn-info btn-labeled" data-target="#modal-password-<?php echo $data->id ?>" data-toggle="modal"><i class="btn-label ti-key"></i> Ganti Password</button>
                                            <button class="btn btn-danger btn-labeled" data-target="#modal-hapus-<?php echo $data->id ?>" data-toggle="modal"><i class="btn-label ti-trash"></i> Hapus</button>
                                        </div>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--===================================================-->
        <!-- End Striped Table -->
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
    <?php echo form_open_multipart('user_management/Edit'); ?>
    <div class="modal fade" id="modal-edit-<?php echo $data->id ?>" role="dialog" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
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

                        <label class="control-label"><b>Role Akses</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-check"></i></span>
                            <select class="form-control selectpicker" name="role_id" value="<?php echo $data->role_id ?>">
                                <?php if ($data->role_id == '1') { ?>
                                    <option selected="selected" value="1">Administrator</option>
                                    <option value="2">User</option>
                                <?php } else { ?>
                                    <option selected="selected" value="2">User</option>
                                    <option value=" 1">Administrator</option>
                                <?php } ?>
                            </select>
                        </div>

                        <label class="control-label"><b>Status</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-check"></i></span>
                            <select class="form-control selectpicker" name="is_active" value="<?php echo $data->is_active ?>">
                                <?php if ($data->is_active == '1') { ?>
                                    <option selected="selected" value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                <?php } else { ?>
                                    <option selected="selected" value="0">Tidak Aktif</option>
                                    <option value=" 1">Aktif</option>
                                <?php } ?>
                            </select>
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
                    <button class="btn btn-primary">Simpan Perubahan</button>
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

    <!--Moddal Hapus-->
    <!--===================================================-->
    <?php echo form_open_multipart('user_management/Hapus/' . $data->id); ?>
    <div class="modal fade" id="modal-hapus-<?php echo $data->id ?>" role="dialog" tabindex="-1" aria-labelledby="modal-hapus" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Hapus Data - <?= $title; ?> (<?php echo $data->name ?>)</h4>
                </div>

                <!--Modal body-->
                <div class="modal-body">
                    <p>Apakah Kamu Yakin Akan Menghapus Data <b><?php echo $data->name ?></b> ? </p>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
    <!--===================================================-->
    <!--End Modal Hapus-->

    <!--Moddal Edit Password-->
    <!--===================================================-->
    <?php echo form_open_multipart('user_management/Edit_password'); ?>
    <div class="modal fade" id="modal-password-<?php echo $data->id ?>" role="dialog" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
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

<!--Moddal Tambah-->
<!--===================================================-->
<?php echo form_open_multipart('user_management/Tambah'); ?>
<div class="modal fade" id="modal-tambah" role="dialog" tabindex="-1" aria-labelledby="modal-tambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title">Tambah Data - <?= $title; ?></h4>
            </div>

            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group">

                    <label class="control-label"><b>Nama Lengkap</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-user"></i></span>
                        <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>

                    <label class="control-label"><b>Email</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-email"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>

                    <label class="control-label"><b>Password Default</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-key"></i></span>
                        <input type="number" class="form-control" name="password" value="12345678" placeholder="Password Default" readonly required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>

                    <label class="control-label"><b>Role Akses</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-check"></i></span>
                        <select class="form-control selectpicker" name="role_id">
                            <option value="">--- Pilih Status ---</option>
                            <option value="1">Administrator</option>
                            <option value="2">User</option>
                        </select>
                    </div>

                    <label class="control-label"><b>Status</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-check"></i></span>
                        <select class="form-control selectpicker" name="is_active">
                            <option value="">--- Pilih Status ---</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                    <label class="control-label"><b>Foto</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-image"></i></span>
                        <input type="file" class="form-control" name="image" id="userfile" onchange="tampilkanPreview(this,'preview')" />
                        <img id="preview" width="100" />
                    </div>

                </div>
            </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<!--===================================================-->
<!--End Modal Tambah-->