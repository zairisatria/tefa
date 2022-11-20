<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Pengajuan Proposal</title>
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
                                <form action="<?=site_url('/proposal/simpan')?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="judul">Judul Proposal<span class="text-danger">*</span></label>
                                        <textarea class="form-control <?= $validation->hasError('judul') ? 'is-invalid' : null ?>" placeholder="Enter your message..." id="judul" name="judul" rows="4" required=""><?= old('judul') ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('judul'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form -->
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input <?= $validation->hasError('files') ? 'is-invalid' : null ?>" id="gambar" name="files" value="<?= old('files') ?>" onchange="previewImg()" aria-label="File upload" required="">
                                        <label class="custom-file-label" for="files">Pilih file <span class="text-danger">*</span></label>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('files'); ?>
                                        </div>
                                    </div>
                                    <!-- End Form -->
                                    <button type="submit" value="submit" id="simpan" class="btn btn-facebook btn-block mt-4"><i class="fas fa-save"> Ajukan</i></button>
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