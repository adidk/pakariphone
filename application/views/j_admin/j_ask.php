<script type="text/javascript">
    var save_method; //for save method string
    var table_ask;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {

        //datatables
        table_ask = $('#ask').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/ask/ajax_list_ask') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [-1], //last column
                "orderable": false, //set not orderable
            }, ],

        });

        $('#pertanyaan-card').hide();

        $('#text-askcookies').load("<?php echo base_url() ?>admin/ask/load_ask");

        //set input/textarea/select event when change value, remove class error and remove text help block 
        // $("#id_dvc").change(function() {
        //     $(this).parent().parent().removeClass('has-error');
        //     $(this).next().empty();
        // });
        // $("textarea").change(function() {
        //     $(this).parent().parent().removeClass('has-error');
        //     $(this).next().empty();
        // });
        $("#id_dvc").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });

    function reload_table() {
        table_ask.ajax.reload(null, false); //reload datatable ajax 
    }

    function reload_pertanyaan(id_konsultasi) {
        $('#pertanyaan-card').hide().removeClass('animate__animated  animate__fadeOutUp');
        $('#pertanyaan-card').load("<?php echo base_url() ?>admin/ask/reload_ask/" + id_konsultasi).addClass('animate__animated  animate__fadeInUp').show();
    }

    function save(id) {

        // ajax adding data to database
        var formData = new FormData($('#form_q')[0]);
        $.ajax({
            url: "<?php echo site_url('admin/ask/save_jawaban') ?>/" + id,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                $('#pertanyaan-card').addClass('animate__animated  animate__fadeOutUp');
                setTimeout(function() {
                    $('#pertanyaan-card').hide();
                }, 900);
                setTimeout(function() {
                    reload_pertanyaan(data.id_konsultasi);
                    reload_table();
                }, 900);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Saat Menyimpan Jawaban');
            }
        });
    }


    function simpan() {
        var formData = new FormData($('#form-kemungkinan')[0]);

        //Set the Valid Flag to True if one RadioButton from the Group of RadioButtons is checked.
        var valkemungkinan = $("input[name=id_kemungkinan]").is(":checked");
        //Display error message if no RadioButton is checked.
        $("#eror_kemungkinan")[0].style.display = valkemungkinan ? "none" : "block";

        $.ajax({
            url: "<?php echo site_url('admin/ask/save_device') ?>",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $('#kemungkinan').addClass('animate__animated  animate__fadeOutUp');
                    setTimeout(function() {
                        $('#kemungkinan').hide();
                    }, 900);
                    setTimeout(function() {
                        $('#pertanyaan-card').load("<?php echo base_url() ?>admin/ask/pertanyaan").show();
                    }, 900);

                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }

                $('#text-askcookies').load("<?php echo base_url() ?>admin/ask/load_ask");


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error simpan data');

            }
        })

    }
</script>


<!-- apps -->
<script src="<?= base_url() ?>dist/js/app-style-switcher.js"></script>
<script src="<?= base_url() ?>dist/js/feather.min.js"></script>
<script src="<?= base_url() ?>assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="<?= base_url() ?>dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="<?= base_url() ?>dist/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="<?= base_url() ?>assets/extra-libs/c3/d3.min.js"></script>
<script src="<?= base_url() ?>assets/extra-libs/c3/c3.min.js"></script>
<script src="<?= base_url() ?>assets/libs/chartist/dist/chartist.min.js"></script>
<script src="<?= base_url() ?>assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="<?= base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="<?= base_url() ?>assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="<?= base_url() ?>dist/js/pages/dashboards/dashboard1.min.js"></script>





</body>

</html>