<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Job Sheet - Detail Bahan</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->
<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Detail Bahan</h1>
  <div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="<?=site_url('/jobsheet')?>">Job Sheet</a></div>
    <div class="breadcrumb-item">Detail Bahan</div>
  </div>
</div>
<div class="section-body">
	<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <!-- Content Card -->
          <div class="section-body">
            <h2 class="section-title">Detail Bahan</h2>
            <div class="row">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <!-- Start Tabel -->
                    <div class="table-responsive">
                            <table id="example" class="table table-sm table-bordered table-hover" style="width:100%">
                            <thead>
                              <tr class="bg-primary text-white">
                                <th class="text-center">No.</th>
                                <th class="text-center">Bahan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Total</th>
                              </tr>
                            </thead>
                              <tbody>
                              <?php $i = 1; ?>
                              <?php foreach ($bahan as $data) : ?>
                              <tr>
                                <td class="text-center"><?= $i++.'.'; ?></td>
                                <td><?= $data['bahan'] ?></td>
                                <td> <?= $data['jumlah'].'  '.$data['satuan']; ?> </td>
                                <td class="text-right"> <?= 'Rp '.number_format($data['harga'],2); ?></td>
                                <td class="text-right"> <?= 'Rp '. number_format($data['harga']*$data['jumlah'],2); ?></td>
                              </tr>
                              <?php endforeach; ?>
                              </tbody>
                              <tfoot>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td class="text-right"><strong><?= 'Rp '. number_format($total_bahan['total_bahan'],2); ?></strong></td>
                                </tr>
                              </tfoot>
                            </table>
                          </div>
                        <div class="row ">

                        </div>
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