<script type="text/javascript">
    var save_method_r; //for save method string
    var table_r;
    var base_url = '<?php echo base_url(); ?>';

    $(document).ready(function() {

        //datatables
        table_r = $('#aturan').DataTable({

            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/expert/ajax_list_r') ?>",
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
        //bikin eror select
        // $("select").change(function() {
        //     $(this).parent().parent().removeClass('has-error');
        //     $(this).next().empty();
        // });

    });


    function add_r() {

        $('#id_pk').select2({
            multiple: true,
        });
        save_method_r = 'add';
        $('#form')[0].reset(); // reset form on modals
        $("#id_pk").val('').trigger('change');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url: "<?php echo site_url('admin/expert/count_r') ?>",
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_r"]').val(data.id_r);
                $('#modal_form').modal('show'); // show bootstrap modal
                $('.modal-title').text('Tambah Aturan'); // Set Title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function edit_r(id) {
        save_method_r = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string


        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('admin/expert/edit_r') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                const pertanyaan = data.id_pertanyaan;
                $('#id_pk').select2({
                    multiple: true,
                });
                console.log(pertanyaan);
                $('#id_pk').val(pertanyaan).trigger('change');

                $('[name="id_r"]').val(data.id_rule);
                $('[name="id_kr"]').val(data.id_kerusakan);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Rule'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table() {
        table_r.ajax.reload(null, false); //reload datatable ajax 
    }

    function save_r() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method_r == 'add') {
            url = "<?php echo site_url('admin/expert/add_r') ?>";
        } else {
            url = "<?php echo site_url('admin/expert/update_r') ?>";
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

    function delete_r(id) {
        if (confirm('Are you sure delete this data?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('admin/expert/delete_r') ?>/" + id,
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
                <h3 class="modal-title">Pertanyaan</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-12">ID&nbspAturan</label>
                            <div class="col-md-12">
                                <input name="id_r" placeholder="ID Aturan" class="form-control" type="text" readonly>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">Pertanyaan</label>
                            <div class="col-md-12">
                                <select id="id_pk" name="id_pk[]" data-placeholder="Pilih beberapa pertanyaan" multiple="multiple" class="custom-select">
                                    <?php foreach ($pertanyaan as $pk) : ?>
                                        <option value="<?= $pk['id_pertanyaankerusakan']; ?>"><?= $pk['pertanyaan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-12">Kerusakan</label>
                            <div class="col-md-12">
                                <select id="id_kr" name="id_kr" class="form-control">
                                    <option value=" " selected>Pilih</option>
                                    <?php foreach ($kerusakan as $kr) : ?>
                                        <option value="<?= $kr['id_kerusakan']; ?>"><?= $kr['nama_kerusakan'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save_r()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--modal device -->

<script src="<?= base_url() ?>assets/select2/dist/js/select2.min.js"></script>

<script type="text/javascript">

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