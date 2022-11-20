<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Edit Program Studi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Edit Program Studi</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?=site_url('/prodi')?>">Program Studi</a></div>
    <div class="breadcrumb-item">Edit Program Studi</div>
  </div>
</div>
<div class="section-body">
	<div class="row">
	  <div class="col-md-12">
      <!-- Content Card -->
      <form method="POST" action="<?=site_url('/update-prodi')?>" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="text" value="<?= $prodi['id']; ?>" name="id" hidden>
        <div class="card">
          <div class="card-body">
            <!-- form -->
            <div class="form-group row">
              <label for="prodi" class="col-sm-2 col-form-label">Program Studi<span class="text-danger">*</span></label>
              <div class="col-sm-6">
                <input type="text" name="prodi" class="form-control <?= $validation->hasError('prodi') ? 'is-invalid' : null ?>" id="prodi" value="<?= old('prodi', $prodi['prodi']) ?>" placeholder="Tulis Program Studi" required>
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('prodi'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
          </div>
          <div class="card-footer text-left">
            <button type="submit" id="simpan" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title data-original-title="Tombol untuk menyimpan data"><i class="fas fa-save"></i> Simpan</button>
          </div>
        </div>
      </form>
      <!-- End Content Card -->
	  </div>
  </div>
</div>

<script>
  
</script>

<?= $this->endSection() ?>
