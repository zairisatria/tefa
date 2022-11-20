<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Evaluasi - Laporan Evaluasi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <h1>Laporan Evaluasi</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item">Laporan Evaluasi</div>
  </div>
</div>
<div class="section-body">
	<div class="row">
	  <div class="col-md-12">
          <!-- Content Card -->
          <form method="GET" action="<?=site_url('/laporan-evaluasi')?>" enctype="multipart/form-data">
          <?= csrf_field() ?>
            <div class="card">
              <div class="card-body">
                <!-- Form -->
                <div class="form-group row">
                  <label for="prodi" class="col-sm-2 col-form-label">Prodi<span class="text-danger">*</span></label>
                  <div class="col-sm-6">
                    <select class="select2 my-1 mr-sm-2" name="prodi" id="prodi" required>
                      <option value="" selected disabled>Pilih</option>
                      <?php foreach ($prodi as $data) : ?>
                      <option value="<?= $data['id']; ?>" <?php if (old('prodi') == $data['prodi']) {echo "selected";} ?> ><?= $data['prodi']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('prodi'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
              </div>
              <div class="card-footer text-left">
                <button type="submit" id="simpan" class="btn btn-primary" target="_blank"><i class="fas fa-file"></i> Tampilkan Laporan Pdf</button>
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
