<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tamabahkan Password</h4>
                <form class="mt-3" method="POST">
                    <div class="form-group">
                        <input type="password" class="form-control" id="current_pass" aria-describedby="name" placeholder="First Name"  name="password" value="<?= $user['password'] ?>">
                        <small id="name" class="form-text text-muted">Tambahkan Password</small>
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password1" aria-describedby="name" placeholder="Phone Number" value="<?= $user['password'] ?>">
                        <small id="name" class="form-text text-muted">Ulangi Password</small>
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>
                   
                    <button type="sumbit" class="btn btn-primary">Tambah Password</button>
                </form>
            </div>
        </div>
    </div>
</div>