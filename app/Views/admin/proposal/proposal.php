<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Proposal</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- mengaktifkan validation service -->
<?php $validation =  \Config\Services::validation() ?>

<!-- menampilkan isi content secara dinamis -->
<div class="section-header">
  <div class="section-header-back">
    <button type="button" class="btn btn-icon" onclick="history.back()" ><i class="fas fa-arrow-left"></i></button>
  </div>
  <h1>Proposal</h1>
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
                  <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab5" role="tablist">
                    <?php if (session()->get('roles')=="admin"): ?>
                      <li class="nav-item">
                        <a class="nav-link" id="home-tab5" data-toggle="tab" href="#home5" role="tab" aria-controls="home" aria-selected="true">
                          <i class="text-info fas fa-envelope"></i> Baru</a>
                      </li>
                      <?php endif ?>
                      <li class="nav-item">
                        <a class="nav-link active" id="profile-tab5" data-toggle="tab" href="#profile5" role="tab" aria-controls="profile" aria-selected="false">
                          <i class="text-success fas fa-check"></i> Diterima</a>
                      </li>
                      <?php if (session()->get('roles')=="admin"): ?>
                      <li class="nav-item">
                        <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5" role="tab" aria-controls="contact" aria-selected="false">
                          <i class="text-danger fas fa-times"></i> Ditolak</a>
                      </li>
                      <?php endif ?>
                    </ul>
                    <div class="tab-content" id="myTabContent5">
                      <!-- Tab Baru -->
                      <div class="tab-pane fade" id="home5" role="tabpanel" aria-labelledby="home-tab5">
                      <!-- Start Search -->
                      <div class="card-header">
                      <h4 class="section-title text-dark">Daftar Proposal Pengajuan Baru</h4>
                        <div class="card-header-form">
                          <form method="GET" action="">
                            <div class="input-group">
                              <input type="text" name="keyword_baru" class="form-control" value="<?= $keyword_baru ?>" placeholder="Search">
                              <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- End Search -->
                        <!-- Start Tabel -->
                        <div class="table-responsive">
                            <table id="example" class="table table-sm table-bordered table-hover" style="width:100%">
                            <thead>
                              <tr class="bg-primary text-white">
                                <th class="text-center">No.</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Tgl Pengajuan</th>
                                <th class="text-center">Proposal</th>
                                <th class="text-center">Status Pengajuan</th>
                                <?php if (session()->get('roles')=="admin" || session()->get('roles')=="kepala" || session()->get('roles')=="kaprodi"): ?>
                                <th class="text-center" colspan="2">Opsi</th>
                                <?php endif ?>
                              </tr>
                            </thead>
                              <tbody>
                              <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                              <?php foreach ($data_pagination_baru as $data) : ?>
                              <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td class="text-center"><?= $data['created_at'] ?></td>
                                <td class="text-center">
                                  <a class="btn btn-sm btn-outline-secondary" href="<?=base_url()?>/files/proposal/<?= $data['files']; ?>" target="_blank"><i class="fas fa-download"></i></a>
                                </td>
                                <td>
                                  <?php if($data['status_perbaikan'] == "0"){
                                        $title = "Baru";
                                        $bg = "btn-warning";
                                      }else{
                                        $title = "Perbaikan";
                                        $bg = "btn-danger";
                                      }
                                  ?>
                                      <?= $title; ?>
                                </td>

                                <?php if (session()->get('roles')=="admin" || session()->get('roles')=="kepala" || session()->get('roles')=="kaprodi"): ?>
                                <td class="text-center">
                                  <button type="button" class="btn btn-sm btn-outline-primary" id="tombolVerifikasiProposal" data-toggle="modal" data-target="#modalVerifikasiProposal" 
                                    data-id = "<?= $data['id']; ?>"
                                    data-id_kelompok = "<?= $data['id_kelompok']; ?>"
                                    data-status_proposal = "<?= $data['status_proposal']; ?>"
                                    data-catatan_perbaikan = "<?= $data['catatan_perbaikan']; ?>"
                                    ><i class="fas fa-check"></i>  Verifikasi
                                  </button>
                                </td>
                                <?php endif ?>

                              </tr>
                              <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                          <?= $pager_baru->links('default', 'custom_pagination') ?>
                        <!-- End Tabel -->
                      </div>
                      <!-- End Tab Baru -->
                      <!-- Tab Diterima -->
                      <div class="tab-pane fade show active" id="profile5" role="tabpanel" aria-labelledby="profile-tab5">
                      <!-- Start Search -->
                      <div class="card-header">
                      <h4 class="section-title text-dark">Daftar Proposal Yang Diterima</h4>
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
                      <!-- End Search -->
                        <!-- Start Tabel -->
                        <div class="table-responsive">
                            <table id="example" class="table table-sm table-bordered table-hover" style="width:100%">
                            <thead>
                              <tr class="bg-primary text-white">
                                <th class="text-center">No.</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Tgl Pengajuan</th>
                                <th class="text-center">Tgl Verifikasi</th>
                                <th class="text-center">Pembimbing</th>
                                <th class="text-center">Proposal</th>
                              </tr>
                            </thead>
                              <tbody>
                              <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                              <?php foreach ($data_pagination_diterima as $data) : ?>
                              <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td class="text-center"><?= $data['created_at'] ?></td>
                                <td class="text-center"><?= $data['updated_at'] ?></td>
                                <td><?= $data['nama'] ?></td>
                                <td class="text-center">
                                  <a class="btn btn-sm btn-outline-secondary" href="<?=base_url()?>/files/proposal/<?= $data['files']; ?>" target="_blank"><i class="fas fa-download"></i></a>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                          <?= $pager_diterima->links('default', 'custom_pagination') ?>
                        <!-- End Tabel -->
                      </div>
                      <!-- End Tab Diterima -->
                      <!-- Tab Ditolak -->
                      <div class="tab-pane fade" id="contact5" role="tabpanel" aria-labelledby="contact-tab5">
                        <!-- Start Search -->
                      <div class="card-header">
                      <h4 class="section-title text-dark">Daftar Proposal Yang Ditolak</h4>
                        <div class="card-header-form">
                          <form method="GET" action="">
                            <div class="input-group">
                              <input type="text" name="keyword_ditolak" class="form-control" value="<?= $keyword_ditolak ?>" placeholder="Search">
                              <div class="input-group-btn">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </div>
                      <!-- End Search -->
                        <!-- Start Tabel -->
                        <div class="table-responsive">
                            <table id="example" class="table table-sm table-bordered table-hover" style="width:100%">
                            <thead>
                              <tr class="bg-primary text-white">
                                <th class="text-center">No.</th>
                                <th class="text-center">Judul</th>
                                <th class="text-center">Tgl Pengajuan</th>
                                <th class="text-center">Tgl Verifikasi</th>
                                <th class="text-center">Proposal</th>
                                <th class="text-center">Catatan</th>
                              </tr>
                            </thead>
                              <tbody>
                              <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                              <?php foreach ($data_pagination_ditolak as $data) : ?>
                              <tr>
                                <td class="text-center"><?= $i++; ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td class="text-center"><?= $data['created_at'] ?></td>
                                <td class="text-center"><?= $data['updated_at'] ?></td>
                                <td class="text-center">
                                  <a class="btn btn-sm btn-outline-secondary" href="<?=base_url()?>/files/proposal/<?= $data['files']; ?>" target="_blank"><i class="fas fa-download"></i></a>
                                </td>
                                <td class="text-center">
                                  <small><button type="button" class="btn btn-primary btn-sm" id="tombolDetails" data-toggle="modal" data-target="#modalDetails" 
                                    data-id = "<?= $data['id']; ?>"
                                    data-catatan_perbaikan = "<?= $data['catatan_perbaikan']; ?>"
                                    ><i class="fas fa-info-circle"></i></button>
                                  </small>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              </tbody>
                            </table>
                          </div>
                          <?= $pager_ditolak->links('default', 'custom_pagination') ?>
                        <!-- End Tabel -->
                      </div>
                      <!-- End Tab Ditolak -->
                    </div>
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
  // ketika tombol verifikasi di klik kirim data ke modal
