<?php
	$id_anggota=$_GET['id'];
	$q_tampil_anggota=mysqli_query($koneksi,"SELECT * FROM tbanggota WHERE id_anggota='$id_anggota'");
	$r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota);
	if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
				$foto = "default.jpg";
			else
				$foto = $r_tampil_anggota['foto'];
?>
<title>Edit Data Peminjaman | Sistem Perpustakaan Online</title>
<div id="content">
</br>
<div align="left" class="col-lg-12">
<div class="col-lg-12 grid-margin stretch-card">
<div class="card">
<!--<div id="label-page"><h3>Edit Data Transaksi</h3></div>-->
<div class="card-body">
	<form action="controller/PeminjamanController.php?action=editdatapeminjaman" method="post" enctype="multipart/form-data">
	
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

                  
					  
				<div class="col-12 row">
				
				<div class="col-6">
						<h3>Edit Transaksi Peminjaman</h3>
						<hr>
						<div class="form-group row">
							<label for="inputidtransaksi" class="col-sm-3 p-1 col-form-label">No. Peminjaman</label>
							<div class="col-sm-9 p-1">
								<label id="inputidtransaksi" class="col-sm-9 p-1 col-form-label"><b><?php echo $r_tampil_anggota['id_transaksi']; ?></b></label>
								<input type="hidden" name="id_transaksi" value="<?php echo $r_tampil_anggota['id_transaksi']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputtanggalpeminjaman" class="col-sm-3 p-1 col-form-label">Tgl. Peminjaman</label>
							<div class="col-sm-9 p-1">
								<input name="tanggal_peminjaman" id="inputtanggalpeminjaman" class="form-control col-sm-7 p-1" type="datetime-local" value="<?php echo $r_tampil_anggota['tanggal_pinjam']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="inputtanggalpengembalian" class="col-sm-3 p-1 col-form-label">Tgl. Pengembalian</label>
							<div class="col-sm-9 p-1">
								<input name="tanggal_pengembalian" class="form-control col-sm-7 p-1 bg-light text-dark" type="datetime-local" value="<?php echo $r_tampil_anggota['tanggal_kembali']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<label for="id_anggota" class="col-sm-3 p-1 col-form-label">ID Anggota</label>
								<div class="col-sm-5 p-1">
									<?php  
										include'config_db.php';
										function idanggota($koneksi)
										{
											$output = '';
											$sql = "SELECT * FROM tbanggota";
											$result = mysqli_query($koneksi, $sql);
											while($row = mysqli_fetch_array($result)){
												$output .= "<option value=".$row["id_anggota"].">".$row["id_anggota"].' - '.$row["nama"]."</option>";
											}
											return $output;
										}
									?>
										<select name="id_anggota" id="idanggota" class="custom-select" required>
											<option value="">Pilih Anggota</option>
											<!--<option value="<?php echo $r_tampil_anggota['id_anggota'] ?>"><?php echo $r_tampil_anggota['id_anggota'] .' - '. $r_tampil_anggota['nama'] ?></option>-->
												<?php echo idanggota($koneksi); ?>
										</select>
										<input type="hidden" name="id_anggotasebelumnya" value="<?php echo $r_tampil_anggota['id_anggota'] ?>">
										<label>* Ubah data peminjam jika salah input data anggota sebelumnya</label>				
								</div>
						</div>
						<div class="form-group row">
							<label for="data_anggota" class="col-sm-12 p-1 col-form-label"><b>Data Anggota Peminjam</b></label>
							<div class="col-sm-12" id="tampildataanggota">
								<!--<label for="id_anggota" class="col-sm-12 col-form-label"><i class="ti-info-alt"></i> Data anggota belum dicari</label>-->
								<div class="col-md-12 row">
									<div class="col-md-3">
										<div class="col-md-12"><br></div>
										<div class="col-md-12 p-1 col-form-label"> <img width="75px" src="asset/anggota/<?php echo $r_tampil_anggota['foto']; ?>"></img></div>
									</div>
									<div class="col-sm-9 form-group row">
										<label class="col-sm-12 p-0 col-form-label">ID Anggota: <?php echo $r_tampil_anggota['id_anggota']; ?></label>
										<label class="col-sm-12 p-0 col-form-label">Nama: <?php echo $r_tampil_anggota['nama']; ?></label>
										<label class="col-sm-12 p-0 col-form-label">Jenis Kelamin: <?php echo $r_tampil_anggota['jenis_kelamin']; ?></label>
										<label class="col-sm-12 p-0 col-form-label">Alamat: <?php echo $r_tampil_anggota['alamat']; ?></label>
										<label class="col-sm-12 p-0 col-form-label">Status: <a href="#" class="btn btn-success btn-sm"><i class="ti-alert"></i> Meminjam pada transaksi ini</a></label>
									</div>		
								</div>		
		
							</div>
						</div>
						<!--<div class="form-group row">
							<label for="inputidanggota" class="col-sm-3 p-1 col-form-label">ID Anggota</label>
							<div class="col-sm-9 p-1">
								<label id="inputidanggota" class="col-sm-8 p-1 col-form-label"><?php echo $r_tampil_anggota['id_anggota']; ?></label>
								<input type="hidden" name="id_anggota" class="col-md-8 p-1 bg-light text-dark" value="<?php echo $r_tampil_anggota['id_anggota']; ?>">
							</div>
						</div>-->
						<div class="form-group row">
							<div class="col-sm-12 p-1" align="left">
								<input type="submit" name="simpan" value="Simpan" onclick = "return confirm ('Yakin mau mengedit data ini?')" class="btn btn-sm btn-outline-primary btn-icon-text">
								<a href="index.php?p=peminjaman"class="btn btn-sm btn-warning btn-icon-text">Kembali</a>
							</div>
						</div>
				</div>
					  
				<div class="col-6">
						<h3>Detail Buku</h3>
						<hr>
						<div class="form-group row">
							<label for="inputidanggota" class="col-sm-3 p-1 col-form-label">Status</label>
							<div class="col-sm-9 p-1">
									<?php if($r_tampil_anggota['status']=='Selesai'){ ?>
										<label class="col-sm-12 p-1 col-form-label">Dikembalikan</label>	
									<?php }else{ ?>
										<label class="col-sm-12 p-1 col-form-label">Sedang Dipinjam</label>								
									<?php } ?>
								<!--<div class="progress">
									<?php if($r_tampil_anggota['status']=='Selesai'){ ?>
										<div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									<?php }else{ ?>
										<div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
									<?php } ?>
								</div>-->
							</div>
						</div>
						<div class="form-group row">
							<label for="inputidanggota" class="col-sm-3 p-1 col-form-label bg-light text-dark">Tgl. Dikembalikan</label>
								<?php if($r_tampil_anggota['tanggal_dikembalikan']==''){ ?>
									<div class="col-sm-9 p-1 bg-light text-dark">
										<label class="col-md-8 p-1 text-success"><i class="ti-alert text-warning"></i> Belum Dikembalikan</label>
									</div>
								<?php }else{ ?>
									<div class="col-sm-9 p-1 bg-light text-dark">
										<label class="col-md-8 p-1 text-success"><i class="ti-info-alt"></i> <?php echo $r_tampil_anggota['tanggal_dikembalikan']; ?></label>
									</div>	
								<?php } ?>
						</div>
						<div class="form-group row">
							<label for="inputidbuku" class="col-sm-3 p-1 col-form-label">ID Buku</label>
							<div class="col-sm-9 p-1">
								<?php echo $r_tampil_anggota['id_buku']; ?>
								<input type="hidden" class="form-control" name="id_buku" value="<?php echo $r_tampil_anggota['id_buku']; ?>">
							</div>
						</div>
						<div class="form-group row">
									<label for="id_buku" class="col-sm-3 p-1 col-form-label">Kode Buku</label>
									<div class="col-sm-9 p-1">
									<?php  
										include'config_db.php';
										function idbuku($koneksi)
										{
											$output = '';
											$sql = "SELECT * FROM tbbuku";
											$result = mysqli_query($koneksi, $sql);
											while($row = mysqli_fetch_array($result)){
												$output .= "<option value=".$row["id_buku"].">".$row["id_buku"].' - '.$row["judul_buku"]."</option>";
											}
											return $output;
										}
										?>
										<select name="id_buku" id="idbuku" class="custom-select" required>
											<option value="">Pilih Buku</option>
												<?php echo idbuku($koneksi); ?>
										</select>
										<input type="hidden" name="id_bukusebelumnya" value="<?php echo $r_tampil_anggota['id_buku'] ?>">
										<label>* Ubah data buku jika salah input data buku sebelumnya</label>	
									</div>
						</div>
						<div class="form-group row">
							<label for="data_buku" class="col-sm-12 p-1 col-form-label"><b>Data Buku yang Dipinjam</b></label>
							<div class="col-sm-12" id="tampildatabuku">
							<!--<label for="id_buku" class="col-sm-12 col-form-label">* Data buku belum dicari</label>-->
							<div class="col-sm-12 p-1">
								<table class="table table-striped">
								  <thead>
									<tr>
									  <th> ID Buku </th>
									  <th> Title </th>
									  <th> Penulis </th>
									  <th> Penerbit </th>
									  <th> Peminjam </th>
									</tr>
								  </thead>
								  <tbody>
								    <tr>
									  <td><?php echo $r_tampil_anggota['id_buku']; ?></td>
									  <td><?php echo $r_tampil_anggota['judul_buku']; ?></td>
									  <td><?php echo $r_tampil_anggota['penulis']; ?></td>
									  <td><?php echo $r_tampil_anggota['penerbit']; ?> </td>
									  <td><?php echo  $r_tampil_anggota['id_anggota'] ." - ". $r_tampil_anggota['nama']; ?> </td>
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
						</div>
				</div>
						

		
				</div>

			</div>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
	$(document).ready(function(){
		$("#idanggota").change(function(){
			var id_anggota = $(this).val()
			$.ajax({
				url: "controller/PeminjamanController.php?action=pilihanggota",
				method: "POST",
				data: {id_anggota: id_anggota},
				success: function(data){
					$("#tampildataanggota").html(data);
				}
			})
		})
	})
	$(document).ready(function(){
		$("#idbuku").change(function(){
			var id_buku = $(this).val()
			$.ajax({
				url: "controller/PeminjamanController.php?action=pilihbuku",
				method: "POST",
				data: {id_buku: id_buku},
				success: function(data){
					$("#tampildatabuku").html(data);
				}
			})
		})
	})
</script>
		</div>     


	</form>
</div>
</div>

</div>
</div>
</div>
