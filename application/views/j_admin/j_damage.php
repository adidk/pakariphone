<script type="text/javascript">
    var save_method_damage; //for save method string
    var table_damage;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {

        //datatables
        table_damage = $('#kerusakan').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/expert/ajax_list_dmg') ?>",
                "type": "POST"
            },

            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [-1], //last column
                "orderable": false, //set not orderable
            }, ],

        });


        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });


    function add_dmg() {
        save_method_damage = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url: "<?php echo site_url('admin/expert/count_dmg') ?>",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_dmg"]').val(data.id_dmg);
                $('#modal_form').modal('show'); // show bootstrap modal
                $('.modal-title').text('Tambah Kerusakan'); // Set Title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function edit_dmg(id) {
        save_method_damage = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string


        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('admin/expert/edit_dmg') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id_dmg"]').val(data.id_kerusakan);
                $('[name="nama_dmg"]').val(data.nama_kerusakan);
                $('[name="keterangan_dmg"]').val(data.deskripsi_kerusakan);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Kerusakan'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table() {
        table_damage.ajax.reload(null, false); //reload datatable ajax 
    }

    function save_dmg() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method_damage == 'add') {
            url = "<?php echo site_url('admin/expert/add_dmg') ?>";
        } else {
            url = "<?php echo site_url('admin/expert/update_dmg') ?>";
        }

        // ajax adding data to database
        var formData = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data) {
                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]); //select span help-block class set text error string
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }

    function delete_dmg(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('admin/expert/delete_dmg') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>

<!--modal device -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Kerusakan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-12">ID Kerusakan</label>
                            <div class="col-md-12">
                                <input name="id_dmg" placeholder="ID Kerusakan" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">Nama&nbspKerusakan</label>
                            <div class="col-md-12">
                                <input name="nama_dmg" placeholder="Nama Kerusakan" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">Keterangan</label>
                            <div class="col-md-12">
                                <textarea name="keterangan_dmg" placeholder="Keterangan" class="form-control" rows="5"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_dmg()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal device -->

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

<script>
    $(document).ready(function() {
        $('#rule').DataTable();
    });
</script>


</body>

</html>