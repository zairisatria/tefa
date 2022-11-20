<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; Tefa</title>

  <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>/favicon.png">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/@fortawesome/fontawesome-free/css/all.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/components.css">

    <!-- JS Tambahan -->
    <script src="<?=base_url()?>/template/assets/js/jquery-3.5.1.js"></script>
</head>

<body>
  <div id="app">
    <section class="section">

        <!-- menampilkan sweetalert -->
      <div class="flash-data" data-flashdata="<?= session()->getFlashdata('flashdata'); ?>"></div>
      <div class="message-data" data-message="<?= session()->getFlashdata('message'); ?>"></div>
      <!-- End menampilkan sweetalert -->

      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2"  style="background: rgb(9,101,124);
background: radial-gradient(circle, rgba(9,101,124,1) 0%, rgba(75,123,180,1) 100%);">
          <div class="p-4 m-3">
            <img src="<?=base_url()?>/img/logo.png" alt="logo tefa" width="80" class="shadow-light rounded-circle mb-5 mt-2">
            <h4 class="text-white font-weight-normal">Selamat datang di <span class="font-weight-bold">Teaching Factory (TEFA)</span></h4>
            <p class="text-muted">Sebelum memulai, anda harus login atau mendaftar jika belum memiliki akun.</p>
            <?php $validation =  \Config\Services::validation() ?>
            <form action="<?=site_url('/proseslogin')?>" method="post" class="mt-4 needs-validation">
            <?= csrf_field() ?>
                <!-- Form -->
                <div class="form-group">
                    <label class="text-white" for="email">Email / Nama Pengguna</label>
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><span class="fas fa-envelope"></span></span>
                        </div>
                        <input class="form-control <?= $validation->hasError('email') ? 'is-invalid' : null ?>" id="email" name="email" value="<?= old('email') ?>" placeholder="example@mail.com" type="text" aria-label="email atau username" tabindex="1" autofocus required>
                        <div class="invalid-feedback">
                            <?= $error = $validation->getError('email'); ?>
                        </div>
                    </div>
                </div>
                <!-- End of Form -->
                <div class="form-group">
                    <!-- Form -->
                    <div class="form-group">
                        <label class="text-white" for="password">Password</label>
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><span class="fas fa-unlock-alt"></span></span>
                            </div>
                            <input class="form-control <?= $validation->hasError('password') ? 'is-invalid' : null ?>" id="password"  name="password" value="<?= old('password') ?>" placeholder="Password" type="password" aria-label="Password" tabindex="2" required>
                            <div class="invalid-feedback">
                                <?= $error = $validation->getError('password'); ?>
                            </div>
                        </div>
                    </div>
                    <!-- End of Form -->
                </div>
                <!-- End Form -->
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                        <label class="custom-control-label text-muted" for="remember-me">Ingat Saya</label>
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-light btn-lg btn-icon icon-right" tabindex="4">
                        Login
                    </button>
                </div>

                <div class="mt-4 text-center text-muted">
                    Belum memiliki akun? <a class="text-white" href="<?=base_url('/registrasi')?>">Daftar</a>
                </div>
            </form>

          </div>
        </div>
        <div class="d-none d-sm-none d-md-block d-lg-block col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?=base_url()?>/img/supm.png">
          <div class="absolute-bottom-left index-2">
            <div class="p-5 pb-2">
              <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold text-primary" style="text-shadow: 0 0 3px white, 0 0 3px white;">SUPM PONTIANAK</h1>
                <h5 class="font-weight-normal text-muted-transparent">Pontianak, Kalimantan Barat</h5>
              </div>
              <div class="text-white">
                BADAN RISET SDM KELAUTAN DAN PERIKANAN SUPM PONTIANAK
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="<?=base_url()?>/template/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script src="<?=base_url()?>/template/node_modules/nicescroll/dist/jquery.nicescroll.js"></script>
  <script src="<?=base_url()?>/template/node_modules/moment/moment.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="<?=base_url()?>/template/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>/template/assets/js/custom.js"></script>
  <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>
  <script src="<?=base_url()?>/template/assets/js/sweetalert2.all.min.js"></script>
  <script src="<?=base_url()?>/template/assets/js/call-sweetalert2.js"></script>

  <!-- mencegah spasi ketika ganti password baru -->
<script>
$("#password").on({
    keydown: function(e) {
    if (e.which === 32)
        return false;
    },
    change: function() {
    this.value = this.value.replace(/\s/g, "");
    }
});
</script>

  <!-- Page Specific JS File -->
</body>
</html>
