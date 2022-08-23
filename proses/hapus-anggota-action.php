<?php
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
?>