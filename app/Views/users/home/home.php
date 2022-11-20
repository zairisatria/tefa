<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Home</title>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<!-- menampilkan isi content secara dinamis -->
<?php $validation =  \Config\Services::validation() ?>
<nav class="navbar navbar-light bg-primary sticky-top">
<div>
    <small><img src="<?=base_url()?>/img/users/<?= $users['photo'] ?>" style="border-radius: 50%; vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" alt="foto profil"></small>
    <small><span class="icon-tertiary badge badge-gray mt-3 ml-1"><?=  session('nama') ?>, <a class="text-danger" href="<?=site_url('/logout')?>">Logout</a></span></small>
</div>
</nav>
<div class="container-fluid">
    <!-- tab style -->
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-8 mt-3">
                <!-- Foto dan Nama User -->
                <!-- <div class="container-fluid">
                    <div class="row bg-primary align-left">
                        <div class="col-12">
                            <small><img src="<?=base_url()?>/img/users/<?= $users['photo'] ?>" style="border-radius: 50%; vertical-align: middle; width: 50px; height: 50px; border-radius: 50%;" alt="foto profil"></small>
                            <small><span class="icon-tertiary badge badge-gray mt-3 ml-1"><?=  session('nama') ?>, <a class="text-danger" href="<?=site_url('/logout')?>">Logout</a></span></small>
                        </div>
                    </div>
                </div> -->
                <!-- End Foto dan Nama User -->
                <?php if ($d_logbook): ?>
                <!-- Carousel -->
                <div id="Carousel2" class="carousel slide shadow-soft border border-light p-4 rounded mt-3" data-ride="carousel">
                    <div class="carousel-inner rounded" style="width: 100%; height: 400px !important;">
                        <?php $i = 0; ?>
                        <?php foreach ($d_logbook as $data) : ?>
                        <?= $i++; ?>
                        <div class="carousel-item <?php if ($i <= 1) {echo" active ";} ?>">
                            <img class="d-block img-fluid" src="<?=base_url()?>/files/logbook_dokumentasi/<?= $data['files'];?>" alt="gambar logbook">
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <a class="carousel-control-prev" href="#Carousel2" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#Carousel2" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- End of Carousel -->
                <?php endif ?>

                <?php if (!$d_logbook): ?>
                <!-- Carousel -->
                <div class="container-fluid mt-3">
                    <div id="Carousel4" class="carousel slide shadow-soft border border-light p-4 rounded" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#Carousel4" data-slide-to="0" class="active"></li>
                            <li data-target="#Carousel4" data-slide-to="1"></li>
                            <li data-target="#Carousel4" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner rounded">
                            <div class="carousel-item overlay-primary active">
                                <img class="d-block w-100" src="<?=base_url()?>/img/logbook/image-1.jpg" alt="First slide">
                                <div class="carousel-caption d-none d-md-block text-dark">
                                    <h3 class="h5">Belum ada dokumentasi logbook</h3>
                                    <p>Belum ada dokumentasi logbook.
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item overlay-primary">
                                <img class="d-block w-100" src="<?=base_url()?>/img/logbook/image-1.jpg" alt="Second slide">
                                <div class="carousel-caption d-none d-md-block text-dark">
                                    <h3 class="h5">Belum ada dokumentasi logbook</h3>
                                    <p>Belum ada dokumentasi logbook.
                                    </p>
                                </div>
                            </div>
                            <div class="carousel-item overlay-primary">
                                <img class="d-block w-100" src="<?=base_url()?>/img/logbook/image-1.jpg" alt="Third slide">
                                <div class="carousel-caption d-none d-md-block text-dark">
                                    <h3 class="h5">Belum ada dokumentasi logbook</h3>
                                    <p>Belum ada dokumentasi logbook.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#Carousel4" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#Carousel4" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <!-- End of Carousel -->
                <?php endif ?>

                <!-- Card Menu Start -->
                <div class="bg-primary text-dark">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <a href="<?=site_url('/proposal')?>">
                                <div class="col-6">
                                    <!-- <div class="bg-primary text-dark"> -->
                                    <div class="card bg-gray mt-4 border-light shadow-soft">
                                        <div class="card-body">
                                            <div class="row justify-content-left">
                                                <h6 class="text-white">PROPOSAL</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <small><span class="h6 icon-tertiary badge badge-gray text-uppercase"></span></small>
                                                </div>
                                                <div class="col-4">
                                                    <a href="<?=site_url('/proposal')?>" class="btn btn-lg btn-icon-only btn-secondary">
                                                    <i class="fa fa-book" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div> -->
                                </div>
                            </a>
                            <a href="<?=site_url('/jobsheet')?>">
                                <div class="col-6">
                                    <!-- <div class="bg-primary text-dark"> -->
                                    <div class="card bg-danger mt-4 border-light shadow-soft">
                                        <div class="card-body">
                                            <div class="row justify-content-left">
                                                <h6 class="text-white ">JOBSHEET</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <small><span class="h6 icon-tertiary badge badge-gray text-uppercase"></span></small>
                                                </div>
                                                <div class="col-4">
                                                    <a href="<?=site_url('/jobsheet')?>" class="btn btn-lg btn-icon-only btn-danger">
                                                    <i class="fa fa-tasks" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </a>
                            <a href="<?=site_url('/logbook')?>">
                                <div class="col-6">
                                    <!-- <div class="bg-primary text-dark"> -->
                                    <div class="card bg-info mt-4 border-light shadow-soft">
                                        <div class="card-body">
                                            <div class="row justify-content-left">
                                                <h6 class="text-white">LOGBOOK</h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <small><span class="h6 icon-tertiary badge badge-gray text-uppercase"></span></small>
                                                </div>
                                                <div class="col-4">
                                                    <a href="<?=site_url('/logbook')?>" class="btn btn-lg btn-icon-only btn-primary">
                                                        <i class="fa fa-file" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                    </div>
                                </div>
                            </a>
                            <a href="<?=site_url('/logbook-kelompok')?>">
                                <div class="col-6">
                                    <!-- <div class="bg-primary text-dark"> -->
                                    <div class="card bg-primary mt-4 border-light shadow-soft">
                                        <div class="card-body">
                                            <div class="row bg-primary justify-content-left">
                                                <h6 class="text-danger"><span class="text-small">LOGBOOK KLP</span></h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <small><span class="h6 icon-tertiary badge badge-gray text-uppercase"></span></small>
                                                </div>
                                                <div class="col-4">
                                                    <a href="<?=site_url('/logbook-kelompok')?>" class="btn btn-lg btn-icon-only btn-danger">
                                                        <i class="fa fa-user-friends" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- Card Menu ENd -->

                <!-- Token -->
                <?php if (session()->get('status_kelompok') == "1"): ?>
                <div class="container-fluid mt-2">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <div class="form-group mt-2">
                                <label class="h6 font-weight-light text-gray" for="key">Token Kelompok</label>
                                <div class="d-flex flex-row justify-content-center">
                                    <div class="input-group">
                                        <input class="form-control form-control-sm border-light" id="key" value="<?= $users['token_kelompok']; ?>" placeholder="Token Kelompok Anda" type="text" readonly>
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-primary rounded-right" id="copyBtn"><i class="fas fa-clipboard"></i> Copy</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif ?>
                <!-- End Token -->

            </div>
        </div>
        <!-- end tab style -->
    </div>
    <br><br><br><br>

<!-- CUSTOM JS PARCIAL-->
<script>
const copyBtn = document.getElementById("copyBtn");
const copyText = document.getElementById("key");

copyBtn.onclick = () =>{
  copyText.select();
  document.execCommand('copy');
  Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Text berhasil di salin',
                showConfirmButton: false,
                timer: 1000
            })
}
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

<?= $this->endSection() ?>