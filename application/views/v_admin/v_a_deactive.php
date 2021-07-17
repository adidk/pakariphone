<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Deactive Account</h4>
                <p class="text-danger text-justify "><b>Ingat jika anda menonaktifkan akunmu maka kamu tidak akan bisa mengakses sistem kami termasuk mengakses ke sistem pakar untuk mengecek kerusakan iphone. Jika kamu ingin mengakses sistem kami kembali maka kamu harus melakukan pendaftaran dari awal dan mengatur akun dari awal. Jadi jika kamu tidak yakin untuk melakukan penghapusan akun maka jangan lakukan hal tersebut.</b></p>
                <form action="<?= base_url() ?>admin/personalitation/delete_facebook" method="post" class="mt-3">
                    <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="agree" name="agree" value="1">
                        <label class="custom-control-label" for="agree">Saya telah membaca dan saya setuju.</label>
                    </div>

                    <button id="deactive" onclick="confirm_delete()" type="sumbit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>