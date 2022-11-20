<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Edit Bahan</title>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<!-- menampilkan isi content secara dinamis -->
<?php $validation =  \Config\Services::validation() ?>
    <div class="container-fluid">
        <!-- tab style -->
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8 mt-3">
                <!-- Tab Content -->
                <div class="card shadow-inset bg-primary border-light p-3 rounded">
                    <div class="card-body p-0">
                                <!-- Form Sakit -->
                                <form action="<?=site_url('/update-bahan')?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="text" name="id" id="id" value="<?= ($bahan['id']) ?>" hidden>
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="bahan">Bahan<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $validation->hasError('bahan') ? 'is-invalid' : null ?>" name="bahan" id="bahan" value="<?= old('bahan', $bahan['bahan']) ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('bahan'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="harga">Harga<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $validation->hasError('harga') ? 'is-invalid' : null ?>" name="harga" id="harga" value="<?= old('harga', $bahan['harga']) ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('harga'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $validation->hasError('jumlah') ? 'is-invalid' : null ?>" name="jumlah" id="jumlah" value="<?= old('jumlah', $bahan['jumlah']) ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('jumlah'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- End of Form -->
                                    <div class="form-group">
                                        <label for="satuan">Satuan<span class="text-danger">*</span></label>
                                        <select class="custom-select my-1 mr-sm-2" id="satuan" name="satuan" required>
                                            <option selected disabled value="">Pilih...</option>
                                            <?php foreach ($satuan as $data) : ?>
                                            <option value="<?= $data['id']; ?>" <?php if (old('satuan', $bahan['satuan']) == $data['id']) {echo "selected";} ?> ><?= $data['satuan']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('satuan'); ?>
                                        </div>
                                    </div>
                                    <!-- End Form -->
                                    <button type="submit" value="submit" id="simpan" class="btn btn-facebook btn-block mt-4"><i class="fas fa-save"> Simpan</i></button>
                                </form>
                                <!-- End Form Sakit -->
                    </div>
                </div>
                <!-- End of Tab Content -->
            </div>
        </div>
        <!-- end tab style -->
    </div>

<!-- CUSTOM JS -->
<script>

</script>
<?= $this->endSection() ?>
<!-- END SECTION DINAMIC VIEW CONTENT -->

<!-- render JS GLOBAL IN DINAMIC VIEW-->
<?= $this->section('js_global') ?>
<script>

</script>
<?= $this->endSection() ?>