<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Edit Alat</title>
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
                                <form action="<?=site_url('/update-alat')?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="text" name="id" id="id" value="<?= ($alat['id']) ?>" hidden>
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="alat">Alat<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control <?= $validation->hasError('alat') ? 'is-invalid' : null ?>" name="alat" id="alat" value="<?= old('alat', $alat['alat']) ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('alat'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="jumlah">Jumlah<span class="text-danger">*</span></label>
                                        <input type="number" min="1" class="form-control <?= $validation->hasError('jumlah') ? 'is-invalid' : null ?>" name="jumlah" id="jumlah" value="<?= old('jumlah', $alat['jumlah']) ?>" required>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('jumlah'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
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