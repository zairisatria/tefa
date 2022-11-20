<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Profil</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<!-- menampilkan isi content secara dinamis -->
<?php $validation =  \Config\Services::validation() ?>
<div class="section-header">
  <h1>Profil</h1>
</div>
<div class="section-body">
            <h2 class="section-title">Hi, <?= $users['nama']; ?>!</h2>
            <p class="section-lead">
              Ganti informasi tentang anda dan preferensi akun
            </p>

            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <form action="<?=site_url('/profile/update')?>" method="post" enctype="multipart/form-data" novalidate="">
                    <input type="text" name="gambarLama" value="<?= $users['photo']; ?>" hidden>
                    <img alt="foto profil" src="<?=base_url()?>/img/users/<?= $users['photo']; ?>" class="rounded-circle profile-widget-picture">
                  </div>
                  <div class="profile-widget-description">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                            <h4>Edit Profil</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Nama Lengkap</label>
                                    <input class="form-control <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" id="nama" name="nama" value="<?= old('nama', $users['nama']) ?>" placeholder="Your Name" type="text">
                                    <div class="invalid-feedback">
                                        <?= $error = $validation->getError('nama'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Telepon</label>
                                    <input class="form-control <?= $validation->hasError('telepon') ? 'is-invalid' : null ?>" id="telepon" name="telepon" value="<?= old('telepon', $users['telepon']) ?>" placeholder="Your Phone" type="text">
                                    <div class="invalid-feedback">
                                    <?= $error = $validation->getError('telepon'); ?>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="form-group col-md-6 col-12">
                                    <label>Username</label>
                                    <input class="form-control <?= $validation->hasError('username') ? 'is-invalid' : null ?>" id="username" name="username" value="<?= old('username', $users['username']) ?>" placeholder="Name Account" type="text">
                                    <div class="invalid-feedback">
                                    <?= $error = $validation->getError('username'); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-12">
                                    <label>Photo</label>
                                    <input type="file" class="form-control <?= $validation->hasError('gambar') ? 'is-invalid' : null ?>" id="gambar" name="gambar" onchange="previewImg()" value="<?= $users['photo']; ?>">
                                    <div class="invalid-feedback">
                                    <?= $error = $validation->getError('gambar'); ?>
                                    </div>
                                </div>
                            </div>
                            <p>
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Ganti Password
                                </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <p>
                                <div class="form-group col-md-12 col-sm-12 col-lg-5">
                                        <label for="old_password">Password Lama <small class="text-muted">(kosongkan jika password tidak diganti)</small></label>
                                            <input class="form-control form-control-sm" id="old_password" name="old_password" value="<?= old('old_password') ?>" placeholder="Old Password" type="password" autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-lg-5">
                                        <label for="new_password">Password Baru <small class="text-muted">(kosongkan jika password tidak diganti)</small></label>
                                            <input class="form-control form-control-sm" id="new_password" name="new_password" value="<?= old('new_password') ?>" placeholder="New Password" type="password" autocomplete="off">
                                    </div>
                                </p>
                            </div>
                            </div>
                            <div class="card-footer text-right">
                            <button type="submit" value="submit" id="tombol_simpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Perubahan</button>
                            </div>
                        </form>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<!-- CUSTOM JS -->

<!-- mencegah spasi ketika ganti password baru -->
<script>
$("#new_password").on({
    keydown: function(e) {
    if (e.which === 32)
        return false;
    },
    change: function() {
    this.value = this.value.replace(/\s/g, "");
    }
});
</script>
<!-- validasi jumlah karakter password baru -->
<script>
    $( "#tombol_simpan" ).click(function() {
        var old_password = document.getElementById("old_password").value;
        var new_password = document.getElementById("new_password").value;
        var length_new_password = new_password.length;
        var length_old_password = old_password.length;
        if(length_new_password > 0){
            if(length_new_password<10){
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'New Password minimal 10 karakter...!',
                    showConfirmButton: true
                })
                return false;
            }

            if(length_old_password == 0){
            Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Old Password tidak boleh kosong...!',
                    showConfirmButton: true
                })
                return false;
        }
    }
    // validasi jika ganti password new password tidak boleh kosong
    if(length_old_password > 0){
        if(length_new_password == 0){
            Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'New Password tidak boleh kosong...!',
                    showConfirmButton: true
                })
                return false;
        }
    }
});
</script>

<?= $this->endSection() ?>
