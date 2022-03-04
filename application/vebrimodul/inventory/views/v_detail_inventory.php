<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <div id="page-head">

        <!--Page Title-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <div id="page-title">
            <h1 class="page-header text-overflow"><?= $title ?> - <?php echo $tampilData_Inventory->nama_inventory; ?></h1>
        </div>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--End page title-->


        <!--Breadcrumb-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('dashboard') ?>"><i class="demo-pli-home"></i></a></li>
            <li><a href="<?php echo base_url('inventory') ?>">Inventory</a></li>
            <li class="active"><?= $title ?> - <?php echo $tampilData_Inventory->nama_inventory; ?></li>
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
            <div class="col-sm-6 toolbar-left text-right">
                <button class="btn btn-default btn-labeled" onclick="window.location.href='<?php echo base_url('inventory') ?>'"><i class="btn-label ti-arrow-circle-left"></i>Kembali</button>
            </div>
            <div class="col-sm-6 toolbar-right text-right">
                <button class="btn btn-success btn-labeled" data-target="#modal-tambah" data-toggle="modal"><i class="btn-label ti-import"></i> Tambah</button>
                <a href="<?php echo base_url('inventory/cetak_invoice/' . $tampilData_Inventory->slug) ?>" target="_blank"><button class="btn btn-mint btn-labeled"><i class="btn-label demo-pli-printer"></i>Cetak Invoice</button></a>
            </div>
        </div>
        <!---------------------------------->

        <div class="row demo-nifty-panel" style="margin-top: 20px">
            <div class="col-sm-6">
                <!--Success Panel-->
                <!--===================================================-->
                <div class="panel panel-bordered panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">Jumlah Harga Total</h3>
                    </div>
                    <div class="panel-body">
                        <h1 class="text-center">Rp.<?php echo number_format($hitungJumlahBarangHarga, 0, ",", "."); ?></h1>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Success Panel-->
            </div>
            <div class="col-sm-3">
                <!--Success Panel-->
                <!--===================================================-->
                <div class="panel panel-bordered panel-mint">
                    <div class="panel-heading">
                        <h3 class="panel-title">Jumlah Barang</h3>
                    </div>
                    <div class="panel-body">
                        <h1 class="text-center"><?php echo $hitungJumlahBarang; ?></h1>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Success Panel-->
            </div>
            <div class="col-sm-3">
                <!--Success Panel-->
                <!--===================================================-->
                <div class="panel panel-bordered panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Total Barang</h3>
                    </div>
                    <div class="panel-body">
                        <h1 class="text-center"><?php echo floor($hitungJumlahBarangTotal); ?></h1>
                    </div>
                </div>
                <!--===================================================-->
                <!--End Success Panel-->
            </div>
        </div>

        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title"> Data Barang Inventory</h3>
            </div>
            <div class="panel-body">
                <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="min-width">Gambar</th>
                            <th class="min-width">Barang</th>
                            <th class="min-width">Nama Barang</th>
                            <th class="min-width">Deskripsi</th>
                            <th class="min-width">Harga</th>
                            <th class="min-width">Jumlah</th>
                            <th class="min-width">Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($tampilData_Detail->result() as $data) { ?>
                            <tr>
                                <td class="min-width"><?php echo $i; ?></td>
                                <td>
                                    <?php if ($data->images == "default.jpg") { ?>
                                        <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="<?php echo base_url("assets/img/default.jpg") ?>">
                                    <?php } else { ?>
                                        <img alt="Profile Picture" class="img-lg img-circle mar-ver" src="<?php echo base_url("assets/upload/images/data_barang_inventory/") ?><?php echo $data->images ?>">
                                    <?php } ?>
                                </td>
                                <td><?php echo $data->barang ?></td>
                                <td><?php echo $data->nama_barang ?></td>
                                <td>
                                    <?php $jml_karakter =  strlen($data->deskripsi) ?>
                                    <?php if ($jml_karakter >= 70) { ?>
                                        <p class="text-sm add-tooltip" data-toggle="tooltip" data-container="body" data-placement="bottom" data-original-title="<?php echo $data->deskripsi ?>"><?php echo substr($data->deskripsi, 0, 70) ?>...</p>
                                    <?php } else { ?>
                                        <p class="text-sm add-tooltip" data-toggle="tooltip" data-container="body" data-placement="bottom" data-original-title="<?php echo $data->deskripsi ?>"><?php echo substr($data->deskripsi, 0, 70) ?></p>
                                    <?php } ?>
                                </td>
                                <td>Rp.<?php echo number_format($data->harga, 0, ",", ".") ?></td>
                                <td><?php echo $data->jumlah ?></td>
                                <td>Rp.<?php echo number_format($data->total, 0, ",", ".") ?></td>
                                <td class="min-width">
                                    <div class="btn-groups">
                                        <a class="btn btn-primary btn-labeled" href="<?php echo $data->external_link ?>" target="_blank"><i class="btn-label ti-link"></i> Link Produk</a>
                                        <button class="btn btn-warning btn-labeled" data-target="#modal-edit-<?php echo $data->id ?>" data-toggle="modal"><i class="btn-label ti-pencil"></i> Edit</button>
                                        <button class="btn btn-danger btn-labeled" data-target="#modal-hapus-<?php echo $data->id ?>" data-toggle="modal"><i class="btn-label ti-trash"></i> Hapus</button>
                                    </div>
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


<!--Moddal Tambah-->
<!--===================================================-->
<?php echo form_open_multipart('inventory/Tambah_Barang/' . $tampilData_Inventory->slug); ?>
<div class="modal fade" id="modal-tambah" role="dialog" tabindex="-1" aria-labelledby="modal-tambah" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                <h4 class="modal-title">Tambah Barang Inventory - (<?php echo $tampilData_Inventory->nama_inventory ?>)</h4>
            </div>

            <!--Modal body-->
            <div class="modal-body">
                <div class="form-group">

                    <div class="eq-height">
                        <div class="col-lg-6 eq-box-lg">

                            <label class="control-label"><b>Nama Inventory</b></label>
                            <div class="input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-bookmark-alt"></i></span>
                                <input type="text" class="form-control" name="nama_inventory" readonly placeholder="<?php echo $tampilData_Inventory->nama_inventory ?>" required>
                                <input type="hidden" name="id_inventory" value="<?php echo $tampilData_Inventory->id ?>">
                                <input type="hidden" name="slug_inventory" value="<?php echo $tampilData_Inventory->slug ?>">
                            </div>

                            <label class="control-label"><b>Barang</b></label>
                            <div class="input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-package"></i></span>
                                <input type="text" class="form-control" name="barang" placeholder="Jenis Barang" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>

                            <label class="control-label"><b>Nama Barang</b></label>
                            <div class="input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-shopping-cart-full"></i></span>
                                <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>

                            <label class="control-label"><b>Deskripsi</b></label>
                            <div class="input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-notepad"></i></span>
                                <textarea placeholder="Deskripsi" name="deskripsi" rows="5" class="form-control" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"></textarea>
                            </div>

                        </div>

                        <div class="col-lg-6 eq-box-lg">

                            <label class="control-label"><b>External Link</b></label>
                            <div class="input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-link"></i></span>
                                <input type="text" class="form-control" name="external_link" placeholder="External Link" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>

                            <label class="control-label"><b>Harga Barang</b></label>
                            <div class="input-group mar-btm">
                                <span class="input-group-addon">Rp.</span>
                                <input type="text" class="form-control uang" name="harga" placeholder="Harga Barang" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>

                            <label class="control-label"><b>Jumlah Barang</b></label>
                            <div class="input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-files"></i></span>
                                <input type="number" class="form-control" name="jumlah" placeholder="Jumlah Barang" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                            </div>

                            <label class="control-label"><b>Logo/Images</b></label>
                            <div class="input-group mar-btm">
                                <span class="input-group-addon"><i class="ti-image"></i></span>
                                <input type="file" class="form-control" name="images" id="userfile" onchange="tampilkanPreview(this,'preview')" />
                                <img id="preview" width="100" />
                            </div>

                        </div>
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


<?php
$i = 1;
foreach ($tampilData_Detail->result() as $data) { ?>
    <!--Moddal Edit-->
    <!--===================================================-->
    <?php echo form_open_multipart('inventory/Edit_Barang/' . $tampilData_Inventory->slug); ?>
    <div class="modal fade" id="modal-edit-<?php echo $data->id ?>" role="dialog" tabindex="-1" aria-labelledby="modal-tambah" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Edit Barang Inventory - (<?php echo $data->nama_barang ?>)</h4>
                </div>

                <!-- ID Untuk Query Where -->
                <input type="hidden" name="query_id" value="<?php echo $data->id ?>">

                <!--Modal body-->
                <div class="modal-body">
                    <div class="form-group">

                        <div class="eq-height">
                            <div class="col-lg-6 eq-box-lg">

                                <label class="control-label"><b>Nama Inventory</b></label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="ti-bookmark-alt"></i></span>
                                    <input type="text" class="form-control" name="nama_inventory" readonly placeholder="<?php echo $tampilData_Inventory->nama_inventory ?>" required>
                                    <input type="hidden" name="id_inventory" value="<?php echo $tampilData_Inventory->id ?>">
                                    <input type="hidden" name="slug_inventory" value="<?php echo $tampilData_Inventory->slug ?>">
                                </div>

                                <label class="control-label"><b>Barang</b></label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="ti-package"></i></span>
                                    <input type="text" class="form-control" name="barang" value="<?php echo $data->barang ?>" placeholder="Jenis Barang" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label class="control-label"><b>Nama Barang</b></label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="ti-shopping-cart-full"></i></span>
                                    <input type="text" class="form-control" name="nama_barang" value="<?php echo $data->nama_barang ?>" placeholder="Nama Barang" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label class="control-label"><b>Deskripsi</b></label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="ti-notepad"></i></span>
                                    <textarea placeholder="Deskripsi" name="deskripsi" rows="5" class="form-control" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')"><?php echo $data->deskripsi ?></textarea>
                                </div>

                            </div>

                            <div class="col-lg-6 eq-box-lg">

                                <label class="control-label"><b>External Link</b></label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="ti-link"></i></span>
                                    <input type="text" class="form-control" name="external_link" value="<?php echo $data->external_link ?>" placeholder="External Link" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label class="control-label"><b>Harga Barang</b></label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon">Rp.</span>
                                    <input type="text" class="form-control uang" name="harga" value="<?php echo $data->harga ?>" placeholder="Harga Barang" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label class="control-label"><b>Jumlah Barang</b></label>
                                <div class="input-group mar-btm">
                                    <span class="input-group-addon"><i class="ti-files"></i></span>
                                    <input type="number" class="form-control" name="jumlah" value="<?php echo $data->jumlah ?>" placeholder="Jumlah Barang" required oninvalid="this.setCustomValidity('Data Tidak Boleh Kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label class="control-label"><b>Logo/Images</b></label>
                                <div class="input-group mar-btm">
                                    <input type="hidden" name="images_lama" value="<?php echo $data->images ?>">
                                    <span class="input-group-addon"><i class="ti-image"></i></span>
                                    <input type="file" class="form-control" name="images" value="<?php echo $data->images ?>" id="userfile" onchange="tampilkanPreview<?php echo $i; ?>(this,'preview-<?php echo $i; ?>')" />
                                    <p>Foto Anda Sebelumnya : <?php echo $data->images ?></p>
                                    <img id="preview-<?php echo $i; ?>" width="100" />
                                </div>


                            </div>
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
    <?php echo form_open_multipart('inventory/Hapus_Barang/' . $tampilData_Inventory->slug . '/' . $data->id); ?>
    <div class="modal fade" id="modal-hapus-<?php echo $data->id ?>" role="dialog" tabindex="-1" aria-labelledby="modal-hapus" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

                <!--Modal header-->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><i class="pci-cross pci-circle"></i></button>
                    <h4 class="modal-title">Hapus Data - <?php echo $data->nama_barang ?></h4>
                </div>

                <!--Modal body-->
                <div class="modal-body">
                    <p>Apakah Kamu Yakin Akan Menghapus Data <b><?php echo $data->nama_barang ?></b> Pada Inventory <b><?php echo $tampilData_Inventory->nama_inventory ?></b> ? </p>
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