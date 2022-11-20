<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Profile</title>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<!-- menampilkan isi content secara dinamis -->
<?php $validation =  \Config\Services::validation() ?>
<form action="<?=site_url('/profile/update')?>" method="post" enctype="multipart/form-data">
<?= csrf_field() ?>
<div class="container-fluid">
    <!-- Title -->
    <div class="row">
        <div class="col text-center">
            <h2 class="h5 mb-6 mt-2">Your Profile</h2>
        </div>
    </div>
    <!-- End of title-->
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4 mb-6 mb-md-5">
            <!-- Profile Card -->   
            <div class="profile-card">
                <div class="card bg-primary shadow-inset border-light">
                    <div class="card-header">
                        <div class="profile-image bg-primary shadow-inset border border-light rounded mx-auto p-3 mt-n6">
                            <input type="text" name="gambarLama" value="<?= $users['photo']; ?>" hidden>
                            <img src="<?=base_url()?>/img/users/<?= $users['photo']; ?>" class="card-img-top rounded" alt="foto profil">
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="mb-2 text-center"><?= $users['nama']; ?></h3>

                        <div class="form-group">
                            <label for="nama">Nama Lengkap<span class="text-danger"> *</span></label>
                            <div class="input-group mb-4">
                                <input class="form-control form-control-sm <?= $validation->hasError('nama') ? 'is-invalid' : null ?>" id="nama" name="nama" value="<?= old('nama', $users['nama']) ?>" placeholder="Your Name" type="text">
                                <div class="input-group-append">
                                    <span class="input-group-text"><span class="fas fa-edit"></span></span>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $error = $validation->getError('nama'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telepon">Telepon<span class="text-danger"> *</span></label>
                            <div class="input-group mb-4">
                                <input class="form-control form-control-sm <?= $validation->hasError('telepon') ? 'is-invalid' : null ?>" id="telepon" name="telepon" value="<?= old('telepon', $users['telepon']) ?>" placeholder="Your Phone" type="text">
                                <div class="input-group-append">
                                    <span class="input-group-text"><span class="fas fa-phone"></span></span>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $error = $validation->getError('telepon'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username">Username<span class="text-danger"> *</span></label>
                            <div class="input-group mb-4">
                                <input class="form-control form-control-sm <?= $validation->hasError('username') ? 'is-invalid' : null ?>" id="username" name="username" value="<?= old('username', $users['username']) ?>" placeholder="Name Account" type="text">
                                <div class="input-group-append">
                                    <span class="input-group-text"><span class="fas fa-edit"></span></span>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $error = $validation->getError('username'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-3">
                                <img src="/img/users/<?= $users['photo'] ?>" width='150' height='150' class="img-thumbnail img-preview">
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= $validation->hasError('gambar') ? 'is-invalid' : null ?>" id="gambar" name="gambar" onchange="previewImg()" value="<?= $users['photo']; ?>">
                                <label class="custom-file-label" for="gambar">Choose file</label>
                                <div class="invalid-feedback">
                                    <?= $error = $validation->getError('gambar'); ?>
                                </div> 
                            </div>
                        </div>

                        <div class="card shadow-soft border-light bg-light">
                            <div class="card card-sm card-body bg-primary border-light mb-0">
                                <a href="#panel-1" data-target="#panel-1" class="accordion-panel-header collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="panel-1">
                                    <span class="h6 mb-0 font-weight-bold">Ganti Password</span>
                                    <span class="icon"><span class="fas fa-plus"></span></span>
                                </a>
                                <div class="collapse" id="panel-1">
                                    <div class="pt-3">

                                        <div class="form-group">
                                            <label for="old_password">Password Lama <small class="text-muted">(kosongkan jika password tidak diganti)</small></label>
                                            <div class="input-group mb-4">
                                                <input class="form-control form-control-sm" id="old_password" name="old_password" value="<?= old('old_password') ?>" placeholder="Old Password" type="password" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="new_password">Password Baru <small class="text-muted">(kosongkan jika password tidak diganti)</small></label>
                                            <div class="input-group mb-4">
                                                <input class="form-control form-control-sm" id="new_password" name="new_password" value="<?= old('new_password') ?>" placeholder="New Password" type="password" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- End of Profile Card -->

            <!-- button update profile -->
            <div class="row justify-content-center mt-5">
                <div class="col-md-12">
                    <button type="submit" value="submit" id="tombol_simpan" class="btn btn-facebook btn-block"><i class="fas fa-save"> Simpan</i></button>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
</form>

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
