<!DOCTYPE html>
<html lang="en">

<head> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<?= $this->renderSection('title') ?>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="Neumorphism UI">
<meta name="author" content="Themesberg">

<link rel="canonical" href="https://themesberg.com/product/ui-kits/neumorphism-ui/" />

<!--  Social tags -->
<meta name="keywords" content="neumorphism, neumorphism ui, neomorphism, neomorphism ui, neomorphism css, neumorphism css, neumorph, neumorphic, design system, login, form, table, tables, card, cards, navbar, modal, icons, icons, map, chat, carousel, menu, datepicker, gallery, slider, date, social, dropdown, search, tab, nav, footer, date picker, forms, tabs, time, button, select, input, timeline, cart, about us, account, log in, blog, profile, portfolio, landing page, ecommerce, shop, landing, register, app, contact, one page, sign up, signup, store, bootstrap 4, bootstrap4, dashboard, bootstrap 4 dashboard, bootstrap 4 design, bootstrap 4 system, bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, themesberg, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit">
<meta name="description" content="Start developing neumorphic web applications and pages using Neumorphism UI. It features over 100 individual components and 5 example pages.">

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="Neumorphism UI by Themesberg">
<meta itemprop="description" content="Start developing neumorphic web applications and pages using Neumorphism UI. It features over 100 individual components and 5 example pages.">
<meta itemprop="image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/neumorphism-ui/neumorphism-thumbnail.jpg">

<!-- Twitter Card data -->
<meta name="twitter:card" content="product">
<meta name="twitter:site" content="@themesberg">
<meta name="twitter:title" content="Neumorphism UI by Themesberg">
<meta name="twitter:description" content="Start developing neumorphic web applications and pages using Neumorphism UI. It features over 100 individual components and 5 example pages.">
<meta name="twitter:creator" content="@themesberg">
<meta name="twitter:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/neumorphism-ui/neumorphism-thumbnail.jpg">

<!-- Open Graph data -->
<meta property="fb:app_id" content="214738555737136">
<meta property="og:title" content="Neumorphism UI by Themesberg" />
<meta property="og:type" content="article" />
<meta property="og:url" content="https://demo.themesberg.com/neumorphism-ui/" />
<meta property="og:image" content="https://themesberg.s3.us-east-2.amazonaws.com/public/products/neumorphism-ui/neumorphism-thumbnail.jpg"/>
<meta property="og:description" content="Start developing neumorphic web applications and pages using Neumorphism UI. It features over 100 individual components and 5 example pages." />
<meta property="og:site_name" content="Themesberg" />

<!-- Favicon -->
<link rel="shortcut icon" type="image/png" href="<?=base_url()?>/favicon.ico"/>
<link rel="mask-icon" href="<?=base_url()?>/template_user/assets/img/favicon/safari-pinned-tab.svg" color="#ffffff">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<!-- Fontawesome -->
<link type="text/css" href="<?=base_url()?>/template_user/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

<!-- Pixel CSS -->
<link rel="icon" type="image/png" sizes="32x32" href="<?=base_url()?>/favicon.png">
<link type="text/css" href="<?=base_url()?>/template_user/css/neumorphism.css" rel="stylesheet">
<link type="text/css" href="<?=base_url()?>/template_user/css/qrqodescanning.css" rel="stylesheet">
<link type="text/css" href="<?=base_url()?>/template_user/css/loader.css" rel="stylesheet">

<!-- JS Tambahan -->
<script src="<?=base_url()?>/template_user/assets/js/jquery-3.5.1.js"></script>

<!-- extend CSS ATAS -->
<?= $this->renderSection('CSS_JS_UP') ?>

<!-- NOTICE: You can use the _analytics.html partial to include production code specific code & trackers -->

</head>

<body>

<!-- loading halaman ketika dimuat -->
<div class="bg-loader">
  <div class="loader text-center">
    <img src="<?=base_url()?>/img/loader.gif" />
  </div>
</div>
<!-- End loading halaman ketika dimuat -->

  <!-- menu -->
    <header class="header-global">
    <?= $this->include('users/layout/menu') ?>
    </header>

    <!-- content -->
    <main>

    <!-- menampilkan sweetalert -->
    <div class="flash-data" data-flashdata="<?= session()->getFlashdata('flashdata'); ?>"></div>
    <div class="message-data" data-message="<?= session()->getFlashdata('message'); ?>"></div>
    <!-- End menampilkan sweetalert -->

    <!-- extend content ke view dinamis -->
    <?= $this->renderSection('content') ?>
    <!-- extend content ke view dinamis -->

    </main>

    <!-- Core -->
<script src="<?=base_url()?>/template_user/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/popper.js/dist/umd/popper.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/headroom.js/dist/headroom.min.js"></script>

<!-- Vendor JS -->
<script src="<?=base_url()?>/template_user/vendor/onscreen/dist/on-screen.umd.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/nouislider/distribute/nouislider.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/jarallax/dist/jarallax.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/jquery.counterup/jquery.counterup.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/jquery-countdown/dist/jquery.countdown.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="<?=base_url()?>/template_user/vendor/prismjs/prism.js"></script>

<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Neumorphism JS -->
<script src="<?=base_url()?>/template_user/assets/js/neumorphism.js"></script>
<link type="text/css" href="<?=base_url()?>/template_user/css/loader.css" rel="stylesheet">

<!-- Sweet Alert JS -->
<script src="<?=base_url()?>/template_user/assets/js/sweetalert2.all.min.js"></script>
<script src="<?=base_url()?>/template_user/assets/js/call-sweetalert2.js"></script>

<!-- loader -->
<script type="text/javascript">
$(document).ready(function(){
			$(".bg-loader").fadeOut();
		})
</script>

<!-- render JS GLOBAL IN DINAMIC VIEW-->
<?= $this->renderSection('js_global') ?>

</body>
<?= $this->renderSection('modal') ?>

</html>