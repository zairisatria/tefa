<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Edit Satuan</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Edit Satuan</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?=site_url('/satuan')?>">Satuan</a></div>
    <div class="breadcrumb-item">Edit Satuan</div>
  </div>
</div>
<div class="section-body">
	<div class="row">
	  <div class="col-md-12">
      <!-- Content Card -->
      <form method="POST" action="<?=site_url('/update-satuan')?>" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="text" value="<?= $satuan['id']; ?>" name="id" hidden>
        <div class="card">
          <div class="card-body">
            <!-- form -->
            <div class="form-group row">
              <label for="satuan" class="col-sm-2 col-form-label">Satuan<span class="text-danger">*</span></label>
              <div class="col-sm-6">
                <input type="text" name="satuan" class="form-control <?= $validation->hasError('satuan') ? 'is-invalid' : null ?>" id="satuan" value="<?= old('satuan', $satuan['satuan']) ?>" placeholder="Tulis satuan" required="">
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('satuan'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
            <!-- form -->
            <div class="form-group row">
              <label for="konversi_satuan" class="col-sm-2 col-form-label">Konversi Satuan (menurun)<span class="text-danger">*</span></label>
              <div class="col-sm-6">
                <input type="text" name="konversi_satuan" class="form-control <?= $validation->hasError('konversi_satuan') ? 'is-invalid' : null ?>" id="konversi_satuan" value="<?= old('konversi_satuan', $satuan['konversi_satuan']) ?>" placeholder="Tulis konversi satuan" required="">
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('konversi_satuan'); ?>
                </div>
              </div>
            </div>
            <!-- End Form -->
             <!-- form -->
             <div class="form-group row">
              <label for="nilai_konversi" class="col-sm-2 col-form-label">Konversi Satuan<span class="text-danger">*</span></label>
              <div class="col-sm-6">
                <input type="number" min="0" name="nilai_konversi" class="form-control <?= $validation->hasError('nilai_konversi') ? 'is-invalid' : null ?>" id="nilai_konversi" value="<?= old('nilai_konversi', $satuan['nilai_konversi']) ?>" placeholder="Tulis nilai konversi" required="">
                <div class="invalid-feedback">
                    <?= $error = $validation->getError('nilai_konversi'); ?>
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
