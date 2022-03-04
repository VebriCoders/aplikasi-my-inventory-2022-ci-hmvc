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
                <!-- <button class="btn btn-default"><i class="demo-pli-printer"></i></button> -->
            </div>
        </div>
        <!---------------------------------->

        <div class="row" style="margin-top: 20px">

            <?php
            $i = 1;
            foreach ($tampilDataPagination_Inventory as $data) { ?>
                <div class="col-sm-4 col-md-3">

                    <!-- Contact Widget -->
                    <!---------------------------------->
                    <div class="panel pos-rel" style="height:330px;">
                        <div class="pad-all text-center">
                            <div class="widget-control">
                                <?php $uri_code =  $this->uri->segment(3) ?>
                                <?php if ($data['favorite'] == 0) { ?>
                                    <a href="<?php echo base_url('inventory/favorite/' . $data['id'] . '/' . $uri_code) ?>" class="add-tooltip btn btn-trans" data-original-title="Favorite"><span class="favorite"><i class="demo-psi-star icon-lg"></i></span></a>
                                <?php } else { ?>
                                    <a href="<?php echo base_url('inventory/favorite/' . $data['id'] . '/' . $uri_code) ?>" class="add-tooltip btn btn-trans" data-original-title="Daftar Favorite"><span class="favorite-color"><i class="demo-psi-star icon-lg"></i></span></a>
                                <?php } ?>
                                <div class="btn-group dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a data-target="#modal-edit-<?php echo $data['id'] ?>" data-toggle="modal"><i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit</a></li>
                                        <li><a data-target="#modal-hapus-<?php echo $data['id'] ?>" data-toggle="modal"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>
                                    </ul>
                                </div>
                            </div>
                            <a href="<?php echo base_url('inventory/detail/') ?><?php echo $data['slug'] ?>" class="add-tooltip" data-toggle="tooltip" data-container="body" data-placement="top" data-original-title="Klik Untuk Menambah Barang">
                                <?php if ($data['images'] == "default.jpg") { ?>
                                    <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="<?php echo base_url("assets/img/default.jpg") ?>">
                                <?php } else { ?>
                                    <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="<?php echo base_url("assets/upload/images/inventory/") ?><?php echo $data['images'] ?>">
                                <?php } ?>
                                <p class="text-lg text-semibold mar-no text-main"><?php echo $data['nama_inventory'] ?></p>
                                <p class="text-sm"><?php echo $data['kebutuhan'] ?></p>

                                <?php $jml_karakter =  strlen($data['deskripsi']) ?>
                                <?php if ($jml_karakter >= 70) { ?>
                                    <p class="text-sm add-tooltip" data-toggle="tooltip" data-container="body" data-placement="bottom" data-original-title="<?php echo $data['deskripsi'] ?>"><?php echo substr($data['deskripsi'], 0, 70) ?>...</p>
                                <?php } else { ?>
                                    <p class="text-sm add-tooltip" data-toggle="tooltip" data-container="body" data-placement="bottom" data-original-title="<?php echo $data['deskripsi'] ?>"><?php echo substr($data['deskripsi'], 0, 70) ?></p>
                                <?php } ?>

                                <div class="label label-md label-info" style="margin: auto;"><?php echo $data['created_on'] ?></div>
                            </a>
                            <div class="pad-top btn-groups">
                                <?php if ($data['status'] == '1') { ?>
                                    <div class=" label label-table label-success">Aktif</div>
                                <?php } else { ?>
                                    <div class="label label-table label-danger">Tidak Aktif</div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <!---------------------------------->

                </div>
            <?php $i++;
            } ?>

        </div>

        <div class="row text-center">

            <?= $this->pagination->create_links(); ?>

        </div>

    </div>
    <!--===================================================-->
    <!--End page content-->

</div>
<!--===================================================-->
<!--END CONTENT CONTAINER-->


<?php
$i = 1;
foreach ($tampilData_Inventory->result() as $data) { ?>

    <!--Moddal Edit-->
    <!--===================================================-->
    <?php echo form_open_multipart('inventory/Edit'); ?>
    <div class="modal fade" id="modal-edit-<?php echo $data->id ?>" role="dialog" tabindex="-1" aria-labelledby="modal-edit" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Edit Data - <?= $title; ?> (<?php echo $data->nama_inventory ?>)</h4>
                </div>

                <!-- ID Untuk Query Where -->
                <input type="hidden" name="query_id" value="<?php echo $data->id ?>">
                <input type="hidden" name="actual_link" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"></input>

                <!--Modal body-->
                <div class="modal-body">
                    <div class="form-group">

                        <label class="control-label"><b>Nama Inventory</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-bookmark-alt"></i></span>
                            <input type="text" class="form-control" name="nama_inventory" value="<?php echo $data->nama_inventory ?>" placeholder="Nama Inventory" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>

                        <label class="control-label"><b>Kebutuhan</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-star"></i></span>
                            <input type="text" class="form-control" name="kebutuhan" value="<?php echo $data->kebutuhan ?>" placeholder="Kebutuhan" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                        </div>

                        <label class="control-label"><b>Deskripsi</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-notepad"></i></span>
                            <textarea placeholder="Deskripsi" name="deskripsi" rows="5" class="form-control" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"><?php echo $data->deskripsi ?></textarea>
                        </div>

                        <label class="control-label"><b>Logo/Images</b></label>
                        <div class="input-group mar-btm">
                            <input type="hidden" name="images_lama" value="<?php echo $data->images ?>">
                            <span class="input-group-addon"><i class="ti-image"></i></span>
                            <input type="file" class="form-control" name="images" value="<?php echo $data->images ?>" id="userfile" onchange="tampilkanPreview<?php echo $i; ?>(this,'preview-<?php echo $i; ?>')" />
                            <p>Foto Anda Sebelumnya : <?php echo $data->images ?></p>
                            <img id="preview-<?php echo $i; ?>" width="100" />
                        </div>

                        <label class="control-label"><b>Status</b></label>
                        <div class="input-group mar-btm">
                            <span class="input-group-addon"><i class="ti-check"></i></span>
                            <select class="form-control selectpicker" name="status" value="<?php echo $data->status ?>">
                                <?php if ($data->status == '1') { ?>
                                    <option selected="selected" value=" 1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                <?php } else { ?>
                                    <option selected="selected" value="0">Tidak Aktif</option>
                                    <option value=" 1">Aktif</option>
                                <?php } ?>
                            </select>
                        </div>

                    </div>
                </div>

                <!--Modal footer-->
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                    <button class="btn btn-warning">Simpan Perubahan</button>
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
    <?php echo form_open_multipart('inventory/Hapus/' . $data->id); ?>
    <div class="modal fade" id="modal-hapus-<?php echo $data->id ?>" role="dialog" tabindex="-1" aria-labelledby="modal-hapus" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <input type="hidden" name="actual_link" value="<?php echo $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>"></input>

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Hapus Data - <?= $title; ?> (<?php echo $data->nama_inventory ?>)</h4>
                </div>

                <!--Modal body-->
                <div class="modal-body">
                    <p>Apakah Kamu Yakin Akan Menghapus Data <b><?php echo $data->nama_inventory ?></b> ? </p>
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

<?php $i++;
} ?>

<!--Moddal Tambah-->
<!--===================================================-->
<?php echo form_open_multipart('inventory/Tambah'); ?>
<div class="modal fade" id="modal-tambah" role="dialog" tabindex="-1" aria-labelledby="modal-tambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title">Tambah Data - (<?= $title; ?>)</h4>
            </div>

            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group">

                    <label class="control-label"><b>Nama Inventory</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-bookmark-alt"></i></span>
                        <input type="text" class="form-control" name="nama_inventory" placeholder="Nama Inventory" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>

                    <label class="control-label"><b>Kebutuhan</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-star"></i></span>
                        <input type="text" class="form-control" name="kebutuhan" placeholder="Kebutuhan" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                    </div>

                    <label class="control-label"><b>Deskripsi</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-notepad"></i></span>
                        <textarea placeholder="Deskripsi" name="deskripsi" rows="5" class="form-control" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
                    </div>

                    <label class="control-label"><b>Logo/Images</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-image"></i></span>
                        <input type="file" class="form-control" name="images" id="userfile" onchange="tampilkanPreview(this,'preview')" />
                        <img id="preview" width="100" />
                    </div>

                    <label class="control-label"><b>Status</b></label>
                    <div class="input-group mar-btm">
                        <span class="input-group-addon"><i class="ti-check"></i></span>
                        <select class="form-control selectpicker" name="status">
                            <option value="">--- Pilih Status ---</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>

                </div>
            </div>

            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<!--===================================================-->
<!--End Modal Tambah-->