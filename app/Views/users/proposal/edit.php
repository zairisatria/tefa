<!-- menangkap layout template -->
<?= $this->extend('users/layout/default') ?>

<!-- menampilkan title secara dinamis -->
<?= $this->section('title') ?>
<title>Permit</title>
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
                                <form action="<?=site_url('/permit/update')?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <input type="hidden" name="id" value="<?= $data_absen['id'] ?>" >
                                    <!-- Form -->
                                    <div class="input-daterange datepicker row align-items-center">
                                        <div class="col">
                                            <label class="h6" for="from1">From</label>
                                            <div class="form-group">
                                                <div class="input-group input-group-border">
                                                    <div class="input-group-prepend"><span class="input-group-text"><span class="far fa-calendar-alt"></span></span></div>
                                                    <input class="form-control datepicker <?= $validation->hasError('from') ? 'is-invalid' : null ?>" id="from1" name="from" value="<?= old('from', $data_absen['dari']) ?>" placeholder="Start date" type="text" required="">
                                                    <div class="invalid-feedback">
                                                        <?= $error = $validation->getError('from'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="h6" for="to1">To</label>
                                                <div class="input-group input-group-border">
                                                    <div class="input-group-prepend"><span class="input-group-text"><span class="far fa-calendar-alt"></span></span></div>
                                                    <input class="form-control datepicker <?= $validation->hasError('to') ? 'is-invalid' : null ?>" id="to1" name="to" value="<?= old('to', $data_absen['dari']) ?>" placeholder="End date" type="text" required="">
                                                    <div class="invalid-feedback">
                                                        <?= $error = $validation->getError('to'); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Form -->
                                    <!-- Form -->
                                    <div class="form-group" id="holder_jenis_izin">
                                        <label class="my-1 mr-2" for="jenis_izin">Purpose</label>
                                        <select class="custom-select my-1 mr-sm-2" id="jenis_izin" name="jenis_izin" required="">
                                            <option value="">Choose...</option>
                                            <option value="sakit" <?php if ($data_absen['jenis_izin'] == "sakit") {echo "selected";} ?> >Sakit</option>
                                            <option value="dinas" <?php if ($data_absen['jenis_izin'] == "dinas") {echo "selected";} ?> >Dinas</option>
                                            <option value="cuti" <?php if ($data_absen['jenis_izin'] == "cuti") {echo "selected";} ?> >Cuti</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('jenis_izin'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form -->
                                    <div class="form-group" id="holder_jenis_cuti">
                                        <label class="my-1 mr-2" for="jenis_cuti">Destination</label>
                                        <select class="custom-select my-1 mr-sm-2" id="jenis_cuti" name="jenis_cuti">
                                            <option selected="">Choose...</option>
                                            <?php foreach ($cuti as $data) : ?>
                                                <option value="<?= $data['id_jenis_cuti'] ?>" <?php if ($data_absen['jenis_cuti'] == $data['id_jenis_cuti']) {echo "selected";} ?> ><?= $data['ket'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form-->
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control <?= $validation->hasError('ket') ? 'is-invalid' : null ?>" placeholder="Enter your message..." id="ket" name="ket" rows="4" required=""><?= old('ket', $data_absen['ket']) ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('ket'); ?>
                                        </div>
                                    </div>
                                    <!-- End of Form -->
                                    <!-- Form -->
                                    <div class="custom-file">
                                        <input type="text" name="file_lama" value="<?= $data_absen['files'] ?>" hidden>
                                        <input type="file" class="custom-file-input <?= $validation->hasError('files') ? 'is-invalid' : null ?>" id="files" name="files" value="<?= old('files', $data_absen['files']) ?>" aria-label="File upload" <?= $data_absen['files'] ? null : 'required' ?>>
                                        <label class="custom-file-label" for="files">Choose file</label>
                                        <div class="invalid-feedback">
                                            <?= $error = $validation->getError('files'); ?>
                                        </div>
                                    </div>
                                    <!-- End Form -->
                                    <button type="submit" value="submit" id="simpan" class="btn btn-facebook btn-block mt-4"><i class="fas fa-save"> Save</i></button>
                                </form>
                                <!-- End Form Sakit -->
                    </div>
                </div>
                <!-- End of Tab Content -->
            </div>
        </div>
        <!-- end tab style -->
    </div>

<!-- CUSTOM JS -->

<!-- mengubah format tanggal pencarian -->
<script type="text/javascript">
            $(document).ready(function () {
                $('#from1').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true
                });
                $('#from2').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true
                });
                $('#from3').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true
                });

                $('#to1').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true
                });
                $('#to2').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true
                });
                $('#to3').datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true
                });
            });
</script>

<!-- set minimal value hari ini -->
<script>

</script>
<?= $this->endSection() ?>
<!-- END SECTION DINAMIC VIEW CONTENT -->

<!-- render JS GLOBAL IN DINAMIC VIEW-->
<?= $this->section('js_global') ?>
<!-- validasi cek nilai pencarian from dan to -->
<script>
    // get current date now
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();
    var today = yyyy + '-' + mm + '-' + dd;

    // ketika tombol simpan di klik cek apakah input date from lebih kecil dari hari ini
    $( "#simpan" ).click(function() {
        var from = document.getElementById("from1").value;
        if (from =="") {
            Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'Tanggal tidak boleh kosong...!',
                showConfirmButton: true
            })
            return false;
        }else{
            if (from < today) {
                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Tidak boleh mengajukan izin untuk hari kemaren...!',
                    showConfirmButton: true
                })
                return false;
            }
        }
    });
    // end ketika tombol simpan di klik cek apakah input date from lebih kecil dari hari ini

    // default ketika buka form edit
    jenis_izin = document.getElementById("jenis_izin").value;
    if(jenis_izin=="cuti"){
            document.getElementById("holder_jenis_cuti").hidden = false;
        }else{
            document.getElementById("holder_jenis_cuti").hidden = true;
            document.getElementById("jenis_cuti").value = "";
        }
    // show hide element ketika jenis cuti diganti/dipilih
    $( "#jenis_izin" ).change(function() {
        jenis_izin = document.getElementById("jenis_izin").value;
        if(jenis_izin=="cuti"){
            document.getElementById("holder_jenis_cuti").hidden = false;
        }else{
            document.getElementById("holder_jenis_cuti").hidden = true;
            document.getElementById("jenis_cuti").value = "";
        }
    });
    // end show hide element

</script>
<?= $this->endSection() ?>