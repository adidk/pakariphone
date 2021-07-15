<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Change Password</h4>
                <form class="mt-3">
                    <div class="form-group">
                        <input type="password" class="form-control" id="current_pass" aria-describedby="name" placeholder="First Name" value="password">
                        <small id="name" class="form-text text-muted">Current Password</small>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" aria-describedby="name" placeholder="Masukkan Password" value="password">
                        <small id="name" class="form-text text-muted">Password</small>
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password2" aria-describedby="name" placeholder="Ulangi Password" value="password">
                        <small id="name" class="form-text text-muted">Ulangi Password</small>
                        <?php echo form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <button type="sumbit" class="btn btn-primary">Tambah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>