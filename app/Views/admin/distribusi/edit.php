<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Distribusi - Edit Distribusi</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Edit Distribusi</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?=site_url('/distribusi')?>">Distribusi Produk</a></div>
    <div class="breadcrumb-item">Edit Distribusi Produk</div>
  </div>
</div>
<div class="section-body">
	<div class="row">
	  <div class="col-md-12">
          <!-- Content Card -->
          <form method="POST" action="<?=site_url('/update-distribusi')?>" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <input type="text" value="<?= $distribusi['id']; ?>" name="id" hidden>
            <div class="card">
              <div class="card-body">
                <!-- Form -->
                <div class="form-group row">
                  <label for="id_proposal" class="col-sm-2 col-form-label">Produk <span class="text-danger">*</span></label>
                  <div class="col-sm-6">
                    <select class="select2 my-1 mr-sm-2" name="id_proposal" id="id_proposal" required>
                      <option value="" selected disabled>Pilih..</option>
                      <?php foreach ($produk as $data) : ?>
                      <option value="<?= $data['id']; ?>" <?php if (old('id_proposal', $distribusi['id_proposal']) == $data['id']) {echo "selected";} ?> ><?= $data['judul']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('id_proposal'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
                <!-- Form -->
                <div class="form-group row">
                  <label for="id_toko" class="col-sm-2 col-form-label">Toko <span class="text-danger">*</span></label>
                  <div class="col-sm-6">
                    <select class="select2 my-1 mr-sm-2" name="id_toko" id="id_toko" required>
                      <option value="" selected disabled>Pilih..</option>
                      <?php foreach ($toko as $data) : ?>
                      <option value="<?= $data['id']; ?>" <?php if (old('id_toko', $distribusi['id_toko']) == $data['id']) {echo "selected";} ?> ><?= $data['nama']; ?></option>
                      <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('id_toko'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
                <!-- Form -->
                <div class="form-group row">
                  <label for="harga_jual" class="col-sm-2 col-form-label">Harga Jual <span class="text-danger">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="harga_jual" id="harga_jual" value="<?= old('harga_jual', $distribusi['harga_jual']) ?>" placeholder="Rp ..." required>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('harga_jual'); ?>
                    </div>
                  </div>
                </div>
                <!-- End Form -->
                <!-- Form -->
                <div class="form-group row">
                  <label for="jumlah" class="col-sm-2 col-form-label">Jumlah Produk <span class="text-danger">*</span></label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="jumlah" id="jumlah" value="<?= old('jumlah', $distribusi['jumlah']) ?>" placeholder="Jumlah Produk" required>
                    <div class="invalid-feedback">
                        <?= $error = $validation->getError('jumlah'); ?>
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
