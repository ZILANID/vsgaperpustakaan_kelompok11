 <title>Data Peminjaman Buku | Sistem Perpustakaan Online</title>
<div class="content-wrapper">
    <div class="row">
<div class="col-md-12 grid-margin">



<div id="content">
	
	<FORM CLASS="form-inline" METHOD="POST">
	<div align="right"  class="col-lg-12">
		<form method="post">
			<input type="text" class="form-control-sm" placeholder="cari disini..." name="pencarian"><input class="btn btn-sm btn-primary btn-icon-text" type="submit" name="search" value="search" class="tombol">
		</form>
	</div>
	</FORM>
</br>
	<div align="left" class="col-lg-12">
		<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
			  
            <div class="card-body">
				
				<div class="row col-lg-12">
					<div class="col-lg-5">
						<a target="_blank" href="index.php?p=pengembalian-input" type="button" class="btn btn-sm btn-outline-success btn-icon-text"><i class="ti-plus btn-icon-append"></i> Input Pengembalian</a>
						<a target="_blank" href="controller/PengembalianController.php?action=cetakdataallpengembalian" type="button" class="btn btn-sm btn-outline-info btn-icon-text"><i class="ti-printer btn-icon-append"> Cetak All Data</i></a>
					</div>
					<div class="col-lg-7" align="right">
					  <h4 class="card-title">TRANSAKSI PENGEMBALIAN</h4>
					  <p class="card-description">
						Perpustakaan Online | <code>.data-Transaksi Pengembalian</code>
					  </p>
					</div>
				</div>
				
                <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Transaksi</th>
                          <th>ID / Nama Anggota</th>
						  <th> Tanggal Pinjam</th>
						  <th>Tanggal Kembali</th>
						  <th>Status</th>
						  <th> Tgl Dikembalikan </th>
						  <th>Aksi</th>
                        </tr>
                      </thead>
	
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
						if($_SERVER['REQUEST_METHOD'] == "POST"){
							$pencarian = trim(mysqli_real_escape_string($koneksi, $_POST['pencarian']));
							if($pencarian != ""){
								$sql = "SELECT * FROM tbtransaksi a, tbanggota b, tbbuku c  WHERE a.status='Selesai' and a.id_anggota=b.id_anggota  and a.id_buku=c.id_buku 
										and (a.id_transaksi LIKE '%$pencarian%' 
										OR a.id_anggota LIKE '%$pencarian%'
										OR a.id_buku LIKE '%$pencarian%'
										OR a.tanggal_pinjam LIKE '%$pencarian%'
										OR a.tanggal_kembali LIKE '%$pencarian%'
										OR b.nama LIKE '%$pencarian%'
										OR c.judul_buku LIKE '%$pencarian%')
										group by b.id_anggota";
								
								$query = $sql;
								$queryJml = $sql;	
								
										
							} else {
								$query = "SELECT * FROM tbtransaksi a, tbanggota b where a.status='Selesai' and a.id_anggota=b.id_anggota LIMIT $posisi, $batas";
								$queryJml = "SELECT * FROM tbtransaksi a, tbanggota b where a.status='Selesai' and a.id_anggota=b.id_anggota";
								$no = $posisi * 1;
							}			
						}
						else {
							$query = "SELECT * FROM tbtransaksi  a, tbanggota b, tbbuku c where a.status='Selesai' and a.id_anggota=b.id_anggota and a.id_buku=c.id_buku LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM tbtransaksi a, tbanggota b, tbbuku c where a.status='Selesai' and a.id_anggota=b.id_anggota and a.id_buku=c.id_buku";
							$no = $posisi * 1;
						}
						
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

                      <tbody>
                        <tr>
                          <td>
                           <?php echo $nomor; ?>
                          </td>
                          <td>
                           <?php echo $r_tampil_anggota['id_transaksi']; ?>
                          </td>
                          <td>
								<center><img src="asset/anggota/<?php echo $foto; ?>" width="75%" height="75%"><br></center>
								<center> <?php echo $r_tampil_anggota['id_anggota'] .' - '.$r_tampil_anggota['nama']; ?></center>
                          </td> 
						  <td>
                            <?php echo $r_tampil_anggota['tanggal_pinjam']; ?>
                          </td>
						   <td>
                            <?php echo $r_tampil_anggota['tanggal_kembali']; ?>
						  </td>
						  <td>
							 <?php if($r_tampil_anggota['status']=='Selesai'){ ?>
								Dikembalikan
							 <?php }else{ ?>
							   Peminjaman
							 <?php } ?>
							 
                            <div class="progress">
								<?php if($r_tampil_anggota['status']=='Selesai'){ ?>
									<div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
								<?php }else{ ?>
									<div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								<?php } ?>
							
                            </div>
                          </td>
						  <td>
							<div class="row">
								<?php if($r_tampil_anggota['tanggal_dikembalikan']==''){ ?>
									<div class="col-md-8 p-2 bg-light text-dark"><i class="ti-alert text-warning"></i> Belum Dikembalikan</div>
								<?php }else{ ?>
									<div class="col-md-8 p-2 bg-light text-dark"><?php echo $r_tampil_anggota['tanggal_dikembalikan']; ?></div>	
								<?php } ?>
							</div>
						  </td>
						  <td>
						    <div>
								<a title="Cetak Transaksi ini" target="_blank" href="controller/PengembalianController.php?action=cetakdatapengembalian&id=<?php echo $r_tampil_anggota['id_transaksi'];?>"> <button type="button" class="btn btn-primary btn-rounded btn-icon"><i class="ti-printer btn-icon-append"></i></button></a>
								<a title="Edit Transaksi" href="index.php?p=pengembalian-edit&id=<?php echo $r_tampil_anggota['id_transaksi'];?>"> <button type="button" class="btn btn-success btn-rounded btn-icon"> <i class="ti-pencil-alt btn-icon-append"></i></button></a>
								<a title="Detail Transaksi" href="index.php?p=pengembalian-detail&id=<?php echo $r_tampil_anggota['id_transaksi'];?>"> <button type="button" class="btn btn-success btn-rounded btn-icon"> <i class="ti-zoom-in btn-icon-append"></i></button></a>
								<!--<a title="Hapus Transaksi" href="controller/PengembalianController.php?action=hapustransaksi&id=<?php echo $r_tampil_anggota['id_transaksi']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')"> <button type="button" class="btn btn-danger btn-rounded btn-icon"> <i class="ti-trash btn-icon-append"></i></button></a>-->
							</div>
	
                          </td>
                        </tr>
			<?php $nomor++; } 
				}else {
						echo "<tr><td colspan='8'>Maaf Data Yang Dicari Tidak Ditemukan...</td>";
						echo"<td><label class='badge badge-success'>Pengambilan Data Selesai</label></td></tr>";
					}?>	
                      </tbody>
                    </table>
                </div>
            </div>
			
			<hr>
			
            </div>
        </div>
	
	<?php
	if(isset($_POST['pencarian'])){
	if($_POST['pencarian']!=''){
		echo "<div style=\"float:left;\">";
		$jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
		echo "Data Hasil Pencarian: <b>$jml</b>";
		echo "</div>";
	}
	}
	else{ ?>
				
		<div class="pagination">
		<div style="float: left;" >		
		<?php
			$jml = mysqli_num_rows(mysqli_query($koneksi, $queryJml));
			echo " <button type='button' class='btn btn-sm btn-social-icon-text'><i class='ti-server'> $jml</i>  </button><b></b>";
		?>			
		</div><br>

		
			<?php
			echo " <ul class='pagination'>";
						echo " <li class='page-item disabled'><a class='page-link' href='#'>Previous</a></li>";
				$jml_hal = ceil($jml/$batas);
				for($i=1; $i<=$jml_hal; $i++){
					if($i != $hal){
						
						echo " <li class='page-item active'><a href=\"?p=pengembalian&hal=$i\" class='page-link' href='#'>$i</a></li>";
					
						
					}
					else {
						
						echo " <li class='page-item'><a class='page-link' class=\"active\" href=\"?p=pengembalian&hal=$i\">$i</a></li>";
					
				
					
					}
				}
					echo " <li class='page-item'><a class='page-link' href='#'>Next</a></li>";
				echo " </ul>";
			?>
				
		</div>
	<?php
	}
	?>
</div>
</div>

</div>
</div>
</div>
</div>
</div>