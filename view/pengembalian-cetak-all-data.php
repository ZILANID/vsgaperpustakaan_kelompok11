<?php
include "../config_db.php";
?>
<style>
.center {
  margin-left: auto;
  margin-right: auto;
}
</style>
<title>Cetak Data All Pengembalian Buku | Sistem Perpustakaan Online</title>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!--<title>Sistem Perpustakaan Online</title>-->
  <!-- plugins:css -->
  <link rel="stylesheet" href="../skydash/vendors/feather/feather.css">
  <link rel="stylesheet" href="../skydash/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../skydash/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../skydash/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../skydash/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="../skydash/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../skydash/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../skydash/images/favicon.png" />
</head>
<link rel="stylesheet" type="text/css" href="../style.css">
<div>
<center><h3>DATA TRANSAKSI PENGEMBALIAN BUKU</h3></center>
<center><p>Transaksi Pengembalian Buku per: <?php echo date("l j F Y h:i:s A") . "<br>"; ?></p></center>

</div>		
				<br>
				<br>
				<div class="row col-lg-12">
					<div class="col-lg-5">
						
					</div>
					<div class="col-lg-7" align="right">
					  <h4 class="card-title">DATA TRANSAKSI PENGEMBALIAN</h4>
					  <p class="card-description">
						Perpustakaan Online | <code>.data-Transaksi Pengembalian Sedang Berlangsung</code>
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
						  <th>Tgl. Peminjaman</th>
						  <th>Tgl. Pengembalian</th>
						  <th>Status</th>
						  <th> Tgl. Dikembalikan </th>
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
								<center><img src="../asset/anggota/<?php echo $foto; ?>" width="75%" height="75%"><br></center>
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
	
		
		</div><br>


				
		</div>
		</div>

</div>
</div>

</div>
</div>
</div>
</div>
</div>
	<script>
		
		window.print();
	</script>
</div>
