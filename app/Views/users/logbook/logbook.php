<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Log Book</title>
<?= $this->endSection() ?>
<?= $this->section('content') ?>


<!-- menampilkan isi content secara dinamis -->
<?php $validation =  \Config\Services::validation() ?>
    <div class="container-fluid">
        <!-- tab style -->
        <div class="row justify-content-center">
            
            <div class="col-md-12 col-lg-8 mt-3">
                <!-- Tab Content -->
                <div class="card shadow-inset bg-primary border-light p-3 rounded">
                    <div class="card-body p-0">
                        <div class="tab-content" id="tabcontent2">
                            <div class="tab-pane fade show active" id="tabs-icons-text-0" role="tabpanel" aria-labelledby="tabs-icons-text-0-tab">
                                <!-- menampilkan data izin -->
                                <!-- Form pencarian-->
                                <form method="get" action="">
                                <div class="input-daterange datepicker row align-items-center">
                                    <div class="col">
                                        <label class="h6" for="from">From</label>
                                        <div class="form-group">
                                            <div class="input-group input-group-border">
                                                <div class="input-group-prepend"><span class="input-group-text"><span class="far fa-calendar-alt"></span></span></div>
                                                <input class="form-control" id="from" name="from" value="<?= $from ?>" placeholder="Start date" type="datepicker" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label class="h6" for="to">To</label>
                                            <div class="input-group input-group-border">
                                                <div class="input-group-prepend"><span class="input-group-text"><span class="far fa-calendar-alt"></span></span></div>
                                                <input class="form-control" id="to" name="to" value="<?= $to ?>" placeholder="End date" type="datepicker" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- button tampilkan -->
                                <div class="row justify-content-center mb-3">
                                    <div class="col-4">
                                        <a href="<?=site_url('/tambah-logbook')?>" class="btn btn-facebook btn-block"><small><i class="fas fa-plus-circle"></i>Add</small></a>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-facebook btn-block" id="cari" type="submit"><small><i class="fas fa-search"></i>Search</small></button>
                                    </div>
                                </form>
                                    <div class="col-4">
                                        <button type="button" class="btn btn-facebook btn-block" id="cetak_pdf"><small><i class="fas fa-print"></i>Print</small></button>
                                    </div>
                                </div>
                                <!-- End of Form -->
                                <table class="table table-sm shadow-soft rounded">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="border-0" scope="col">#</th>
                                            <th class="border-0" scope="col">Date</th>
                                            <th class="border-0" scope="col">From - To</th>
                                            <th class="border-0" scope="col" colspan="4">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1 + ($jumlah_baris_data * ($currentPage - 1)); ?>
                                    <?php foreach ($data_pagination as $data) : ?>
                                        <form action="<?=site_url('/laporankerja/delete/'.$data['id'])?>" method="post">
                                        <?= csrf_field() ?>
                                            <tr class="text-center">
                                                <td><small><?= $i++; ?></small></td>
                                                <td><small><?= $data['date'] ?></small></td>
                                                <td><small><?= $data['dari'].' - '.$data['sampai'] ?></small></td>
                                                <td>
                                                    <small><button type="button" class="btn btn-icon-only btn-pill btn-facebook btn-sm" id="tombolDetails" data-toggle="modal" data-target="#modalDetails" 
                                                    data-id = "<?= $data['id']; ?>"
                                                    data-date = "<?= $data['date']; ?>"
                                                    data-dari = "<?= $data['dari']; ?>"
                                                    data-sampai = "<?= $data['sampai']; ?>"
                                                    data-aktivitas = "<?= $data['aktivitas']; ?>"
                                                    data-keluaran = "<?= $data['keluaran']; ?>"
                                                    ><i class="fas fa-info-circle"></i></button></small>
                                                </td>
                                                <td>
                                                    <small><a class="btn btn-icon-only btn-pill btn-info btn-sm" href="<?=base_url()?>/detail-logbook/<?=$data['uuid'] ?>"><i class="fas fa-image"></i></a></small>
                                                </td>
                                                <td>
                                                    <small><a class="btn btn-icon-only btn-pill btn-info btn-sm" href="<?=base_url()?>/edit-logbook/<?=$data['uuid'] ?>"><i class="fas fa-edit"></i></a></small>
                                                </td>
                                                <td>
                                                    <a href="<?=base_url()?>/delete-logbook/<?=$data['uuid'] ?>" class="btn btn-icon-only btn-pill btn-danger btn-sm" id="tombol_hapus"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        </form>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <?= $pager->links('default', 'custom_pagination') ?>
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

<!-- mengubah format tanggal pencarian -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#from').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
        $('#to').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>
<!-- END CUSTOM JS PARCIAL-->


<?= $this->endSection() ?>
<!-- END SECTION DINAMIC VIEW CONTENT -->

<!-- render JS GLOBAL IN DINAMIC VIEW-->
<?= $this->section('js_global') ?>
<!-- validasi cek nilai pencarian from dan to -->
<script>
    // ketika tombol search di klik cek from tidak boleh kosong
    $( "#cari" ).click(function() {
        var from = document.getElementById("from").value;
        if (from == "") {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Tanggal belum diisi...!',
                showConfirmButton: true
            })
            return false;
        }
    });
</script>
<!-- ketika tombol print di klik -->
<script>
// ketika tombol cetak_pdf di klik cek from tidak boleh kosong
$( "#cetak_pdf" ).click(function() {
    var from = document.getElementById("from").value;
    var to = document.getElementById("to").value;
    var route = "/laporan-logbook";
    var link = route+"?"+"from="+from+"&"+"to="+to;
    // alert(link);
    
    if(from == ""){
      Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Pilih tanggal dari dahulu...!',
            showConfirmButton: true
        })
        return false;
    }else if(to == ""){
      Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Pilih tanggal sampai dahulu...!',
            showConfirmButton: true
        })
        return false;
    }else{
    window.open(link, '_blank');
    }
    
});
</script>

<!-- Menampilkan modal detail data -->
<script>
$(document).ready(function() {
    $(document).on('click','#tombolDetails',function() {
        // mengambil nilai dari data
        var id = $(this).data('id');
        var date = $(this).data('date');
        var dari = $(this).data('dari');
        var sampai = $(this).data('sampai');
        var aktivitas = $(this).data('aktivitas');
        var keluaran = $(this).data('keluaran');
        // parse nilai kedalam tabel sesuai ID
		$('#detailId').text(id);
		$('#detailDate').text(date);
		$('#detailDari').text(dari);
		$('#detailSampai').text(sampai);
		$('#detailAktivitas').text(aktivitas);
		$('#detailKeluaran').text(keluaran);
	})
});
</script>
<!-- Akhir menampilkan modal detail data -->

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
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <div class="modal-body">
        <table class="table table-sm shadow-soft rounded table-hover table-borderless">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td class="font-weight-bold">Date</td>
                    <td>:</td>
                    <td><span id="detailDate"></span></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">From</td>
                    <td>:</td>
                    <td><i class="fas fa-clock">&nbsp;&nbsp;</i><span id="detailDari"></span></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">To</td>
                    <td>:</td>
                    <td><i class="fas fa-clock">&nbsp;&nbsp;</i><span id="detailSampai"></span></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Aktivity</td>
                    <td>:</td>
                    <td><span id="detailAktivitas"></span></td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Output</td>
                    <td>:</td>
                    <td><span id="detailKeluaran"></span></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-primary text-danger ml-auto" data-dismiss="modal">Close</button>
    </div>
    </div>
  </div>
</div>
<!-- akhir modal detail data -->

<?= $this->endSection() ?>