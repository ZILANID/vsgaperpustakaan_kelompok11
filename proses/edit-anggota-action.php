<?php
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
?>
