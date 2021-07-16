<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?=$tittle?></h4>
                <form class="mt-3" method="POST">
                    <div class="form-group">
                        <input type="password" class="form-control" id="current_pass" aria-describedby="name" placeholder="Masukkan password" name="password" value="">
                        <?php echo form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password1" aria-describedby="name" placeholder="Ulangi password" value="">
                        <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>

                    </div>

                    <button type="sumbit" class="btn btn-primary"><?=$tittle?></button>
                </form>
            </div>
        </div>
    </div>
</div>