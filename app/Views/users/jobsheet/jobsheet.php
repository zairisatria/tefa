<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Jobsheet</title>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<!-- menampilkan isi content secara dinamis -->
<?php $validation =  \Config\Services::validation() ?>
    <div class="container-fluid">
        <!-- tab style -->
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8 mt-3">
                <!-- Head Button -->
                <div class="row justify-content-center mb-3">
                    <div class="col-12">
                        <a type="button" target="_blank" class="btn btn-facebook btn-block" href="<?=site_url('/laporan-jobsheet')?>"><small><i class="fas fa-print"></i>Print</small></a>
                        <!-- <button type="button" class="btn btn-facebook btn-block" id="cetak_pdf"><small><i class="fas fa-print"></i>Print</small></button> -->
                    </div>
                </div>
                <!-- End Head Button -->
                <!-- Tab Content -->
                <div class="card shadow-inset bg-primary border-light p-3 rounded">
                    <div class="card-body p-0">
                        <div class="tab-content" id="tabcontent2">
                            <div class="tab-pane fade show active" id="tabs-icons-text-0" role="tabpanel" aria-labelledby="tabs-icons-text-0-tab">
                                <!-- Tab -->
                                <div class="row">
                                    <div class="col-md-12 col-lg-12 col-sm-12">
                                        <!-- Tab Nav -->
                                        <div class="nav-wrapper position-relative mb-4">
                                            <ul class="nav nav-pills flex-column flex-sm-row" id="tabs-text" role="tablist">
                                                <li class="nav-item mr-sm-3 mr-md-0">
                                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-text-1-tab" data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1" aria-selected="true">Alat</a>
                                                </li>
                                                <li class="nav-item mr-sm-3 mr-md-0">
                                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-2-tab" data-toggle="tab" href="#tabs-text-2" role="tab" aria-controls="tabs-text-2" aria-selected="false">Bahan</a>
                                                </li>
                                                <li class="nav-item mr-sm-3 mr-md-0">
                                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-text-3-tab" data-toggle="tab" href="#tabs-text-3" role="tab" aria-controls="tabs-text-3" aria-selected="false">Langkah</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- End of Tab Nav -->
                                        <!-- Tab Content -->
                                        <div class="card shadow-inset bg-primary border-light p-4 rounded">
                                            <div class="card-body p-0">
                                                <div class="tab-content" id="tabcontent1">
                                                    <div class="tab-pane fade active show" id="tabs-text-1" role="tabpanel" aria-labelledby="tabs-text-1-tab">
                                                        <div class="row justify-content-right mb-3">
                                                            <div class="col-3">
                                                                <a href="<?=site_url('/alat')?>" class="btn btn-facebook btn-block"><i class="fas fa-plus-circle"></i></a>
                                                            </div>
                                                        </div>
                                                        <!-- Table -->
                                                        <div class="table-responsive-sm shadow-soft rounded">
                                                            <table class="table table-striped table-sm table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="border-0" scope="col">#</th>
                                                                        <th class="border-0" scope="col">Alat</th>
                                                                        <th class="border-0 text-center" scope="col">Jumlah</th>
                                                                        <th class="border-0 text-center" scope="col" colspan="2">Opsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                                                                <?php foreach ($data_pagination_alat as $data) : ?>
                                                                    <tr>
                                                                        <td><small><?= $i++; ?></small></td>
                                                                        <td><?= $data['alat']; ?></td>
                                                                        <td class="text-center"><?= $data['jumlah']; ?></td>
                                                                        <td class="text-center">
                                                                            <a href="<?=base_url('/edit-alat/'.$data['id'])?>" class="btn btn-icon-only btn-pill btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                                        </td>
                                                                        <td>
                                                                            <a href="<?=base_url('/delete-alat/'.$data['id'])?>" class="btn btn-icon-only btn-pill btn-danger btn-sm" id="tombol_hapus"><i class="fa fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- End Table -->
                                                        <div class="row ">
                                                            <?= $pager_alat->links('default', 'custom_pagination') ?>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tabs-text-2" role="tabpanel" aria-labelledby="tabs-text-2-tab">
                                                        <div class="row justify-content-right mb-3">
                                                            <div class="col-3">
                                                                <a href="<?=site_url('/bahan')?>" class="btn btn-facebook btn-block"><i class="fas fa-plus-circle"></i></a>
                                                            </div>
                                                        </div>
                                                        <!-- Table -->
                                                        <div class="table-responsive-sm shadow-soft rounded">
                                                            <table class="table table-striped table-sm table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="border-0" scope="col">#</th>
                                                                        <th class="border-0" scope="col">Bahan</th>
                                                                        <th class="border-0 text-center" scope="col">Harga</th>
                                                                        <th class="border-0 text-center" scope="col">Jumlah</th>
                                                                        <th class="border-0 text-center" scope="col">Satuan</th>
                                                                        <th class="border-0 text-center" scope="col">Total</th>
                                                                        <th class="border-0 text-center" scope="col" colspan="2">Opsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                                                                <?php foreach ($data_pagination_bahan as $data) : ?>
                                                                    <tr>
                                                                        <td><small><?= $i++; ?></small></td>
                                                                        <td><?= $data['bahan']; ?></td>
                                                                        <td class="text-center"><?php echo number_format( $data['harga'],2); ?></td>
                                                                        <td class="text-center"><?= $data['jumlah']; ?></td>
                                                                        <td class="text-center"><?= $data['satuan']; ?></td>
                                                                        <td class="text-center"><?php echo number_format($data['harga'] * $data['jumlah'],2); ?></td>
                                                                        <td class="text-center">
                                                                            <a href="<?=base_url('/edit-bahan/'.$data['id'])?>" class="btn btn-icon-only btn-pill btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                                        </td>
                                                                        <td>
                                                                            <a href="<?=base_url('/delete-bahan/'.$data['id'])?>" class="btn btn-icon-only btn-pill btn-danger btn-sm" id="tombol_hapus"><i class="fa fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- End Table -->
                                                        <div class="row ">
                                                            <?= $pager_bahan->links('default', 'custom_pagination') ?>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="tabs-text-3" role="tabpanel" aria-labelledby="tabs-text-3-tab">
                                                        <div class="row justify-content-right mb-3">
                                                            <div class="col-3">
                                                                <a href="<?=site_url('/langkah-kerja')?>" class="btn btn-facebook btn-block"><i class="fas fa-plus-circle"></i></a>
                                                            </div>
                                                        </div>
                                                        <!-- Table -->
                                                        <div class="table-responsive-sm shadow-soft rounded">
                                                            <table class="table table-striped table-sm table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="border-0" scope="col">#</th>
                                                                        <th class="border-0" scope="col">Langkah</th>
                                                                        <th class="border-0 text-center" scope="col" colspan="2">Opsi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                                                                <?php foreach ($data_pagination_langkah as $data) : ?>
                                                                    <tr>
                                                                        <td><small><?= $i++; ?></small></td>
                                                                        <td><?= $data['langkah']; ?></td>
                                                                        <td class="text-center">
                                                                            <a href="<?=base_url('/edit-langkah/'.$data['id'])?>" class="btn btn-icon-only btn-pill btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                                                        </td>
                                                                        <td>
                                                                            <a href="<?=base_url('/delete-langkah/'.$data['id'])?>" class="btn btn-icon-only btn-pill btn-danger btn-sm" id="tombol_hapus"><i class="fa fa-trash"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- End Table -->
                                                        <div class="row ">
                                                            <?= $pager_langkah->links('default', 'custom_pagination') ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Tab Content -->
                                    </div>
                                </div>
                                <!-- End Tab -->
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
<script>
</script>


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