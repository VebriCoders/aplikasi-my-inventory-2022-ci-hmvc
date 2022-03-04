<!--JAVASCRIPT-->
<!--=================================================-->

<!--jQuery [ REQUIRED ]-->
<script src="<?php echo base_url('assets/admin-template/') ?>js/jquery.min.js"></script>
<script src="<?php echo base_url('assets/admin-template/') ?>js/jquery.mask.min.js"></script>

<!--BootstrapJS [ RECOMMENDED ]-->
<script src="<?php echo base_url('assets/admin-template/') ?>js/bootstrap.min.js"></script>

<!--NiftyJS [ RECOMMENDED ]-->
<script src="<?php echo base_url('assets/admin-template/') ?>js/nifty.min.js"></script>

<!--=================================================-->

<!--Flot Chart [ OPTIONAL ]-->
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/flot-charts/jquery.flot.min.js"></script>
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/flot-charts/jquery.flot.resize.min.js"></script>
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/flot-charts/jquery.flot.tooltip.min.js"></script>

<!--Sparkline [ OPTIONAL ]-->
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/sparkline/jquery.sparkline.min.js"></script>

<!--Bootstrap Select [ OPTIONAL ]-->
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/bootstrap-select/bootstrap-select.min.js"></script>

<!--DataTables [ OPTIONAL ]-->
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url('assets/admin-template/') ?>plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Specify page [ SAMPLE ]-->
<!-- <script src="<?php echo base_url('assets/admin-template/') ?>js/demo/form-file-upload.js"></script> -->
<!-- <script src="<?php echo base_url('assets/admin-template/') ?>js/demo/dashboard.js"></script> -->

<script>
    $(document).ready(function() {
        $(".preloader").fadeOut();
    })
</script>

<script type="text/javascript">
    function gambar(val) {
        $("#foto").attr('src', URL.createObjectURL(event.target.files[0]));
    }
</script>

<script>
    $('#demo-dt-basic').dataTable({
        "responsive": true,
        "language": {
            "paginate": {
                "previous": '<i class="demo-psi-arrow-left"></i>',
                "next": '<i class="demo-psi-arrow-right"></i>'
            }
        }
    });
</script>

<script type="text/javascript">
    function tampilkanPreview(userfile, idpreview) {
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

<script type="text/javascript">
    $(document).ready(function() {

        // Format mata uang.
        $('.uang').mask('000.000.000', {
            reverse: true
        });

    })
</script>