<!-- menangkap layout template -->
<?= $this->extend('admin/layout/default') ?>
<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Home</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<!-- menampilkan isi content secara dinamis -->

<div class="section-header">
  <h1>Home</h1>
</div>
<div class="section-body">
	<div class="row">
    <!-- Start Grafik 1 -->
	  <div class="col-md-12">
      <div class="card">
      <div class="card-header">
      <h4 class="section-title text-dark">Data Anggaran / Biaya Pengajuan Proposal Per Kelompok</h4>
      </div>
        <div class="card-body">
          <!-- Content Card -->
          
          <div>
          <canvas id="myChart" width="100" height="40"></canvas>
          </div>
          <!-- End Content Card -->
        </div>
      </div>
	  </div>
    <!-- End Grafik 1 -->
    <!-- Start Grafik 2 -->
    <div class="col-md-6 col-lg-6 col-sm-12">
      <div class="card">
      <div class="card-header">
      <h4 class="section-title text-dark">Data Proposal Yang Diproses</h4>
      </div>
        <div class="card-body">
          <!-- Content Card -->
          
          <div>
          <canvas id="proposal" width="40" height="40"></canvas>
          </div>
          <!-- End Content Card -->
        </div>
      </div>
	  </div>
    <!-- End Grafik 2 -->
  </div>
</div>
<?= $this->endSection() ?>

<!-- Start Load Javascript -->
<?= $this->section('javascript') ?>
<script src="<?=base_url()?>/template/assets/js/chart-js/chart-3.9.1.js"></script>
<!-- End Load Javascript -->

<!-- Chart Anggaran/Biaya -->
<script>
  const ctx = document.getElementById('myChart').getContext('2d');
  const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php foreach ($biaya as $data) {echo '"'.$data['judul'].'",';} ?>],
        datasets: [{
            label: '# Data Anggaran / Biaya',
            data: [ <?php foreach ($biaya as $data) {echo '"'.$data['total'].'",';} ?> ],
            backgroundColor: [
                'rgba(255, 99, 132, 80)',
                'rgba(54, 162, 235, 80)',
                'rgba(255, 206, 86, 80)',
                'rgba(75, 192, 192, 80)',
                'rgba(153, 102, 255, 80)',
                'rgba(255, 159, 64, 80)',

                'rgba(255, 99, 132, 80)',
                'rgba(54, 162, 235, 80)',
                'rgba(255, 206, 86, 80)',
                'rgba(75, 192, 192, 80)',
                'rgba(153, 102, 255, 80)',
                'rgba(255, 159, 64, 80)',

                'rgba(255, 99, 132, 80)',
                'rgba(54, 162, 235, 80)',
                'rgba(255, 206, 86, 80)',
                'rgba(75, 192, 192, 80)',
                'rgba(153, 102, 255, 80)',
                'rgba(255, 159, 64, 80)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',

                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',

                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

<!-- Chart Proposal yang diproses -->
<script>
  const ctx2 = document.getElementById('proposal').getContext('2d');
  const myChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: [<?php foreach ($proposal as $data) {echo '"'.$data['status_proposal'].'",';} ?>],
        datasets: [{
            label: '# Data Anggaran / Biaya',
            data: [ <?php foreach ($proposal as $data) {echo '"'.$data['jumlah'].'",';} ?> ],
            backgroundColor: [
              'rgb(255, 99, 132)',
              'rgb(54, 162, 235)',
              'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    },
});
</script>

<?= $this->endSection() ?>
