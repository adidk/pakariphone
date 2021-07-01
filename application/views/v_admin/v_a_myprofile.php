<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body text-center">
                <div class="profile-pic mb-3 mt-3">
                    <img src="<?= base_url() ?>assets/images/users/5.jpg" width="150" class="rounded-circle" alt="user" />
                    <h4 class="mt-3 mb-0">Daniel Kristeen</h4>
                    <h4 class="mb-0">danielkristeen@gmail.com</h4>
                </div>
            </div>
            <div class="p-4 border-top mt-3">
                <div class="row text-center">
                    <div class="col-12">
                        <a href="#" class="link d-flex align-items-center justify-content-center font-weight-medium">
                            <span class="badge bg-primary font-12 text-white font-weight-medium badge-pill ml-2 d-md-none d-lg-block">3</span> Asking</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Profile</h4>
                <form class="mt-3">
                    <div class="form-group">
                        <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="First Name" value="Daniel" readonly>
                        <small id="name" class="form-text text-muted">First Name</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Last Name" value="Kristeen" readonly>
                        <small id="name" class="form-text text-muted">Last Name</small>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="female" name="gender" class="custom-control-input" value="female">
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="male" name="gender" class="custom-control-input" value="male">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <small id="name" class="form-text text-muted">Gender</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Phone Number" value="6238749083745">
                        <small id="name" class="form-text text-muted">Phone Number</small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Email" value="danielkristeen@gmail.com" readonly>
                        <small id="name" class="form-text text-muted">Email</small>
                    </div>

                    <button type="sumbit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>