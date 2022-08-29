<?phpini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);?>
<title>Input Pengembalian Buku | Sistem Perpustakaan Online</title>
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
						<h4 class="card-title">Input Transaksi Pengembalian</h4>
						<hr>
						<div id="content">
							<form action="controller/PeminjamanController.php?action=inputpeminjaman" method="post" enctype="multipart/form-data">
							
							<div class="col-md-12 row">
							<div class="col-md-12">
									
									
								<div class="form-group row">
									 <!--<label for="id_anggota" class="col-sm-3 col-form-label">Pilih ID Transaksi</label>-->
									 <div class="col-sm-4">
										<?php  
										include'config_db.php';
										function idtransaksi($koneksi)
										{
											$output = '';
											$sql = "SELECT * FROM tbtransaksi where status='Aktif'";
											$result = mysqli_query($koneksi, $sql);
											while($row = mysqli_fetch_array($result)){
												$output .= "<option value=".$row["id_transaksi"].">".$row["id_transaksi"].' - '.$row["id_anggota"]."</option>";
											}
											return $output;
										}
										?>
										<select name="id_anggota" id="idtransaksi" class="custom-select">
											<option value="">Pilih No. Peminjaman</option>
												<?php echo idtransaksi($koneksi); ?>
										</select>
										<label>* Pilih nomor transaksi peminjaman yang akan di kembalikan bukunya</label>				
									 </div>
									 	<div class="col-sm-12">
											<hr>
										</div>
									 <div class="col-sm-12" id="tampildataanggota">
										 <label for="id_transaksi" class="col-sm-12 col-form-label"><i class="ti-info-alt"></i> Data transaksi peminjaman belum dicari, pilih salah satu nomor transaksi diatas.</label>
									</div>
									
								</div>
							
								<div class="form-group row">	
									<div class="col-sm-2">
										<input type="submit" name="simpan" value="Simpan" class="btn btn-md btn-outline-primary btn-icon-text">
									</div>
									<div class="col-sm-2">
										<a href="index.php?p=pengembalian" class="btn btn-md btn-outline-warning btn-icon-text">Batal</a>
									</div>
								</div>
							</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
	$(document).ready(function(){
		$("#idtransaksi").change(function(){
			var id_transaksi = $(this).val()
			$.ajax({
				url: "controller/PengembalianController.php?action=pilihtransaksipengembalian",
				method: "POST",
				data: {id_transaksi: id_transaksi},
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

 