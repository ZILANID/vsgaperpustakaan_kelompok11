<?php
	$id_anggota=$_GET['id'];
	$q_tampil_anggota=mysqli_query($koneksi,"SELECT * FROM tbanggota WHERE id_anggota='$id_anggota'");
	$r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota);
	if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
				$foto = "default.jpg";
			else
				$foto = $r_tampil_anggota['foto'];
?>
<title>Edit Data Anggota | Sistem Perpustakaan Online</title>
<div id="content">
</br>
	<div align="left" class="col-lg-12">
		<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
<!--<div id="label-page"><h3>Edit Data Transaksi</h3></div>-->
<div class="card-body">
	<form action="controller/PengembalianController.php?action=editdatapengembalian" method="post" enctype="multipart/form-data">
	
	                <div class="table-responsive">
                   
	
						<?php
						$batas = 5;
						extract($_GET);
						if(empty($hal)){
							$posisi = 0;
							$hal = 1;
							$nomor = 1;
						}
						else {
							$posisi = ($hal - 1) * $batas;
							$nomor = $posisi+1;
						}	
							$id_transaksi = $_GET['id'];
							$query = "SELECT * FROM tbtransaksi  a, tbanggota b, tbbuku c where a.id_anggota=b.id_anggota and a.id_buku=c.id_buku and a.id_transaksi='".$id_transaksi."' LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM tbtransaksi a, tbanggota b, tbbuku c where a.id_anggota=b.id_anggota and a.id_buku=c.id_buku";
							$no = $posisi * 1;
	
						
						//$sql="SELECT * FROM tbanggota ORDER BY idanggota DESC";
						$q_tampil_anggota = mysqli_query($koneksi, $query);
						if(mysqli_num_rows($q_tampil_anggota)>0)
						{
						while($r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota)){
							if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
								$foto = "default.jpg";
							else
								$foto = $r_tampil_anggota['foto'];
						?>

                  
				<div class="col-md-12">
					<p><a href="index.php?p=beranda"><i class="ti-home"></i></a> / <a href="index.php?p=pengembalian">Pengembalian</a> / Edit Transaksi Pengembalian</p>
					<br>
				</div>
				<div class="col-12 row">
				<div class="col-6">
						<h3>Detail Transaksi Pengembalian</h3>
						<hr>
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark">No. Peminjaman</div>
							<div class="col-md-8 p-2 bg-light text-dark">: 
								<?php echo $r_tampil_anggota['id_transaksi']; ?>
								<input type="hidden" name="id_transaksi" value="<?php echo $r_tampil_anggota['id_transaksi']; ?>">
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark">Tgl. Peminjaman</div>
							<div class="col-md-8 p-2 bg-light text-dark">: <?php echo $r_tampil_anggota['tanggal_pinjam']; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark">Tgl. Pengembalian</div>
							<div class="col-md-8 p-2 bg-light text-dark">: <?php echo $r_tampil_anggota['tanggal_kembali']; ?></div>
						</div>
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark">ID Anggota</div>
							<div class="col-md-8 p-2 bg-light text-dark">: 
								<?php echo $r_tampil_anggota['id_anggota']; ?>
								<input type="hidden" name="id_anggota" class="col-md-8 p-2 bg-light text-dark" value="<?php echo $r_tampil_anggota['id_anggota']; ?>">
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark"><b>Data Anggota</b></div>
							<div class="col-md-8 p-2 bg-light text-dark"></div>
							<div class="col-md-4 p-2 bg-light text-dark">
								<br>
								<img src="asset/anggota/<?php echo $r_tampil_anggota['foto']; ?>">
							</div>
							<div class="col-md-8 p-2 bg-light text-dark row">
								<div class="col-md-4 p-2 bg-light text-dark">Nama</div>
								<div class="col-md-8 p-2 bg-light text-dark">: <?php echo $r_tampil_anggota['nama']; ?></div>
								<div class="col-md-4 p-2 bg-light text-dark">Jenis Kelamin</div>
								<div class="col-md-8 p-2 bg-light text-dark">: <?php echo $r_tampil_anggota['jenis_kelamin']; ?></div>
								<div class="col-md-4 p-2 bg-light text-dark">Alamat</div>
								<div class="col-md-8 p-2 bg-light text-dark">: <?php echo $r_tampil_anggota['alamat']; ?></div>
								<div class="col-md-4 p-2 bg-light text-dark">Status</div>
								<div class="col-md-8 p-2 bg-light text-dark">: <?php echo $r_tampil_anggota['status']; ?></div>
							</div>
						</div>
								
		
					
				</div>
					  
				<div class="col-6">
						<h3>Detail Buku</h3>
						<hr>
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark">Status</div>
							<div class="col-md-8 p-2 bg-light text-dark">: 
								<select name="status" class="col-md-8 p-2 bg-light text-dark custom-select">
									<?php if($r_tampil_anggota['status']=='Selesai'){ ?>
										<option value="Selesai">Dikembalikan</option>	
										<option value="Aktif">Sedang Dipinjam</option>
									<?php }else{ ?>
										<option value="Aktif">Sedang Dipinjam</option>
										<option value="Selesai">Dikembalikan</option>									
									<?php } ?>
								 </select> 
								<!--<div class="progress">
									<?php if($r_tampil_anggota['status']=='Selesai'){ ?>
										<div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									<?php }else{ ?>
										<div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									<?php } ?>
								</div>-->
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark">Tgl. Dikembalikan</div>
								<?php if($r_tampil_anggota['tanggal_dikembalikan']==''){ ?>
									<div class="col-md-8 p-2 bg-light text-dark">: 
										<input name="tanggal_dikembalikan" type="datetime-local" class="col-md-8 p-2 bg-light text-dark">
										<label class="col-md-8 p-2 text-success"><i class="ti-alert text-warning"></i> Belum Dikembalikan</label>
									</div>
								<?php }else{ ?>
									<div class="col-md-8 p-2 bg-light text-dark">: 
										<input name="tanggal_dikembalikan" class="col-md-8 p-2 bg-light text-dark" type="datetime-local" value="<?php echo $r_tampil_anggota['tanggal_dikembalikan']; ?>">
										<label class="col-md-8 p-2 text-success"><i class="ti-info-alt"></i> <?php echo $r_tampil_anggota['tanggal_dikembalikan']; ?></label>
									</div>	
								<?php } ?>
						</div>
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark">ID Buku</div>
							<div class="col-md-8 p-2 bg-light text-dark">: 
								<?php echo $r_tampil_anggota['id_buku']; ?>
								<input type="hidden" name="id_buku" value="<?php echo $r_tampil_anggota['id_buku']; ?>">
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4 p-2 bg-light text-dark"><b>Data Buku</b></div>
							<div class="col-md-8 p-2 bg-light text-dark"> </div>
							<table class="table table-striped">
								  <thead>
									<tr>
									  <th> No </th>
									  <th> Title </th>
									  <th> Penulis </th>
									  <th> Penerbit </th>
									</tr>
								  </thead>
								  <tbody>
								    <tr>
									  <td>
									   <?php echo $nomor; ?>
									  </td>
									  <td>
									   <?php echo $r_tampil_anggota['judul_buku']; ?>
									  </td>
									  <td>
										<?php echo $r_tampil_anggota['penulis']; ?>
									  </td>
									   <td>
										<?php echo $r_tampil_anggota['penerbit']; ?>
									  </td>
									</tr>
									<?php 
									$nomor++; } 
									}else {
										echo "<tr><td colspan='8'>Maaf Data Yang Dicari Tidak Ditemukan...</td>";
										echo"<td><label class='badge badge-success'>Pengambilan Data Selesai</label></td></tr>";
									}
									?>	
									</tbody>
									</table>
									
						</div>

				</div>
					 <div class="col-md-12 row">	
						<div class="col-md-12 p-2 bg-light text-dark" align="left">
						<input type="submit" name="simpan" value="Simpan" class="btn btn-sm btn-outline-primary btn-icon-text">

						<a href="index.php?p=peminjaman"class="btn btn-sm btn-warning btn-icon-text">Kembali</a>
						</div>
					</div>
				</div>
					  
                  
                </div>
		


	</table>
	
	
	</form>
</div>

</div>
		</div>
		</div>

				</div>
			</div>
		</div>
	</div>
</div>