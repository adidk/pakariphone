<div class="row">
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label class="control-label col-md-12 h4 font-weight-bold">Pilih Kemungkinan Kerusakan!</label>
                    <div class="col-md-12">
                        <?php foreach ($cekkerusakan as $cek) : ?>
                            <div class="custom-control custom-radio mt-1 mb-1">
                                <input type="radio" id="<?= $cek['id_kerusakan'] ?>" name="kerusakancek" class="custom-control-input" value="<?= $cek['id_kerusakan'] ?>">
                                <label class="custom-control-label" for="<?= $cek['id_kerusakan'] ?>"><?= $cek['nama_konsultasi'] ?></label>
                            </div>
                            <span class="help-block"></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-12 font-weight-bold">Pilih Device Anda</label>
                    <div class="col-md-12">
                        <select id="id_g" name="id_g" class="form-control">
                            <option value="" selected>Pilih</option>
                            <?php foreach ($device as $dvc) : ?>
                                <option value="<?= $dvc['id_device']; ?>"><?= $dvc['name_device'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <button onclick="submit()" type="button" class="btn btn-rounded btn-primary">Pilih</button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Apakah hanpone anda menyala ?</h3>
                <a href="javascript:void(0)" class="btn btn-sm btn-rounded btn-primary"><i class="fa fa-check"></i> Iya</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-rounded btn-danger"><i class="fa fa-times"></i> Tidak</a>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card">
            <div class="card-body">
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