<?php
	include "../config_db.php";
	$id_anggota=$_GET['id'];
	$q_tampil_anggota=mysqli_query($koneksi,"SELECT * FROM tbanggota WHERE id_anggota='$id_anggota'");
	$r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota);
	if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
		$foto = "default.jpg";
	else
		$foto = $r_tampil_anggota['foto'];
?>
<div id="label-page"><h3>Kartu Anggota</h3></div>
<div id="content">
	<table style="border:1px solid black;" id="tabel-input">
		<tr>
			<td class="isian-formulir">
			<img src="../asset/anggota/<?php echo $foto; ?>" width=70px height=75px>
			</td>
		</tr>
		<tr>
			<td class="label-formulir">ID Anggota</td>
			<td class="isian-formulir"><?php echo $r_tampil_anggota['id_anggota']; ?></td>
		</tr>
		<tr>
			<td class="label-formulir">Nama</td>
			<td class="isian-formulir"><?php echo $r_tampil_anggota['nama']; ?></td>
		</tr>
		<tr>
			<td class="label-formulir">Jenis Kelamin</td>
			<td class="isian-formulir"><?php echo $r_tampil_anggota['jenis_kelamin']; ?></td>
		</tr>
		<tr>
			<td class="label-formulir">Alamat</td>
			<td class="isian-formulir"><?php echo $r_tampil_anggota['alamat']; ?></td>
		</tr>
	</table>
</div>
<script>
		window.print();
	</script>