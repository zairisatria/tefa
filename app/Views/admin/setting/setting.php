<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Setting</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <h1>Setting</h1>
</div>
<div class="section-body">
	<div class="row">
    <div class="col-md-12 col-sm-12 col-lg-12">
      <div class="card">
        <div class="card-body">
          <!-- Content Card -->
          <div class="section-body">
          <h2 class="section-title">Setting</h2>
            <form action="<?=site_url('/update-setting')?>" method="post" enctype="multipart/form-data">
            <!-- Form -->
            <div class="form-group col-12">
              <label for="batas_proposal">Batas Waktu Upload Perbaikan Proposal (dalam satuan menit)<span class="text-danger"> *</span></label>
              <input type="text" name="batas_proposal" value="<?= old('batas_proposal', $setting['batas_proposal']) ?>" class="form-control <?= $validation->hasError('batas_proposal') ? 'is-invalid' : null ?>" id="batas_proposal" placeholder="Batas Waktu Proposal" required>
              <div class="invalid-feedback">
                  <?= $error = $validation->getError('batas_proposal'); ?>
              </div>
            </div>
            <!-- End Form -->
            <div class="card-footer text-left">
              <button type="submit" id="simpan" class="btn btn-primary" data-toggle="tooltip" data-placement="right" title data-original-title="Tombol untuk menyimpan data"><i class="fas fa-save"></i> Simpan Pengaturan</button>
            </div>
            </form>
          </div>
          <!-- End Content Card -->
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  
</script>

<?= $this->endSection() ?>
