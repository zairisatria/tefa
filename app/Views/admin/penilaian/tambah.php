<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Penilaian - Tambah Penilaian</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Tambah Penilaian</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?=site_url('/penilaian')?>">Penilaian Produk</a></div>
    <div class="breadcrumb-item">Tambah Penilaian Produk</div>
  </div>
</div>
<div class="section-body">
	<div class="row">
	  <div class="col-md-12">
          <!-- Content Card -->
          <form method="POST" action="<?=site_url('/simpan-penilaian')?>" enctype="multipart/form-data">
          <?= csrf_field() ?>
            <div class="card">
              <div class="card-body">
                <!-- Form -->
                <div class="form-group row">
                  <label for="id_kelompok" class="col-sm-2 col-form-label">Produk<span class="text-danger">*</span></label>
                  <div class="col-sm-6">
                    <select class="select2 my-1 mr-sm-2" name="id_kelompok" id="id_kelompok" required>
                      <option value="" selected disabled>Pilih..</option>
                      <?php foreach ($produk as $data) : ?>
                      <option value="<?= $data['id_kelompok']; ?>" <?php if (old('id_kelompok') == $data['id_kelompok']) {echo "selected";} ?> ><?= $data['judul']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('id_kelompok'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
                <!-- Form -->
                <div class="form-group row">
                  <label for="inovasi" class="col-sm-2 col-form-label">Inovasi<span class="text-danger"> *</span></label>
                  <div class="col-sm-6">
                    <select class="selectric my-1 mr-sm-2" name="inovasi" id="inovasi" required>
                      <option value="" selected disabled>Pilih..</option>
                      <option value="1" <?php if (old('inovasi') == 'Ada') {echo "selected";} ?> >Inovatif</option>
                      <option value="0" <?php if (old('inovasi') == 'Tidak Inovatif') {echo "selected";} ?> >Tidak Inovatif</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('inovasi'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
                <!-- Form -->
                <div class="form-group row">
                  <label for="bentuk" class="col-sm-2 col-form-label">Bentuk<span class="text-danger"> *</span></label>
                  <div class="col-sm-6">
                    <select class="selectric my-1 mr-sm-2" name="bentuk" id="bentuk" required>
                      <option value="" selected disabled>Pilih..</option>
                      <option value="1" <?php if (old('bentuk') == 'Bagus') {echo "selected";} ?> >Bagus</option>
                      <option value="0" <?php if (old('bentuk') == 'Tidak Bagus') {echo "selected";} ?> >Tidak Bagus</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('bentuk'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
                <!-- Form -->
                <div class="form-group row">
                  <label for="rasa" class="col-sm-2 col-form-label">Rasa<span class="text-danger"> *</span></label>
                  <div class="col-sm-6">
                    <select class="selectric my-1 mr-sm-2" name="rasa" id="rasa" required>
                      <option value="" selected disabled>Pilih..</option>
                      <option value="1" <?php if (old('rasa') == 'Enak') {echo "selected";} ?> >Enak</option>
                      <option value="0" <?php if (old('rasa') == 'Tidak Enak') {echo "selected";} ?> >Tidak Enak</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('rasa'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
                <!-- Form -->
                <div class="form-group row">
                  <label for="kemasan" class="col-sm-2 col-form-label">Kemasan<span class="text-danger"> *</span></label>
                  <div class="col-sm-6">
                    <select class="selectric my-1 mr-sm-2" name="kemasan" id="kemasan" required>
                      <option value="" selected disabled>Pilih..</option>
                      <option value="1" <?php if (old('kemasan') == 'Menarik') {echo "selected";} ?> >Menarik</option>
                      <option value="0" <?php if (old('kemasan') == 'Tidak Menarik') {echo "selected";} ?> >Tidak Menarik</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('kemasan'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
                <!-- Form -->
                <div class="form-group row">
                  <label for="kelayakan" class="col-sm-2 col-form-label">Kesimpulan <span class="text-muted">(kelayakan)</span><span class="text-danger"> *</span></label>
                  <div class="col-sm-6">
                    <select class="selectric my-1 mr-sm-2" name="kelayakan" id="kelayakan" required>
                      <option value="" selected disabled>Pilih..</option>
                      <option value="1" <?php if (old('kelayakan') == 'Layak') {echo "selected";} ?> >Layak Jual</option>
                      <option value="0" <?php if (old('kelayakan') == 'Tidak Layak') {echo "selected";} ?> >Tidak Layak Jual</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('kelayakan'); ?>
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
