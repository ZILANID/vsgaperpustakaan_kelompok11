<?php
// GET dari form submit create,read,update,delete & cetak
	$nameaction = $_GET['action'];
	if(isset($_GET['action'])!=''){
		// Diarahkan ke fungsi masing-masing berdasarkan php?action=variable untuk menjalankan proses
		// Contoh name action: inputanggota, editanggota, hapusanggota, cetakdataanggota, cetakkartuanggota
		$nameaction();
	}else{
		echo "
		<script>
			alert('Kesalahan Sistem, coba lagi atau hubungi administrator...')
			window.location.href = '../index.php?p=anggota';
		</script>";
	}
// End GET dari form submit create,read,update,delete & cetak


/** Mulai Memproses Data dengan Function **/

// -- START FUNGCTION  -- //

// 1. Input Anggota
	function inputanggota(){
		
		include'../config_db.php';
		$id_anggota=$_POST['id_anggota'];
		$nama=$_POST['nama'];
		$jenis_kelamin=$_POST['jenis_kelamin'];
		$alamat=$_POST['alamat'];
		$status="Tidak Meminjam";
			
			if(isset($_POST['simpan'])){
					extract($_POST);
					$nama_file   = $_FILES['foto']['name'];
					if(!empty($nama_file)){
					// Baca lokasi file sementar dan nama file dari form (fupload)
					$lokasi_file = $_FILES['foto']['tmp_name'];
					$tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
					$file_foto = $id_anggota.".".$tipe_file;

					// Tentukan folder untuk menyimpan file
					$folder = "../asset/anggota/$file_foto";
					// Apabila file berhasil di upload
					move_uploaded_file($lokasi_file,"$folder");
					}
					else
						$file_foto="-";
				
				$sql = 
				"INSERT INTO tbanggota
					VALUES('$id_anggota','$nama','$file_foto','$jenis_kelamin','$alamat','$status')";
				$query = mysqli_query($koneksi, $sql);
				
				echo "
					<script>
						alert('Data Anggota Berhasil di Buat')
						window.location.href = '../index.php?p=anggota';
					</script>";
			}
	}

// 2. Edit Anggota
	function editanggota(){

		include'../config_db.php';

		$id_anggota=$_POST['id_anggota'];
		$nama=$_POST['nama'];
		$jenis_kelamin=$_POST['jenis_kelamin'];
		$alamat=$_POST['alamat'];
		$alamat=$_POST['alamat'];

		If(isset($_POST['simpan'])){
			
				extract($_POST);
				$nama_file   = $_FILES['foto']['name'];
				if(!empty($nama_file)){
				// Baca lokasi file sementar dan nama file dari form (fupload)
				$lokasi_file = $_FILES['foto']['tmp_name'];
				$tipe_file = pathinfo($nama_file, PATHINFO_EXTENSION);
				$file_foto = $id_anggota.".".$tipe_file;
				// Tentukan folder untuk menyimpan file
				$folder = "../asset/anggota/$file_foto";
				@unlink ("$folder");
				// Apabila file berhasil di upload
				move_uploaded_file($lokasi_file,"$folder");
				}
				else
					$file_foto=$foto_awal;
			
			mysqli_query($koneksi,
				"UPDATE tbanggota
				SET nama='$nama',jenis_kelamin='$jenis_kelamin',alamat='$alamat',foto='$file_foto'
				WHERE id_anggota='$id_anggota'"
			);
			echo "
					<script>
						alert('Data Anggota Berhasil di Edit')
						window.location.href = '../index.php?p=anggota';
					</script>";
		}

	}

// 3. Hapus Anggota
	function hapusanggota(){

	include'../config_db.php';
	$id_anggota=$_GET['id'];

	mysqli_query($koneksi,
		"DELETE FROM tbanggota
		WHERE id_anggota='$id_anggota'"
	);

	echo "
			<script>
				alert('Data Anggota Berhasil di Hapus')
				window.location.href = '../index.php?p=anggota';
			</script>";	

	}
// 4. Cetak Data Anggota
	function cetakdataanggota(){
		//Redirect ke Halaman Cetak Data Anggota
		header("location:../view/anggota-cetak-data.php");
	}
// 5. Cetak Kartu Anggota
	function cetakkartuanggota(){
		$id_anggota=$_GET['id'];
		//Redirect ke Halaman Cetak Kartu Anggota Berdasarkan ID Anggota
		header("location:../view/anggota-cetak-kartu.php?id=$id_anggota");
	}
	
// -- END FUNGCTION  -- //

?>