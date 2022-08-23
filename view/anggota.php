 <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">


<div id="content">
	
	<FORM CLASS="form-inline" METHOD="POST">
	<div align="right">
		<form method="post">
			<input type="text" class="form-control-sm" placeholder="cari disini..." name="pencarian"><input class="btn btn-sm btn-primary btn-icon-text" type="submit" name="search" value="search" class="tombol">
		</form>
	</FORM>
	</p>
	
		<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				
				<div class="row">
					<div class="col-lg-5">
						<a target="_blank" href="index.php?p=anggota-input" type="button" class="btn btn-sm btn-outline-success btn-icon-text"><i class="ti-plus btn-icon-append"></i> Tambah </a>
						<a target="_blank" href="controller/AnggotaController.php?action=cetakdataanggota" type="button" class="btn btn-sm btn-outline-info btn-icon-text"><i class="ti-printer btn-icon-append"> Print Data Anggota</i></a>
					</div>
					<div class="col-lg-7">
					  <h4 class="card-title">DATA ANGGOTA</h4>
					  <p class="card-description">
						Perpustakaan Online | <code>.data-anggota</code>
					  </p>
					</div>
				</div>
				
                <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            -
                          </th>
                          <th>
                            No
                          </th>
                          <th>
                            ID Anggota
                          </th>
                          <th>
                            Nama
                          </th>
                          <th>
                            Jenis Kelamin
                          </th>
						   <th>
                            Alamat
                          </th>
						  <th>
                            Status
                          </th>
						   <th>
                            Aksi
                          </th>
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
								$sql = "SELECT * FROM tbanggota WHERE nama LIKE '%$pencarian%'
										OR id_anggota LIKE '%$pencarian%'
										OR jenis_kelamin LIKE '%$pencarian%'
										OR alamat LIKE '%$pencarian%'";
								
								$query = $sql;
								$queryJml = $sql;	
										
							}
							else {
								$query = "SELECT * FROM tbanggota LIMIT $posisi, $batas";
								$queryJml = "SELECT * FROM tbanggota";
								$no = $posisi * 1;
							}			
						}
						else {
							$query = "SELECT * FROM tbanggota LIMIT $posisi, $batas";
							$queryJml = "SELECT * FROM tbanggota";
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
                          <td class="py-1">
                           <img src="asset/anggota/<?php echo $foto; ?>" width="75%" height="75%">
                          </td>
                          <td>
                           <?php echo $nomor; ?>
                          </td>
                          <td>
                           <?php echo $r_tampil_anggota['id_anggota']; ?>
                          </td>
                          <td>
                            <?php echo $r_tampil_anggota['nama']; ?>
                          </td> 
						  <td>
                            <?php echo $r_tampil_anggota['jenis_kelamin']; ?>
                          </td>
						  <td>
                            <?php echo $r_tampil_anggota['alamat']; ?>
                          </td>
						   <td>
                            <?php echo $r_tampil_anggota['status']; ?>
							
                            <div class="progress">
								<?php if($r_tampil_anggota['status']=='Meminjam'){ ?>
									<div class="progress-bar bg-warning" role="progressbar" style="width: 45%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
								<?php }else{ ?>
									<div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
								<?php } ?>
							
                            </div>
                         
                          </td>
						  <td>
						    <div>
								<a title="Cetak Kartu Anggota" target="_blank" href="controller/AnggotaController.php?action=cetakkartuanggota&id=<?php echo $r_tampil_anggota['id_anggota'];?>"> <button type="button" class="btn btn-primary btn-rounded btn-icon"><i class="ti-printer btn-icon-append"></i></button></a>
								<a title="Edit Anggota" href="index.php?p=anggota-edit&id=<?php echo $r_tampil_anggota['id_anggota'];?>"> <button type="button" class="btn btn-success btn-rounded btn-icon"> <i class="ti-pencil-alt btn-icon-append"></i></button></a>
								<a title="Hapus Anggota" href="controller/AnggotaController.php?action=hapusanggota&id=<?php echo $r_tampil_anggota['id_anggota']; ?>" onclick = "return confirm ('Apakah Anda Yakin Akan Menghapus Data Ini?')"> <button type="button" class="btn btn-danger btn-rounded btn-icon"> <i class="ti-trash btn-icon-append"></i></button></a>
							</div>
	
                          </td>
                        </tr>
			<?php $nomor++; } 
				}else {
						echo "<tr><td>Maaf Data Yang Dicari Tidak Ditemukan...</td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo "<td></td>";
						echo"<td><label class='badge badge-success'>Completed</label></td></tr>";
					}?>	
                      </tbody>
                    </table>
                </div>
            </div>
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
			echo " <button type='button' class='btn btn-social-icon-text btn-facebook'><i class='ti-server'> </i>  Jumlah Data : $jml</button><b></b>";
		?>			
		</div><br>

		
			<?php
			echo " <ul class='pagination'>";
						echo " <li class='page-item disabled'><a class='page-link' href='#'>Previous</a></li>";
				$jml_hal = ceil($jml/$batas);
				for($i=1; $i<=$jml_hal; $i++){
					if($i != $hal){
						
						echo " <li class='page-item active'><a href=\"?p=anggota&hal=$i\" class='page-link' href='#'>$i</a></li>";
					
						
					}
					else {
						
						echo " <li class='page-item'><a class='page-link' class=\"active\" href=\"?p=anggota&hal=$i\">$i</a></li>";
					
				
					
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