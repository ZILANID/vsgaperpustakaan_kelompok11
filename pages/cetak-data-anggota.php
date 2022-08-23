<?php
include "../config_db.php";
?>
<style>
.center {
  margin-left: auto;
  margin-right: auto;
}
</style>
<title>Sistem Perpustakaan Online | Cetak Data Anggota</title>
<link rel="stylesheet" type="text/css" href="../style.css">
<div><center><h3>DATA ANGGOTA PERPUSTAKAAN</h3></center></div>
<div id="content">
<table class="center" border="1" id="tabel-tampil">
		<tr>
			<th id="label-tampil-no">No</th>
			<th>ID Anggota</th>
			<th>Nama</th>
			<th>Foto</th>
			<th>Jenis Kelamin</th>
			<th>Alamat</th>
		</tr>
		
		<?php		
		$nomor=1;
		$query="SELECT * FROM tbanggota ORDER BY id_anggota DESC";
		$q_tampil_anggota = mysqli_query($koneksi, $query);
		if(mysqli_num_rows($q_tampil_anggota)>0)
		{
		while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)){
			if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
				$foto = "default.jpg";
			else
				$foto = $r_tampil_anggota['foto'];
		?>
		<tr>
			<td><?php echo $nomor; ?></td>
			<td><?php echo $r_tampil_anggota['id_anggota']; ?></td>
			<td><?php echo $r_tampil_anggota['nama']; ?></td>
			<td><img src="../asset/anggota/<?php echo $foto; ?>" width=70px height=70px></td>
			<td><?php echo $r_tampil_anggota['jenis_kelamin']; ?></td>
			<td><?php echo $r_tampil_anggota['alamat']; ?></td>		
		</tr>		
		<?php $nomor++; } 
		}?>		
	</table>
	<script>
		window.print();
	</script>
</div>
