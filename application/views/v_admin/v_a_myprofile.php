<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body text-center">
                <div class="profile-pic mb-3 mt-3">
                    <img src="<?= $user['picture'] ?>" width="50" class="rounded-circle" alt="user" />
                    <h4 class="mt-3 mb-0"><?= $user['first_name'] . ' ' . $user['last_name']; ?> </h4>
                    <h4 class="mb-0"><?= $user['email'] ?></h4>
                </div>
            </div>
            <div class="p-4 border-top mt-3">
                <div class="row text-center">
                    <div class="col-12">
                        <a href="#" class="link d-flex align-items-center justify-content-center font-weight-medium">
                            <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block"><?= $pertanyaan_dijawab ?></span> Bertanya</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Profile</h4>
                <?= $this->session->flashdata('message') ?>
                <form action="" class="mt-3" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="First Name" value="<?= $user['first_name'] ?>" readonly>
                        <small id="name" class="form-text text-muted">Nama Depan</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Last Name" value="<?= $user['last_name'] ?>" readonly>
                        <small id="name" class="form-text text-muted">Nama Belakang</small>
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">
                            <input type="radio" class="" name="gender" value="Perempuan" <?= $perempuan ?>>
                            Perempuan
                        </label>
                        <label class="form-check-label">
                            <input type="radio" class="" name="gender" value="laki - laki" <?= $lakilaki ?>>
                            Laki laki
                        </label>
                        <small id="gender" class="form-text text-muted">Jenis Kelamin</small>

                    </div>
                    <div class="form-group">
                        <input type="number" class="form-control" name="phone" aria-describedby="name" placeholder="Phone Number" value="<?= $user['phone'] ?>">
                        <?php echo form_error('phone', '<small class="text-danger pl-3">', '</small>'); ?>
                        <small id="name" class="form-text text-muted">Phone Number</small>

                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Email" value="<?= $user['email'] ?>" readonly>
                        <small id="name" class="form-text text-muted">Email</small>
                    </div>

                    <button type="sumbit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>