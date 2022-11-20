// membuat variabel dari flash data yang diambil dari div view
const flashdata = $('.flash-data').data('flashdata');
const message = $('.message-data').data('message');

//flasdata baru
if(flashdata == 'success') {
	Swal.fire({
	position: 'center',
	icon: 'success',
	title: 'Berhasil...',
	text: message,
	showConfirmButton: true
	});
}

if(flashdata == 'error') {
	Swal.fire({
	position: 'center',
	icon: 'error',
	title: 'Oops...',
	text: message,
	showConfirmButton: true
	});
}

// menampilkan sweetalert konfirmasi hapus data
$(document).on('click','#tombol_hapus', function(e){
	e.preventDefault();
	var href = $(this).attr('href');
	  
	Swal.fire({
			  title: 'Apakah Anda Yakin?',
			  text: "Data akan dihapus!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3ABAF4',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Ya, Hapus!'
			}).then((result) => {
		  if (result.isConfirmed) {
			window.location = href;
		  }
		})
	})

// menampilkan preview upload gambar
function previewImg() {
	const gambar = document.querySelector('#gambar');
	const gambarLabel = document.querySelector('.custom-file-label');
	const imgPreview =  document.querySelector('.img-preview');

	// untuk mengubah source url
	gambarLabel.textContent = gambar.files[0].name;

	// untuk mengubah preview gambar
	const fileGambar = new FileReader();
	fileGambar.readAsDataURL(gambar.files[0]);

	fileGambar.onload = function(e) {
		imgPreview.src = e.target.result;
	}
}

