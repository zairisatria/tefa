<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Job Sheet</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->
<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Job Sheet</h1>
</div>
<div class="section-body">
	<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <!-- Content Card -->
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                <div class="card-header">
                  <h4 class="section-title text-dark">Daftar Job Sheet</h4>
                    <div class="card-header-form">
                      <form method="GET" action="">
                        <div class="input-group">
                          <input type="text" name="keyword" class="form-control" value="<?= $keyword ?>" placeholder="Search">
                          <div class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body">
                    <!-- Start Tabel -->
                    <div class="table-responsive">
                            <table id="example" class="table table-sm table-bordered table-hover" style="width:100%">
                            <thead>
                              <tr class="bg-primary text-white">
                                <th class="text-center">No.</th>
                                <th class="text-center">Kelompok/Proposal</th>
                                <th class="text-center">Alat</th>
                                <th class="text-center">Bahan</th>
                                <th class="text-center">Langkah</th>
                                <th class="text-center">Keseluruhan</th>
                              </tr>
                            </thead>
                              <tbody>
                              <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                              <?php foreach ($data_pagination_diterima as $data) : ?>
                              <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td class="text-center">
                                  <a class="btn btn-sm btn-outline-info" href="<?=base_url()?>/detail-alat/<?= $data['id_kelompok']; ?>"><i class="fas fa-arrow-circle-right"></i></a>
                                </td>
                                <td class="text-center">
                                  <a class="btn btn-sm btn-outline-info" href="<?=base_url()?>/detail-bahan/<?= $data['id_kelompok']; ?>"><i class="fas fa-arrow-circle-right"></i></a>
                                </td>
                                <td class="text-center">
                                  <a class="btn btn-sm btn-outline-info" href="<?=base_url()?>/detail-langkah-kerja/<?= $data['id_kelompok']; ?>"><i class="fas fa-arrow-circle-right"></i></a>
                                </td>
                                <td class="text-center">
                                  <a class="btn btn-sm btn-outline-info" target="_blank" href="<?=base_url()?>/jobsheet-pdf/<?= $data['id_kelompok']; ?>"><i class="fas fa-arrow-circle-right"> PDF</i></a>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                        <?= $pager_diterima->links('default', 'custom_pagination') ?>
                        <!-- End Tabel -->
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