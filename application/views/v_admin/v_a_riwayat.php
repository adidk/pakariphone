<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title"><?= $user_konsultasi['first_name'] . ' ' . $user_konsultasi['last_name'] ?></h4>
                        <p class="m-0">Nomor telfon : <?= $user_konsultasi['phone'] ?></p>
                        <p class="m-0">Email : <?= $user_konsultasi['email'] ?></p>
                        <p class="m-0">Pengguna ini telah melakukan konsultasi sebanyak <?= $riwayat ?> kali. Tabel dibawah merupakan hasil pertanyaan yang diajukan pengguna.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tipe Device</th>
                                <th>Picture</th>
                                <th>Kerusakan</th>
                                <th>Waktu Konsultasi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Tipe Device</th>
                                <th>Picture</th>
                                <th>Kerusakan</th>
                                <th>Waktu Konsultasi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>