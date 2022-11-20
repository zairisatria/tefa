<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Detail Log Book</title>
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
                        <div class="tab-content" id="tabcontent2">
                            <div class="tab-pane fade show active" id="tabs-icons-text-0" role="tabpanel" aria-labelledby="tabs-icons-text-0-tab">
                                <!-- menampilkan data -->
                                <?php $no= 1; ?>
                                <?php foreach ($d_logbook as $data) : ?>

                                    <button class="btn btn-primary btn-pill btn-icon-only text-facebook mb-2 mt-2" type="button" aria-label="github button" title="github button">
                                        <?= $no++; ?>
                                    </button><br>
                                    <!-- video -->
                                    <?php if ($data['format_files']=="video"): ?>
                                    <div class="embed-responsive embed-responsive-16by9">
                                        <video loop="false" preload="metadata" controls>
                                            <source class="embed-responsive-item" src="<?= base_url()?>/files/logbook_dokumentasi/<?= $data['files']?>" type="video/webm" />
                                            <source class="embed-responsive-item" src="<?= base_url()?>/files/logbook_dokumentasi/<?= $data['files']?>" type="video/ogg" />
                                            <source class="embed-responsive-item" src="<?= base_url()?>/files/logbook_dokumentasi/<?= $data['files']?>" type="video/avi" />
                                            <source class="embed-responsive-item" src="<?= base_url()?>/files/logbook_dokumentasi/<?= $data['files']?>" type="video/mp4" />
                                            Browsermu tidak mendukung format video ini, upgrade donk!
                                        </video>
                                    </div>
                                    <?php endif ?>
                                    <!-- gambar -->
                                    <?php if ($data['format_files']=="gambar"): ?>
                                        <img class="img-fluid" src="<?= base_url()?>/files/logbook_dokumentasi/<?= $data['files']?>" alt="Gambar Dokumentasi Logbook">
                                    <?php endif ?>
                                <?php endforeach; ?>
                                <!-- end menampilkan data -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Tab Content -->
            </div>
        </div>
        <!-- end tab style -->
    </div>
    <br><br><br>

<!-- CUSTOM JS PARCIAL-->
<script>
</script>
<!-- END CUSTOM JS PARCIAL-->


<?= $this->endSection() ?>
<!-- END SECTION DINAMIC VIEW CONTENT -->

<!-- render JS GLOBAL IN DINAMIC VIEW-->
<?= $this->section('js_global') ?>
<script>
</script>

<?= $this->endSection() ?>


<!-- modal section -->
<?= $this->section('modal') ?>

<?= $this->endSection() ?>