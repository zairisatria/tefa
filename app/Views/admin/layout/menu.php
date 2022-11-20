<!-- start mengambil path link url -->
<?php $activePage = basename($_SERVER['PHP_SELF'], ".php"); ?>
<!-- end mengambil path link url -->

<!-- menu admin -->
<?php if (session()->get('roles')=="admin"): ?>
    
    <ul class="sidebar-menu">
        <li class="<?= ($activePage == 'home') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/home')?>"><i class="fas fa-home"></i><span>Home</span></a></li>
        <li class="nav-item dropdown <?= ($activePage == 'prodi' || $activePage == 'satuan') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'prodi') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/prodi')?>" ><i class='fas fa-university'></i><span>Program Studi</span></a></li>
                <li class="<?= ($activePage == 'satuan') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/satuan')?>" ><i class='fa fa-balance-scale'></i><span>Satuan</span></a></li>
            </ul>
        </li>
        <li class="nav-item dropdown <?= ($activePage == 'proposal' || $activePage == 'jobsheet' || $activePage == 'logbook') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i> <span>Workshop</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'proposal') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/proposal')?>" ><i class='fas fa-book-open'></i><span>Proposal</span></a></li>
                <li class="<?= ($activePage == 'jobsheet') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/jobsheet')?>" ><i class='fas fa-calculator'></i><span>Job Sheet</span></a></li>
                <li class="<?= ($activePage == 'logbook') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/logbook')?>" ><i class='fas fa-image'></i><span>Log book</span></a></li>
            </ul>
        </li>
        <li class="nav-item dropdown <?= ($activePage == 'penilaian') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Quality Control</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'penilaian') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/penilaian')?>" ><i class='fas fa-list-alt'></i><span>Penilaian</span></a></li>
            </ul>
        </li>
        <li class="nav-item dropdown <?= ($activePage == 'distribusi') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Pemasaran</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'distribusi') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/distribusi')?>" ><i class='fas fa-shopping-cart'></i><span>Distribusi Produk</span></a></li>
            </ul>
        </li>
        <li class="<?= ($activePage == 'evaluasi') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/evaluasi')?>"><i class='fas fa-file'></i><span>Laporan Evaluasi</span></a></li>
        <li class="nav-item dropdown <?= ($activePage == 'manage-users' || $activePage == 'setting') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-cog"></i> <span>Pengaturan</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'manage-users') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/manage-users')?>" ><i class='fas fa-users'></i><span>Users</span></a></li>
                <li class="<?= ($activePage == 'setting') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/setting')?>" ><i class='fas fa-cog'></i><span>Setting</span></a></li>
            </ul>
        </li>
    </ul>

<?php endif ?>

<!-- menu pembimbing -->
<?php if (session()->get('roles')=="pembimbing"): ?>

    <ul class="sidebar-menu">
        <li class="<?= ($activePage == 'home') ? 'active':''; ?>"><a class="nav-link active" href="<?=site_url('/home')?>"><i class="fas fa-home"></i><span>Home</span></a></li>
        <li class="nav-item dropdown <?= ($activePage == 'proposal' || $activePage == 'jobsheet' || $activePage == 'logbook') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i> <span>Workshop</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'proposal') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/proposal')?>" ><i class='fas fa-book-open'></i><span>Proposal</span></a></li>
                <li class="<?= ($activePage == 'jobsheet') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/jobsheet')?>" ><i class='fas fa-calculator'></i><span>Job Sheet</span></a></li>
                <li class="<?= ($activePage == 'logbook') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/logbook')?>" ><i class='fas fa-image'></i><span>Log book</span></a></li>
            </ul>
        </li>
        <li class="<?= ($activePage == 'evaluasi') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/evaluasi')?>"><i class='fas fa-file'></i><span>Laporan Evaluasi</span></a></li>
    </ul>

<?php endif ?>

<!-- menu Quality Control -->
<?php if (session()->get('roles')=="quality"): ?>
    
    <ul class="sidebar-menu">
        <li class="<?= ($activePage == 'home') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/home')?>"><i class="fas fa-home"></i><span>Home</span></a></li>
        <li class="nav-item dropdown <?= ($activePage == 'penilaian') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Quality Control</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'penilaian') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/penilaian')?>" ><i class='fas fa-list-alt'></i><span>Penilaian</span></a></li>
            </ul>
        </li>
        <li class="<?= ($activePage == 'evaluasi') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/evaluasi')?>"><i class='fas fa-file'></i><span>Laporan Evaluasi</span></a></li>
    </ul>

<?php endif ?>

<!-- menu Kepala -->
<?php if (session()->get('roles')=="kepala" || session()->get('roles')=="kaprodi"): ?>
    
    <ul class="sidebar-menu">
        <li class="<?= ($activePage == 'home') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/home')?>"><i class="fas fa-home"></i><span>Home</span></a></li>
        <li class="nav-item dropdown <?= ($activePage == 'proposal') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-tasks"></i> <span>Workshop</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'proposal') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/proposal')?>" ><i class='fas fa-book-open'></i><span>Proposal</span></a></li>
            </ul>
        </li>
        <li class="<?= ($activePage == 'evaluasi') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/evaluasi')?>"><i class='fas fa-file'></i><span>Laporan Evaluasi</span></a></li>
    </ul>

<?php endif ?>

<!-- menu pemasaran -->
<?php if (session()->get('roles')=="pemasaran"): ?>
    
    <ul class="sidebar-menu">
        <li class="<?= ($activePage == 'home') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/home')?>"><i class="fas fa-home"></i><span>Home</span></a></li>
        <li class="nav-item dropdown <?= ($activePage == 'distribusi') ? 'active':''; ?>">
            <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i> <span>Pemasaran</span></a>
            <ul class="dropdown-menu">
                <li class="<?= ($activePage == 'distribusi') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/distribusi')?>" ><i class='fas fa-shopping-cart'></i><span>Distribusi Produk</span></a></li>
            </ul>
        </li>
        <li class="<?= ($activePage == 'evaluasi') ? 'active':''; ?>"><a class="nav-link" href="<?=site_url('/evaluasi')?>"><i class='fas fa-file'></i><span>Laporan Evaluasi</span></a></li>
    </ul>

<?php endif ?>