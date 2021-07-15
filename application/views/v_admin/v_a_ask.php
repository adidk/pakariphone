<div class="row">
    <div class="col-lg-5">
        <div id="kemungkinan" class="card animate__animated  animate__fadeInUp">
            <div class="card-body ">
                <form action="#" id="form-kemungkinan">
                    <div class="form-group">
                        <label class="control-label col-md-12 text-black font-weight-bold">Pilih Kemungkinan Kerusakan!</label>
                        <div class="col-md-12">
                            <?php foreach ($cekkerusakan as $cek) : ?>
                                <div class="custom-control custom-radio mt-1 mb-1">
                                    <input type="radio" id="<?= $cek['id_kerusakan'] ?>" name="id_kemungkinan" class="custom-control-input" value="<?= $cek['id_kerusakan'] ?>">
                                    <label class="custom-control-label" for="<?= $cek['id_kerusakan'] ?>"><?= $cek['nama_konsultasi'] ?></label>
                                </div>
                            <?php endforeach; ?>
                            <span class="help-block" id="eror_kemungkinan" style="display: none">Pilih salah satu kemungkinan</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-12 text-black font-weight-bold ">Pilih Device Anda</label>
                        <div class="col-md-12">
                            <select id="id_dvc" name="id_dvc" class="form-control">
                                <option value="" disabled selected>Pilih</option>
                                <?php foreach ($device as $dvc) : ?>
                                    <option value="<?= $dvc['id_device']; ?>"><?= $dvc['name_device'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                </form>
                <div class="col-md-12">
                    <button type="submit" onclick="simpan()" class="btn btn-rounded btn-primary">Pilih</button>
                </div>
            </div>
        </div>
        <div id="pertanyaan-card" class="card animate__animated  animate__fadeInUp">
            
        </div>
        <div id="jawaban-kerusakan" class="card animate__animated  animate__fadeInUp">
            
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
                <p id="text-askcookies">

                </p>
                <div class="table-responsive">
                    <table id="ask" class="table table-striped table-bordered no-wrap">
                        <thead>
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>