$(document).ready(function() {
    $(document).on('click','#tombolVerifikasiProposal',function() {
      // mengambil nilai dari data
      var id = $(this).data('id');
      var id_kelompok = $(this).data('id_kelompok');
      var status_proposal = $(this).data('status_proposal');
      // parse nilai kedalam modal
      document.getElementById("id_verifikasi_proposal").value = id;
      document.getElementById("id_kelompok").value = id_kelompok;
	})
});

  // ketika tombol detail catatan di klik kirim data ke modal
  $(document).ready(function() {
    $(document).on('click','#tombolDetails',function() {
      // mengambil nilai dari data
      var id = $(this).data('id');
      var catatan_perbaikan = $(this).data('catatan_perbaikan');
      // parse nilai kedalam modal
      if(catatan_perbaikan){
        document.getElementById("detailCatatanPerbaikan").textContent = catatan_perbaikan;
      }else{
        document.getElementById("detailCatatanPerbaikan").textContent = "Tidak Ada Catatan";
      }
	})
});


// ketika status verifikasi dipilih
$(document).ready(function() {
  // ketika modal verifikasi muncul hilangkan dulu pilihan pembimbing dan catatan
  document.getElementById("holder-catatan").hidden=true;
  document.getElementById("catatan").hidden=true;
  document.getElementById("holder-pembimbing").hidden=true;
  document.getElementById("pembimbing").hidden=true;

  // ketika status verifikasi dipilih
    $(document).on('change','#status_verifikasi',function() {
      // mengambil nilai dari data
      var status_verifikasi = $(this).val();
      if(status_verifikasi == "1"){
        document.getElementById("holder-catatan").hidden=true;
        document.getElementById("catatan").hidden=true;
        document.getElementById("catatan").value = "";

        document.getElementById("holder-pembimbing").hidden=false;
        document.getElementById("pembimbing").hidden=false;
        document.getElementById("pembimbing").required = true;
      }else{
        document.getElementById("holder-catatan").hidden=false;
        document.getElementById("catatan").hidden=false;

        document.getElementById("holder-pembimbing").hidden=true;
        document.getElementById("pembimbing").hidden=true;
        document.getElementById("pembimbing").required = false;
      }
	})
});

