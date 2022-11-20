<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <!-- render title secara dinamis -->
  <?= $this->renderSection('title') ?>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/@fortawesome/fontawesome-free/css/all.css">
  
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/node_modules/selectric/public/selectric.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/style.css">
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/components.css">
  <link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>/favicon.png">

  <!-- CSS Tambahan -->
  <link rel="stylesheet" href="<?=base_url()?>/template/assets/css/loader.css">

  <!-- JS Tambahan -->
  <script src="<?=base_url()?>/template/assets/js/jquery-3.5.1.js"></script>
  <script src="<?=base_url()?>/template/assets/js/qrcode.min.js"></script>

  <!-- plugin mpdf -->
  <script src="<?=base_url()?>/template/assets/datatables/pdfmake-0.1.36/pdfmake.js"></script>

  <!-- render css secara dinamis -->
  <?= $this->renderSection('css') ?>
  <!-- End render css secara dinamis -->

</head>

<body>

<!-- loading halaman ketika dimuat -->
<div class="bg-loader">
  <div class="loader text-center">
    <img src="<?=base_url()?>/img/loader.gif" />
  </div>
</div>
<!-- End loading halaman ketika dimuat -->

  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
          
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
          <img alt="image" src="<?=base_url()?>/img/users/<?= session('photo') ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?= session('nama') ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <a href="<?=base_url('/profile')?>" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
              <a href="<?=base_url('/logout')?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">TEACHING FACTORY</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">TEFA </a>
          </div>
          <!-- isi content menu -->
          <?= $this->include('admin/layout/menu') ?>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">

      <!-- menampilkan sweetalert -->
      <div class="flash-data" data-flashdata="<?= session()->getFlashdata('flashdata'); ?>"></div>
      <div class="message-data" data-message="<?= session()->getFlashdata('message'); ?>"></div>
      <!-- End menampilkan sweetalert -->
        
        <!-- isi content dinamis -->
        <?= $this->renderSection('content') ?>
        </section>
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; <?= date('Y')?> <div class="bullet"></div> Development By <a href="https://api.whatsapp.com/send?phone=6281318739245">Zairi</a>
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  </body>
  <?= $this->renderSection('modal') ?>

  <!-- General JS Scripts -->
  <script src="<?=base_url()?>/template/node_modules/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <script src="<?=base_url()?>/template/node_modules/nicescroll/dist/jquery.nicescroll.js"></script>
  <script src="<?=base_url()?>/template/node_modules/moment/moment.js"></script>
  <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="<?=base_url()?>/template/node_modules/select2/dist/js/select2.full.min.js"></script>
  <script src="<?=base_url()?>/template/node_modules/selectric/public/jquery.selectric.min.js"></script>

  <!-- Template JS File -->
  <script src="<?=base_url()?>/template/assets/js/scripts.js"></script>
  <script src="<?=base_url()?>/template/assets/js/custom.js"></script>
  <script src="<?=base_url()?>/template/assets/js/stisla.js"></script>
  <script src="<?=base_url()?>/template/assets/js/sweetalert2.all.min.js"></script>
  <script src="<?=base_url()?>/template/assets/js/call-sweetalert2.js"></script>

  <!-- render javascript secara dinamis -->
  <?= $this->renderSection('javascript') ?>
  <!-- End render javascript secara dinamis -->

  <!-- Page Specific JS File -->
  <!-- loader -->
<script type="text/javascript">
$(document).ready(function(){
			$(".bg-loader").fadeOut();
		})
</script>
</html>
