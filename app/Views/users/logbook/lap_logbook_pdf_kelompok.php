<html>
<head>
<style>
body {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12pt;
}
table {
	font-size: 12pt;
	font-family: Arial;
	border-collapse: collapse;
	width: 100%;
}
p {
	margin: 0pt;
}
table.items {
	border: 0.1mm solid #000000;
}
td {
	vertical-align: top;
}
.items td {
	border: 0.1mm solid #000000;
}
table thead th {
	font-weight: bold;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: Arial, Helvetica, sans-serif;
	font-size: 12;
}
table tbody td {
	border: 0.1mm solid #000000;
	font-variant: Arial, Helvetica, sans-serif;
	font-size: 12;
}
.text-bold {
	font-weight: bold;
}
.text-font-arial {
	font-family: Arial;
}
.text-font-serif {
	font-family: sans-serif;
}
.text-font-helvetica {
	font-family: Helvetica;
}
.text-underline {
	text-decoration: underline;
}
.text-center {
	text-align: center;
}
</style>
</head>
<body>
	<div style="text-align: right; font-size: 7pt; ">Tanggal Cetak: <?= date("d-F-Y H:i:s") ?> </div>
	<h5 class="text-center">Log Book <?= $proposal['judul']; ?></h5>
<br />
	<table class="items" cellpadding="5">
		<thead>
			<tr>
				<th class="text-left">No.</th>
				<th>Nama</th>
				<th>Waktu</th>
				<th>Aktifitas</th>
				<th>Keluaran</th>
			</tr>
		</thead>
		<tbody>
			<!-- ITEMS HERE -->
			<?php $no=1; ?>
			<!-- END ITEMS HERE -->
			<?php foreach ($logbook as $data) : ?>
			<tr>
				<td class="text-center"><?= $no++."."; ?></td>
				<td><?= $data['nama'] ?></td>
				<td class="text-center"><?= $data['dari'].' - '. $data['sampai'] ?></td>
				<td><?= $data['aktivitas'] ?></td>
				<td><?= $data['keluaran'] ?></td>
			</tr>
			<!-- ITEMS HERE -->
			<tr>
				<td colspan="5">
					<?php foreach ($d_logbook as $data_detail) : ?>
						<?php if ($data['uuid'] == $data_detail['uuid'] && $data['id_kelompok'] == $data_detail['id_kelompok']): ?>
							<img width="150px" src="./files/logbook_dokumentasi/<?= $data_detail['files']?>" alt="dokumentasi">
						<?php endif ?>
					<?php endforeach; ?>
					</td>
				</tr>
			<!-- END ITEMS HERE -->
			<?php endforeach; ?>
		</tbody>
	</table>


</body>
</html>