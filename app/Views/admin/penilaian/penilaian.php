<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Penilaian Produk</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Penilaian Produk</h1>
</div>
<div class="section-body">
	<div class="row">
	  <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4><a href="<?=site_url('tambah-penilaian')?>" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</a></h4>
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
                  <th class="text-center">Judul</th>
                  <th class="text-center">Inovasi</th>
                  <th class="text-center">Bentuk</th>
                  <th class="text-center">Rasa</th>
                  <th class="text-center">Kemasan</th>
                  <th class="text-center">Kelayakan</th>
                  <th class="text-center">Opsi</th>
                </tr>
              </thead>
                <tbody>
                <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                <?php foreach ($data_pagination as $data) : ?>
                <tr>
                  <td class="text-center"><?= $i++; ?></td>
                  <td><?= $data['judul'] ?></td>
                  <?php if($data['inovasi'] == "1"){
                    $inovasi = "Inovatif";
                    $badge = "badge badge-success";
                  }else{
                    $inovasi = "Tidak Inovatif";
                    $badge = "badge badge-danger";
                  }; ?>
                  <td><span class="<?= $badge ?>"><?= $inovasi ?></span></td>
                  <?php if($data['bentuk'] == "1"){
                    $bentuk = "Bagus";
                    $badge = "badge badge-success";
                  }else{
                    $bentuk = "Tidak Bagus";
                    $badge = "badge badge-danger";
                  }; ?>
                  <td><span class="<?= $badge ?>"><?= $bentuk ?></span></td>
                  <?php if($data['rasa'] == "1"){
                    $rasa = "Enak";
                    $badge = "badge badge-success";
                  }else{
                    $rasa = "Tidak Enak";
                    $badge = "badge badge-danger";
                  }; ?>
                  <td><span class="<?= $badge ?>"><?= $rasa ?></span></td>
                  <?php if($data['kemasan'] == "1"){
                    $kemasan = "Menarik";
                    $badge = "badge badge-success";
                  }else{
                    $kemasan = "Tidak Menarik";
                    $badge = "badge badge-danger";
                  }; ?>
                  <td><span class="<?= $badge ?>"><?= $kemasan ?></span></td>
                  <?php if($data['kelayakan'] == "1"){
                    $kelayakan = "Layak Jual";
                    $badge = "badge badge-success";
                  }else{
                    $kelayakan = "Tidak Layak Jual";
                    $badge = "badge badge-danger";
                  }; ?>
                  <td><span class="<?= $badge ?>"><?= $kelayakan ?></span></td>
                  <td class="text-center">
                    <a class="btn btn-outline-info btn-sm" href="<?=base_url()?>/edit-penilaian/<?= $data['id']; ?>"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-outline-danger btn-sm" href="<?=base_url()?>/delete-penilaian/<?= $data['id']; ?>" id="tombol_hapus"><i class="fas fa-trash"></i></a>
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
