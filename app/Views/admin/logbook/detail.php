<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Log book - Detail Log Book</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->
<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Detail Log Book</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?=site_url('/logbook')?>">Logbook</a></div>
    <div class="breadcrumb-item">Detail Log Book</div>
  </div>
</div>
<div class="section-body">
	<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <!-- Content Card -->
          <div class="section-body">
            <h2 class="section-title">Detail Log Book</h2>
            <div class="row">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <!-- menampilkan data -->
                    <?php $no= 1; ?>
                                <?php foreach ($d_logbook as $data) : ?>

                                    <button class="btn btn-primary btn-pill btn-icon-only text-facebook mb-2 mt-2" type="button" aria-label="github button" title="github button">
                                        <?= $no++; ?>
                                    </button>
                                    <?= 'Diupload Oleh: '.$data['nama']; ?>
                                    <br>
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

<!-- modal section -->
<?= $this->section('modal') ?>
<!-- akhir modal -->

<?= $this->endSection() ?>