<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Tambah Log Book</title>
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
                                <!-- Form Sakit -->
                                <form action="<?=site_url('/simpan-logbook')?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="text" name="uuid" value="<?= $uuid['uuid']; ?>" hidden>
                                <!-- Form-->
                                <div class="form-group">
                                    <label class="h6" for="date">Tanggal<span class="text-danger"> *</span></label>
                                    <div class="input-group input-group-border">
                                        <div class="input-group-prepend"><span class="input-group-text"><span class="far fa-calendar-alt"></span></span></div>
                                        <input class="form-control datepicker <?= $validation->hasError('date') ? 'is-invalid' : null ?>" id="date" type="datepicker" name="date" value="<?= old('date') ?>" placeholder="Tanggal" required="">
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('date'); ?>
                                        </div>
                                    </div>
                                </div>
                                    <!-- End of Form -->
                                <!-- Form -->
                                <div class="input-daterange timepicker row align-items-center">
                                        <div class="col">
                                            <label class="h6" for="dari">Dari<span class="text-danger"> *</span></label>
                                            <div class="form-group">
                                                <div class="input-group input-group-border">
                                                    <div class="input-group-prepend"><span class="input-group-text"><span class="far fa-clock"></span></span></div>
                                                    <input class="form-control timepicker <?= $validation->hasError('dari') ? 'is-invalid' : null ?>" id="dari" type="time" name="dari" value="<?= old('dari') ?>" placeholder="Start time" required="">
                                                    <div class="invalid-feedback">
                                                        <?= $error = $validation->getError('dari'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="h6" for="sampai">Sampai<span class="text-danger"> *</span></label>
                                                <div class="input-group input-group-border">
                                                    <div class="input-group-prepend"><span class="input-group-text"><span class="far fa-clock"></span></span></div>
                                                    <input class="form-control  timepicker <?= $validation->hasError('sampai') ? 'is-invalid' : null ?>" id="sampai" type="time" name="sampai" value="<?= old('sampai') ?>" placeholder="End time" required="">
                                                    <div class="invalid-feedback">
                                                        <?= $error = $validation->getError('sampai'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form -->
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="aktivitas">Aktifitas<span class="text-danger"> *</span></label>
                                        <textarea class="form-control <?= $validation->hasError('aktivitas') ? 'is-invalid' : null ?>" placeholder="Apa yang anda lakukan..?" id="aktivitas" name="aktivitas" rows="3" required=""><?= old('aktivitas') ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('aktivitas'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="keluaran">Keluaran<span class="text-danger"> *</span></label>
                                        <textarea class="form-control <?= $validation->hasError('keluaran') ? 'is-invalid' : null ?>" placeholder="Apa yang dihasilkan..?" id="keluaran" name="keluaran" rows="3" required=""><?= old('keluaran') ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('keluaran'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label class="my-1 mr-2" for="jenis_aktifitas">Jenis Aktifitas<span class="text-danger"> *</span></label>
                                        <select class="custom-select my-1 mr-sm-2" name="jenis_aktifitas" id="jenis_aktifitas" required>
                                            <option value="" selected disabled>Pilih...</option>
                                            <option value="persiapan" <?php if (old('jenis_aktifitas') == "persiapan") {echo "selected";} ?> >Proses Persiapan</option>
                                            <option value="pengolahan" <?php if (old('jenis_aktifitas') == "pengolahan") {echo "selected";} ?> >Proses Pengolahan</option>
                                            <option value="produksi" <?php if (old('jenis_aktifitas') == "produksi") {echo "selected";} ?> >Proses Produksi</option>
                                            <option value="pengemasan" <?php if (old('jenis_aktifitas') == "pengemasan") {echo "selected";} ?> >Proses Pengemasan</option>
                                            <option value="penjualan" <?php if (old('jenis_aktifitas') == "penjualan") {echo "selected";} ?> >Proses Penjualan</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('jenis_aktifitas'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form -->
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th width="35%" scope="col">Dokumentasi</th>
                                                <th width="5%" scope="col"></th>
                                            </tr>
                                            <tr id="tr_contoh_id">
                                                <td>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="files" name="files[]" onchange="previewFiles()">
                                                        <div>
                                                            <label id="filesLabel" class="custom-file-label" for="files">Choose file</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" onclick="tambah_baris()" class="btn btn-info"><i class="fas fa-plus-circle"></i></button>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody id="body_id">
                                            
                                        </tbody>
                                    </table>
                                    <!-- End Form -->
                                    <!-- End of Form -->
                                    <button type="submit" value="submit" id="simpan" onclick="return periksa_isi_halaman()" class="btn btn-facebook btn-block mt-4" ><i class="fas fa-save"> Simpan</i></button>
                                </form>
                                <!-- End Form Sakit -->
                    </div>
                </div>
                <!-- End of Tab Content -->
            </div>
        </div>
        <!-- end tab style -->
    </div>
    <br><br><br>

<!-- CUSTOM JS -->
<script>
    // mengubah tanggal menjadi format local
    console.log(new Date().toLocaleString())
</script>
<!-- validasi time tidak boleh lebih kecil dari time sekarang -->
<script>
    // ketika tombol simpan di klik cek apakah input date from lebih kecil dari hari ini
    $( "#simpan" ).click(function() {
        var today = new Date().toLocaleString(); 
        var timeNow = today.getHours() + "." + today.getMinutes();
        var time = timeNow.toString();
        var dariNow = document.getElementById("dari").value;
        var sampaiNow = document.getElementById("sampai").value;
        var dari = dariNow.toString();
        var sampai = sampaiNow.toString();
        if (dari < time) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Waktu dari tidak boleh waktu sebelumnya...!'+dari,
                showConfirmButton: true
            })
            return false;
        }
        if(sampai < time){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Waktu sampai tidak boleh waktu sebelumnya...!',
                showConfirmButton: true
            })
            return false;
        }
        if(sampai <= dari){
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Waktu sampai tidak boleh sebelum atau sama waktu dari...!',
                showConfirmButton: true
            })
            return false;
        }
    });
    // end ketika tombol simpan di klik cek apakah input date from lebih kecil dari hari ini
