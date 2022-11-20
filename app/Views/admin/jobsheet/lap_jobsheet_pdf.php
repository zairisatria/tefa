<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}

p {	
	margin: 0pt;
}

td {
	vertical-align: top;
}

table thead th {
	text-align: left;
	border: 0.1mm solid #000000;
	font-variant: sans-serif;
	border: 0mm none #000000;
}

.text-left {
	text-align: left;
}

.text-right {
	text-align: right;
}

.text-bold {
	font-weight: bold;
}

</style>
</head>
	<body>
	<div style="text-align: right; font-size: 7pt; ">Tanggal Cetak: <?= date("d-F-Y H:i:s") ?> </div>

	<?php foreach ($proposal as $data) : ?>
	<h3 align="center"> <?= $data['judul']; ?> </h3>
	<?php endforeach; ?>

	<br>
	<!-- Tabel Alat -->
	<table style="font-family: sans-serif;"><tr>
		<thead>
			<tr>
				<th>A.</th>
				<th colspan="2">ALAT</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>

			<?php $no=1; ?>
			<?php foreach ($alat as $data) : ?>
			<tr>
				<td></td>
				<td> <?= $no++.'.'; ?> </td>
				<td> <?= $data['alat']; ?> </td>
				<td>&nbsp;&nbsp;:</td>
				<td> <?= $data['jumlah']; ?> </td>
			</tr>
			<?php endforeach; ?>

		</tbody>
	</table>
	<!-- End Tabel Alat -->
	<br>
	<!-- Tabel Bahan -->
	<table style="font-family: sans-serif;"><tr>
		<thead>
			<tr>
				<th>B.</th>
				<th colspan="2">BAHAN</th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>

			<?php $no=1; ?>
			<?php foreach ($bahan as $data) : ?>
			<tr>
				<td></td>
				<td> <?= $no++.'.'; ?> </td>
				<td> <?= $data['bahan']; ?> </td>
				<td>&nbsp;&nbsp;:&nbsp;</td>
				<td> <?= $data['jumlah'].'  '.$data['satuan']; ?> </td>
				<td>&nbsp;&nbsp;x&nbsp;&nbsp;</td>
				<td class="text-right"> <?= 'Rp '.number_format($data['harga'],2); ?></td>
				<td>&nbsp;&nbsp;= &nbsp;&nbsp;</td>
				<td class="text-right"> <?= 'Rp '. number_format($data['harga']*$data['jumlah'],2); ?></td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td class="text-right text-bold">
					<?= 'Rp '. number_format($total_bahan['total_bahan'],2); ?>
				</td>
			</tr>
		</tbody>
	</table>
	<!-- End Tabel Bahan -->
	<br>
	<!-- Tabel Langkah Kerja -->
	<table style="font-family: sans-serif;"><tr>
		<thead>
			<tr>
				<th>C.</th>
				<th colspan="2">LANGKAH KERJA</th>
			</tr>
		</thead>
		<tbody>

			<?php $no=1; ?>
			<?php foreach ($langkah as $data) : ?>
			<tr>
				<td></td>
				<td> <?= $no++.'.'; ?> </td>
				<td> <?= $data['langkah']; ?> </td>
			</tr>
			<?php endforeach; ?>

		</tbody>
	</table>
	<!-- End Tabel Langkah Kerja -->
	</body>
</html>