</script>

<?= $this->endSection() ?>

<!-- modal section -->
<?= $this->section('modal') ?>

<!-- Awal Menampilkan Modal verifikasi proposal-->
<div class="modal fade bd-example-modal-lg" id="modalVerifikasiProposal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Verifikasi Proposal</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <!-- awal content -->
        <div class="section-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <form action="<?=site_url('/verifikasi-proposal')?>" method="post" enctype="multipart/form-data">
                  <input type="text" class="form-control" id="id_verifikasi_proposal" name="id_verifikasi_proposal" hidden>
                  <input type="text" class="form-control" id="id_kelompok" name="id_kelompok" hidden>
                    <!-- Form -->
                    <div class="form-group">
                      <label for="status_verifikasi" class="col-form-label">Status:</label>
                      <select class="selectric my-1 mr-sm-2" name="status_verifikasi" id="status_verifikasi" required>
                        <option value="" selected disabled>Pilih..</option>
                        <option value="1">Terima</option>
                        <option value="2">Tolak</option>
                      </select>
                    </div>
                    <!-- End Form -->
                    <!-- Form -->
                    <div class="form-group" id="holder-pembimbing">
                      <label for="pembimbing" class="col-form-label">Pembimbing:</label>
                      <select class="selectric my-1 mr-sm-2" name="pembimbing" id="pembimbing">
                        <option value="" selected disabled>Pilih..</option>
                        <?php foreach ($pembimbing as $data) : ?>
                        <option value="<?= $data['id_users']; ?>"><?= $data['nama']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <!-- End Form -->
                    <!-- Form -->
                    <div class="form-group" id="holder-catatan">
                      <label for="catatan" class="col-form-label">Catatan:</label>
                      <textarea style="height: 7rem;"class="form-control" name="catatan" id="catatan"></textarea>
                    </div>
                    <!-- End Form -->
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>  Verifikasi</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir content -->
      </div>
    </div>
  </div>
</div>
<!-- akhir modal -->

<!-- Awal Menampilkan Modal Detail Catatan-->
<div class="modal fade bd-example-modal-lg" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Catatan Perbaikan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <!-- awal content -->
        <div class="section-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <span id="detailCatatanPerbaikan"></span>
              </div>
            </div>
          </div>
        </div>
        <!-- akhir content -->
      </div>
    </div>
  </div>
</div>
<!-- akhir modal -->

<?= $this->endSection() ?>