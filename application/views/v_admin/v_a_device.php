<div class="row">
    <div class="col-lg-12">
        <?= $this->session->flashdata('message'); ?>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-rounded btn-primary float-right mb-3" onclick="add_dvc()"><i class="fas fa-plus"></i></i> Add Device</button>
                <button class="btn btn-rounded btn-primary float-right mb-3" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                <div class="table-responsive">
                    <table id="device" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Device&nbspCode</th>
                                <th>Device&nbspVersion</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Device&nbspCode</th>
                                <th>Device&nbspVersion</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

