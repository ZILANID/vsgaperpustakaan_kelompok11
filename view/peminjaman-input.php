<?phpini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>
<title>Peminjaman Buku | Sistem Perpustakaan Online</title>
<div class="content-wrapper">
	<div class="row">
		
		<div class="col-md-12 grid-margin">
				
				<div class="col-md-12 grid-margin stretch-card">
					<div class="card">
						<div class="card-body">
						<!-- BUAT ID BARU -->
							<?php
								$query = "SELECT max(id_transaksi) as maks_idtransaksi from tbtransaksi";
								$qtransaksi = mysqli_query($koneksi, $query);
								
								foreach($qtransaksi as $qtransaksi){
									//Hilangkan kode TR dari TR001 / Ambil angka saja
									$id=$qtransaksi['maks_idtransaksi']; 
									$replaceid=str_replace("TR","",$id);
									$hasilreplace = ltrim($replaceid);
									
									//Buat angka +1 walaupun awalan ada angka 0. contoh: 009 -> 010
									$part_number = (int)$hasilreplace+1;
									//$part_number++;
									$createidbaru = str_pad($part_number, 3, '0', STR_PAD_LEFT);
									$hasilidbaru = 'TR'.$createidbaru;
								}
							?>
						<!-- END BUAT ID BARU -->
						<h4 class="card-title">Data Transaksi Peminjaman</h4>
						<hr>
						<div id="content">
							<form action="controller/PeminjamanController.php?action=inputpeminjaman" method="post" enctype="multipart/form-data">
							
							<div class="col-md-12 row">
							<div class="col-md-7">
								<div class="form-group row">
									<label for="id_anggota" class="col-sm-3 col-form-label">No. Peminjaman</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="id_transaksi" name="id_transaksi" value="<?php echo $hasilidbaru; ?>" readonly>
										<label>* Nomor transaksi otomatis terbuat oleh sistem</label>
									</div>
								</div>
									
								<div class="form-group row">
									<label for="nama" class="col-sm-3 col-form-label">Tanggal Peminjaman</label>
									<div class="col-sm-9">
										<input type="date" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam">
										<label>* Pilih tanggal peminjaman</label>
									</div>
								</div>
									
								<div class="form-group row">
									 <label for="id_anggota" class="col-sm-3 col-form-label">ID Anggota</label>
									 <div class="col-sm-9">
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
											<option value="">Pilih Peminjam</option>
												<?php echo idanggota($koneksi); ?>
										</select>
										<label>* Pilih anggota yang ingin meminjam</label>				
									 </div>
								</div>
								<div class="form-group row">
									<label for="data_anggota" class="col-sm-3 col-form-label">Data Anggota</label>
									<div class="col-sm-9" id="tampildataanggota">
										 <label for="id_anggota" class="col-sm-12 col-form-label"><i class="ti-info-alt"></i> Data anggota belum dicari</label>
										
									</div>
								</div>
									
								<!--<div class="form-group row">
									 <label for="id_anggota" class="col-sm-3 col-form-label">Lama Peminjaman</label>
									 <div class="col-sm-9">
										<input type="text" class="form-control" id="lama_peminjaman" name="lama_peminjaman" placeholder="Contoh: 7 hari">
										<label>* Durasi peminjaman</label>
									 </div>
								</div>-->
								
								<div class="form-group row">
									<label for="nama" class="col-sm-3 col-form-label">Tanggal Pengembalian</label>
									<div class="col-sm-9">
										<input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali">
										<label>* Pilih tanggal pengembalian</label>
									</div>
								</div>
									
								<div class="form-group row">	
									<div class="col-sm-2">
										<input type="submit" name="simpan" value="Simpan" class="btn btn-md btn-outline-primary btn-icon-text">
									</div>
									<div class="col-sm-2">
										<a href="index.php?p=peminjaman" class="btn btn-md btn-outline-warning btn-icon-text">Batal</a>
									</div>
								</div>
								</div>
								<div class="col-md-5">
									<div class="form-group row">
										<label for="id_buku" class="col-sm-3 col-form-label">Kode Buku</label>
										<div class="col-sm-9">
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
											<select name="id_buku" id="idbuku" class="custom-select">
												<option value="">Pilih Buku</option>
													<?php echo idbuku($koneksi); ?>
											</select>
											<label>* Pilih Buku yang ingin meminjam</label>	
										

											
										</div>
									</div>
									
									<div class="form-group row">
										<label for="data_buku" class="col-sm-12 p-1 col-form-label">Data Buku</label>
										<div class="col-sm-12 p-1" id="tampildatabuku">
											 <label for="id_buku" class="col-sm-12 col-form-label">* Data buku belum dicari</label>
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
			
		
	</div>
</div>

 