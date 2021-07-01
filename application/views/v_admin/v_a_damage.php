<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <button class="btn btn-rounded btn-primary float-right mb-3" onclick="add_dmg()"><i class="fas fa-plus"></i></i> Add Device</button>
                <button class="btn btn-rounded btn-primary float-right mb-3" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
                <div class="table-responsive">
                    <table id="kerusakan" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Damage&nbspCode</th>
                                <th>Damage&nbspName</th>
                                <th>Descriprion</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Damage&nbspCode</th>
                                <th>Damage&nbspName</th>
                                <th>Descriprion</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>