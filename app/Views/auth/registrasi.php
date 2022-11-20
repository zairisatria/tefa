<!-- menangkap layout template -->
<?= $this->extend('auth/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Pendaftaran</title>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- menampilkan isi content secara dinamis -->
<?php $validation =  \Config\Services::validation() ?>

        <!-- Section -->
        <section class="min-vh-100 d-flex bg-primary align-items-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-6 justify-content-center mt-4 mb-4">
                        <div class="card bg-primary shadow-soft border-light p-4">
                            <div class="card-header text-center pb-0">
                                <h2 class="mb-0 h5">Pendaftaran Akun</h2>                               
                            </div>
                            <div class="card-body">
                            <form method="POST" action="<?=site_url('/proses_registrasi')?>" enctype="multipart/form-data" class="needs-validation">
                            <?= csrf_field() ?>
                                    <!-- Form -->
                                    <div class="form-group">
                                        <label for="nama">Nama <span class="text-danger">*</span></label>
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><span class="fas fa-edit"></span></span>
                                          </div>
                                          <input class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Fullname" type="text" aria-label="fullname" autofocus required>
                                          <div class="invalid-feedback">
                                            <?= $error = $validation->getError('nama'); ?>
                                          </div>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form -->
                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><span class="fas fa-envelope"></span></span>
                                            </div>
                                            <input class="form-control <?= $validation->hasError('email') ? 'is-invalid' : null ?>" id="email" name="email" value="<?= old('email') ?>" placeholder="example@company.com" type="text" aria-label="email address" required>
                                            <div class="invalid-feedback">
                                              <?= $error = $validation->getError('email'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form -->
                                    <div class="form-group">
                                        <label for="username">Nama Pengguna <span class="text-danger">*</span></label>
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><span class="fas fa-edit"></span></span>
                                            </div>
                                            <input class="form-control <?= $validation->hasError('username') ? 'is-invalid' : null ?>" id="username" name="username" value="<?= old('username') ?>" placeholder="User account" type="text" aria-label="user account" required>
                                            <div class="invalid-feedback">
                                              <?= $error = $validation->getError('username'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <div class="form-group">
                                        <!-- Form -->
                                        <div class="form-group">
                                            <label for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
                                                </div>
                                                <input class="form-control <?= $validation->hasError('password') ? 'is-invalid' : null ?>" id="password" name="password" value="<?= old('password') ?>" placeholder="Password" type="password" aria-label="Password" required>
                                                <div class="invalid-feedback">
                                                  <?= $error = $validation->getError('password'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Form -->
                                        <!-- Form -->
                                        <div class="form-group">
                                            <label for="password2">Ulangi Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
                                                </div>
                                                <input class="form-control <?= $validation->hasError('password2') ? 'is-invalid' : null ?>" id="password2" name="password2" value="<?= old('password2') ?>" placeholder="Repeat password" type="password" aria-label="Password" required>
                                                <div class="invalid-feedback">
                                                    <?= $error = $validation->getError('password2'); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END of Form -->
                                        <!-- Form -->
                                        <div class="form-group">
                                            <label class="my-1 mr-2" for="id_prodi">Program Studi</label>
                                            <select class="custom-select my-1 mr-sm-2" id="id_prodi" name="id_prodi" required>
                                                <option value="">Pilih...</option>
                                                <?php foreach ($prodi as $data) : ?>
                                                <option value="<?= $data['id']; ?>" <?php if (old('id_prodi') == $data['id']) {echo "selected";} ?> ><?= $data['prodi']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <!-- End of Form -->
                                        <!-- Form -->
                                        <div class="form-group">
                                            <label class="my-1 mr-2" for="sebagai">Daftar Sebagai</label>
                                            <select class="custom-select my-1 mr-sm-2" id="sebagai" name="sebagai" required>
                                                <option value="" >Pilih...</option>
                                                <option value="1" <?php if (old('sebagai') == '1') {echo "selected";} ?> >Ketua Kelompok</option>
                                                <option value="2" <?php if (old('sebagai') == '2') {echo "selected";} ?> >Anggota Kelompok</option>
                                            </select>
                                        </div>
                                        <!-- End of Form -->
                                        <!-- Form -->
                                        <div class="form-group" id="holder_token_kelompok">
                                            <label for="token_kelompok">Kode Kelompok</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><span class="fas fa-key"></span></span>
                                                </div>
                                                <input class="form-control" id="token_kelompok" name="token_kelompok" value="<?= old('token_kelompok') ?>" placeholder="Token Kelompok" type="text" aria-label="Token Kelompok">
                                            </div>
                                        </div>
                                        <!-- End of Form -->
                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" value="" id="term" required>
                                            <label class="form-check-label" for="term">
                                                I agree to the <a href="" data-toggle="modal" data-target="#ModalTermAndCondition">terms and conditions <span class="text-danger">*</span></a>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" id="registrasi" class="btn btn-block btn-primary">Sign Up</button>
                                </form>
                                <div class="d-block d-sm-flex justify-content-center align-items-center mt-4">
                                    <span class="font-weight-normal">
                                        Already have an account?
                                        <a href="<?=site_url('/login')?>" class="font-weight-bold">Login</a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!-- mencegah spasi ketika input password -->
<script>
$("#username").on({
keydown: function(e) {
if (e.which === 32)
    return false;
},
change: function() {
this.value = this.value.replace(/\s/g, "");
}
});
$("#password").on({
    keydown: function(e) {
    if (e.which === 32)
        return false;
    },
    change: function() {
    this.value = this.value.replace(/\s/g, "");
    }
});

$("#password2").on({
    keydown: function(e) {
    if (e.which === 32)
        return false;
    },
    change: function() {
    this.value = this.value.replace(/\s/g, "");
    }
});
</script>

<!-- show hide kode kelompok -->
<script>
    // sembunyikan dulu pertama kali
$("#holder_token_kelompok").hide();
$("#token_kelompok").hide();
document.getElementById("token_kelompok").required = false;
// tampilkan token jika daftar sebagai anggota kelompok
$(document).ready(function(){
    $("#sebagai").change(function() {
        if($(this).val() == "1") {
            $("#holder_token_kelompok").hide();
            $("#token_kelompok").hide();
            $("#token_kelompok").val("");
            document.getElementById("token_kelompok").required = false;
        }
        else {
            $("#holder_token_kelompok").show();
            $("#token_kelompok").show();
            document.getElementById("token_kelompok").required = true;
        }
    });
});
</script>

<!-- modal term and condition-->
<!-- Modal -->
<div class="modal fade" id="ModalTermAndCondition" tabindex="-1" role="dialog" aria-labelledby="ModalTermAndCondition" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Term and Condition Agreement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        1. Registrasi berarti anda sudah memahami & menyetujui segala ketentuan dari pihak pengembang <br>
        2. Fitur yang di sematkan sesuai dengan paket pilihan <br>
        3. Seluruh data yang ada menjadi milik developer dan boleh diolah menjadi informasi publik <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ya, Saya Paham</button>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>