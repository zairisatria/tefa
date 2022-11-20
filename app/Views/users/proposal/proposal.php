<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Proposal</title>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<!-- menampilkan isi content secara dinamis -->
<?php $validation =  \Config\Services::validation() ?>
<div class="container-fluid">
    <!-- tab style -->
    <div class="row justify-content-center">

        <div class="col-md-12 col-lg-8 mt-3">
            <div class="alert alert-success shadow-inset" role="alert">
                <span class="alert-inner--text">Ajukan proposal, proposal berlaku untuk kelompok, cukup satu orang dari kelompok yang mengupload.</span>
            </div>
            <!-- Tab Content -->
            <div class="card shadow-inset bg-primary border-light p-3 rounded">
                <div class="card-body p-0">
                    <div class="tab-content" id="tabcontent2">
                        <div class="tab-pane fade show active" id="tabs-icons-text-0" role="tabpanel" aria-labelledby="tabs-icons-text-0-tab">
                            <div class="row justify-content-right mb-3">
                                <div class="col-sm-6 col-md-3 col-lg-3">
                                    <a href="<?= site_url('/pengajuan-proposal') ?>" class="btn btn-facebook btn-block"><i class="fas fa-plus-circle"></i> Ajukan</a>
                                </div>
                            </div>
                            <!-- End of Form -->
                            <div class="table-responsive-sm shadow-soft rounded">
                                <table class="table table-striped table-sm table-hover">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="border-0" scope="col">#</th>
                                            <th class="border-0" scope="col">Proposal</th>
                                            <th>File</th>
                                            <th class="border-0" scope="col">Status</th>
                                            <th class="border-0" scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 ?>
                                        <?php foreach ($proposal as $data) : ?>
                                            <tr>
                                                <td><small><?= $i++; ?></small></td>
                                                <td><?= $data['judul']; ?></td>
                                                <td class="text-center">
                                                    <small><a class="btn btn-icon-only btn-pill btn-facebook btn-sm" href="<?= base_url() ?>/files/proposal/<?= $data['files']; ?>" target="_blank"><i class="fas fa-download"></i></a></small>
                                                </td>
                                                <?php if ($data['status_proposal'] == "0") {
                                                    $status_proposal = "Diproses..";
                                                    $icon = "text-info fas fa-spinner fa-spin";
                                                } else if ($data['status_proposal'] == "1") {
                                                    $status_proposal = "Diterima";
                                                    $icon = "text-success fas fa-check";
                                                } else {
                                                    $status_proposal = "Ditolak";
                                                    $icon = "text-danger fas fa-times";
                                                } ?>
                                                <td class="text-center"><small><i class="<?= $icon; ?>"></i> <?= $status_proposal; ?></small></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-icon-only btn-pill btn-primary btn-sm" id="tombolDetails" data-toggle="modal" data-target="#modalDetails" data-id="<?= $data['id']; ?>" data-judul="<?= $data['judul']; ?>" data-created_at="<?= $data['created_at']; ?>" data-updated_at="<?= $data['updated_at']; ?>" data-nama="<?= $data['nama']; ?>" data-catatan_perbaikan="<?= $data['catatan_perbaikan']; ?>" data-nama_pembimbing="<?= $data['nama_pembimbing']; ?>"><i class="fas fa-info-circle"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end menampilkan data izin -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Tab Content -->
        </div>
    </div>
    <!-- end tab style -->
</div>

<!-- CUSTOM JS PARCIAL-->
<!-- Menampilkan modal detail data -->
<script>
    $(document).ready(function() {
        $(document).on('click', '#tombolDetails', function() {
            // mengambil nilai dari data
            var id = $(this).data('id');
            var judul = $(this).data('judul');
            var created_at = $(this).data('created_at');
            var updated_at = $(this).data('updated_at');
            var nama = $(this).data('nama');
            var nama_pembimbing = $(this).data('nama_pembimbing');
            var catatanPerbaikan = $(this).data('catatan_perbaikan');
            // parse nilai kedalam tabel sesuai ID
            $('#detailId').text(id);
            $('#detailJudul').text(judul);
            $('#detailDiajukan').text(created_at);

            if (catatanPerbaikan == "") {
                $('#detailCatatanPerbaikan').text("Tidak ada catatan..");
            } else {
                $('#detailCatatanPerbaikan').text(catatanPerbaikan);
            }
            if (nama == "") {
                $('#detailWaktuVerifikasi').text("Belum Diverifikasi");
                $('#detailDiverifikasiOleh').text("Belum Diverifikasi");
            } else {
                $('#detailWaktuVerifikasi').text(updated_at);
                $('#detailDiverifikasiOleh').text(nama);
            }
            if (nama_pembimbing == "") {
                $('#detailNamaPembimbing').text("Belum Ada Pembimbing");
            } else {
                $('#detailNamaPembimbing').text(nama_pembimbing);
            }
        })
    });
</script>
<!-- Akhir menampilkan modal detail data -->


<?= $this->endSection() ?>
<!-- END SECTION DINAMIC VIEW CONTENT -->

<!-- render JS GLOBAL IN DINAMIC VIEW-->
<?= $this->section('js_global') ?>

<script>

</script>
<?= $this->endSection() ?>

<!-- modal section -->
<?= $this->section('modal') ?>

<!-- Awal Menampilkan Modal detail data-->
<div class="modal fade bd-example-modal-lg" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- awal content -->
                <div class="section-body">
                    <div class="row">
                        <div class="col-12">
                            <table>
                                <thead>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Judul Proposal</td>
                                        <td>:</td>
                                        <td id="detailJudul"></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Pengajuan</td>
                                        <td>:</td>
                                        <td id="detailDiajukan"></td>
                                    </tr>
                                    <tr>
                                        <td>Waktu Verifikasi</td>
                                        <td>:</td>
                                        <td id="detailWaktuVerifikasi"></td>
                                    </tr>
                                    <tr>
                                        <td>Diverifikasi Oleh</td>
                                        <td>:</td>
                                        <td id="detailDiverifikasiOleh"></td>
                                    </tr>
                                    <tr>
                                        <td>Catatan</td>
                                        <td>:</td>
                                        <td id="detailCatatanPerbaikan"></td>
                                    </tr>
                                    <tr>
                                        <td>Pembimbing</td>
                                        <td>:</td>
                                        <td id="detailNamaPembimbing"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- akhir content -->
            </div>
        </div>
    </div>
</div>
<!-- akhir modal detail data -->

<?= $this->endSection() ?>