</script>

<!-- mengubah format tanggal pencarian dan auto close setelah di clik -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#date').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>

<script>
    // proses menambah dokumentasi
    function tambah_baris() {
	
	//membuat variabel inputan dari form
	files = document.getElementById("files").value;
	
	if (files == "") {
		Swal.fire({
            position: 'center',
            icon: 'warning',
            title: 'Anda belum memilih dokumen, Pilih dulu...!',
            showConfirmButton: false,
            timer: 3000
			}).then((result) => {
			});
		return false;
	}
			
	//proses mengcopy element inputan tr ke tbody
	trCopyan = document.getElementById("tr_contoh_id").cloneNode(true);
	document.getElementById("body_id").appendChild(trCopyan);
	
	//proses mengganti tulisan tambah menjadi hapus
	trCopyan.children[1].children[0].innerHTML = '<i class="fas fa-minus-circle"></i>';
	//proses mengganti warna tombol kuning menjadi merah
	trCopyan.children[1].children[0].setAttribute("class", "btn btn-danger");
	//proses mengganti event tambah/hapus dari tambah_baris menjadi hapus_baris
	trCopyan.children[1].children[0].setAttribute("onclick", "hapus_baris(this)");
	//proses copy data nama barang yang terselect turunkan kebawah
	trCopyan.children[0].children[0].value = files;
	
	//menambahkan name untuk atribut detail pembelian
	// trCopyan.children[0].children[0].setAttribute("name", "files[]");
	
	//proses mereset nilai ketika ditambah
	document.getElementById("files").value = "";
	document.getElementById("filesLabel").textContent = "Choose file";
    
    }

    //fungsi menghapus baris
    function hapus_baris(tombolnya) {
        baris = tombolnya.parentElement.parentElement
        baris.remove();
    }

    //fungsi mengecek baris inputan detail sudah ada atau belum ketika tombol simpan di klik
    function periksa_isi_halaman() {
        jumlah_baris = document.getElementById("body_id").childElementCount;
        if (jumlah_baris == 0) {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'File belum dipilih, pilih dulu...!',
                showConfirmButton: false,
                timer: 3000
                }).then((result) => {
                });
            return false;
        }
        
        for(indexke=0; indexke < jumlah_baris; indexke++) {
            baris = document.getElementById("body_id").children[indexke]
            files = baris.children[0].children[0].value;
            if(files == "") {
                alert("Silahkan isi file pada baris ke:" + (indexke+1))
                return false;
            }
        }
    }

    // menampilkan preview upload files
    function previewFiles() {
    const files = document.querySelector('#files');
    const filesLabel = document.querySelector('.custom-file-label');
    const filesPreview =  document.querySelector('.files-preview');

    // untuk mengubah source url
    filesLabel.textContent = files.files[0].name;
    }
</script>

<?= $this->endSection() ?>