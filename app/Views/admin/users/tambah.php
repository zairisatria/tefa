<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Users - Tambah Users</title>
<?= $this->endSection() ?>

<!-- menampilkan libraries css secara dinamis -->
<?= $this->section('css') ?>
<?= $this->endSection() ?>
<!-- End menampilkan libraries css secara dinamis -->

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Tambah Users</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?=site_url('/manage-users')?>">Users</a></div>
    <div class="breadcrumb-item">Tambah Users</div>
  </div>
</div>
<div class="section-body">
  <form method="POST" action="<?=site_url('/simpan-users')?>" enctype="multipart/form-data">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <!-- Form -->
            <div class="form-group row">
              <label for="roles" class="col-sm-2 col-form-label">Roles <span class="text-danger">*</span></label>
              <div class="col-sm-12 col-md-7 col-lg-9">
                <select class="selectric my-1 mr-sm-2" name="roles" id="roles" required>
                  <option value="" selected disabled>Pilih..</option>
                  <option value="kaprodi">Kaprodi</option>
                  <option value="kepala">Kepala</option>
                  <option value="pemasaran">Pemasaran</option>
                  <option value="pembimbing">Pembimbing</option>
                  <option value="quality">Quality Control</option>
                </select>
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('roles'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
            <!-- Form -->
            <div class="form-group row" id="id-prodi-holder">
              <label for="id_prodi" class="col-sm-2 col-form-label">Prodi <span class="text-danger">*</span></label>
              <div class="col-sm-12 col-md-7 col-lg-9">
                <select class="selectric my-1 mr-sm-2" name="id_prodi" id="id_prodi">
                  <option value="" selected disabled>Pilih..</option>
                  <?php foreach ($prodi as $data) : ?>
                  <option value="<?= $data['id']; ?>" <?php if (old('id_prodi') == $data['id']) {echo "selected";} ?> ><?= $data['prodi']; ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('id_prodi'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
            <!-- Form -->
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">Nama <span class="text-danger">*</span></label>
              <div class="col-sm-12 col-md-7 col-lg-9">
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Tulis nama" required>
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('nama'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
            <!-- Form -->
            <div class="form-group row">
              <label for="username" class="col-sm-2 col-form-label">Username <span class="text-danger">*</span></label>
              <div class="col-sm-12 col-md-7 col-lg-9">
                <input type="text" class="form-control" name="username" id="username" placeholder="Tulis username" required>
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('username'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
            <!-- Form -->
            <div class="form-group row">
              <label for="password" class="col-sm-2 col-form-label">Password <span class="text-danger">*</span></label>
              <div class="col-sm-12 col-md-7 col-lg-9">
                <input type="password" class="form-control" name="password" id="password" placeholder="Tulis password" required>
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('password'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
            <!-- Form -->
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">Email <span class="text-danger">*</span></label>
              <div class="col-sm-12 col-md-7 col-lg-9">
                <input type="email" class="form-control" name="email" id="email" placeholder="Tulis email" required>
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('email'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
          </div>
          <div class="card-footer text-left">
            <button type="submit" id="simpan" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title data-original-title="Tombol untuk menyimpan data"><i class="fas fa-save"></i> Simpan</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>

<script>
  // show hide prodi
  document.getElementById("id-prodi-holder").hidden = true;
  document.getElementById("id_prodi").hidden = true;
  
  $( "#roles" ).change(function() {
    $roles = document.getElementById("roles").value;
    if($roles != "kaprodi" && $roles != "pembimbing"){
      document.getElementById("id-prodi-holder").hidden = true;
      document.getElementById("id_prodi").hidden = true;
      document.getElementById("id_prodi").required = false;
      document.getElementById("id_prodi").value = "";
    }else{
      document.getElementById("id-prodi-holder").hidden = false;
      document.getElementById("id_prodi").hidden = false;
      document.getElementById("id_prodi").required = true;
    }
});
</script>

<?= $this->endSection() ?>


<!-- load javascript secara dinamis -->
<?= $this->section('javascript') ?>

<?= $this->endSection() ?>
