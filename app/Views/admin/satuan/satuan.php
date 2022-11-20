<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Satuan</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Satuan</h1>
</div>
<div class="section-body">
	<div class="row">
	  <div class="col-md-12">
      <div class="card">
      <div class="card-header">
        <h4><a href="<?=site_url('tambah-satuan')?>" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</a></h4>
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
          <!-- Content Card -->
          <!-- Start Tabel -->
          <div class="table-responsive">
              <table id="example" class="table table-sm table-bordered table-hover" style="width:100%">
              <thead>
                <tr class="bg-primary text-white">
                  <th class="text-center">No.</th>
                  <th class="text-center">Satuan</th>
                  <th class="text-center">Konversi Satuan</th>
                  <th class="text-center">Nilai Konversi</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
                <tbody>
                <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                <?php foreach ($data_pagination as $data) : ?>
                <tr>
                  <td class="text-center"><?= $i++; ?></td>
                  <td><?= $data['satuan'] ?></td>
                  <td><?= $data['konversi_satuan'] ?></td>
                  <td><?= $data['nilai_konversi'] ?></td>
                  <td class="text-center">
                    <a class="btn btn-outline-info btn-sm" href="<?=base_url()?>/edit-satuan/<?= $data['id']; ?>"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-outline-danger btn-sm" href="<?=base_url()?>/delete-satuan/<?= $data['id']; ?>" id="tombol_hapus"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?= $pager->links('default', 'custom_pagination') ?>
          <!-- End Tabel -->
          <!-- End Content Card -->
        </div>
      </div>
	  </div>
  </div>
</div>

<script>
  
</script>

<?= $this->endSection() ?>
