<?php  
// GET dari form submit create,read,update,delete & cetak
	$nameaction = $_GET['action'];
	if(isset($_GET['action'])!=''){
		// Diarahkan ke fungsi masing-masing berdasarkan php?action=variable untuk menjalankan proses
		// Contoh name action: inputanggota, editanggota, hapusanggota, cetakdataanggota, cetakkartuanggota
		$nameaction();
	}else{
		echo "
		<script>
			alert('Kesalahan Sistem, coba lagi atau hubungi administrator...')
			window.location.href = '../index.php?p=anggota';
		</script>";
	}
// End GET dari form submit create,read,update,delete & cetak

function pilihanggota(){
include'../config_db.php';
$output = '';
if(isset($_POST["id_anggota"])){
	$id_anggota = $_POST["id_anggota"];
	if($_POST["id_anggota"] != ""){
		$sql = "SELECT * FROM tbanggota WHERE id_anggota = '$id_anggota'";
	
	$result = mysqli_query($koneksi, $sql);
	while ($row = mysqli_fetch_array($result)) {
		$output .= '<div class="col-md-12 row">';
		
			$output .= '<div class="col-md-3">';
				$output .= '<div class="col-md-12"><br></div>';
				$output .= '<div class="col-md-12 p-1 col-form-label"><img width="75px" src=asset/anggota/'.$row["foto"].'></img></div>';
			$output .= '</div>';
			
			$output .= '<div class="col-sm-9 form-group row">';
				$output .= '<div class="col-md-12">ID: '.$row["id_anggota"].'</div>';
				$output .= '<div class="col-md-12">Nama: '.$row["nama"].'</div>';
				$output .= '<div class="col-md-12">Jenis Kelamin: '.$row["jenis_kelamin"].'</div>';
				$output .= '<div class="col-md-12">Alamat: '.$row["alamat"].'</div>';
				if($row["status_anggota"]=="Meminjam"){
					$output .= '<div class="col-md-12"><button class="btn btn-warning btn-sm"><i class="ti-alert"></i><input type="hidden" name="status_anggota" id="status_anggota" value="'.$row["status_anggota"].'" required> '.$row["status_anggota"].'</button></div>';
				}else{
					$output .= '<div class="col-md-12"><button class="btn btn-success btn-sm"> <i class="ti-check"></i><input type="hidden" name="status_anggota" id="status_anggota" value="'.$row["status_anggota"].'" required> '.$row["status_anggota"].'</button></div>';
				}
			$output .= '</div>';
			
		$output .= '</div>';
	}
	}else{
		$output = '<div class="col-md-12"><i class="ti-info-alt"></i> Kamu belum memilih data anggota yang ingin meminjam...</div>';
	}
	echo $output;
}
}

function pilihbuku(){
include'../config_db.php';
$output = '';
if(isset($_POST["id_buku"])){
	$id_buku = $_POST["id_buku"];
	if($_POST["id_buku"] != ""){
		$sqltransaksi = "SELECT count(id_buku) as id_buku FROM tbtransaksi  WHERE id_buku = '$id_buku' and status='Aktif' ";
		$sqltransaksi = mysqli_query($koneksi, $sqltransaksi);
		foreach($sqltransaksi as $sqltransaksi)
		
		if($sqltransaksi['id_buku']==0){
			$sql = "SELECT * FROM tbbuku  WHERE id_buku = '$id_buku'";
		}else{
			$sql = "SELECT * FROM tbbuku a, tbanggota b, tbtransaksi c WHERE a.id_buku = '$id_buku' and a.id_buku=c.id_buku and b.id_anggota=c.id_anggota and c.status='Aktif'";
		}
		
	$result = mysqli_query($koneksi, $sql);
	while ($row = mysqli_fetch_array($result)) {
		$output .= '<div class="col-md-12 row">';
			//$output .= '<div class="col-md-4">';
				//$output .= '<div class="col-md-12"><br></div>';
				//$output .= '<div class="col-md-12"><img width="75px" src=asset/anggota/'.$row["foto"].'></img></div>';
			//$output .= '</div>';
			$output .= '<table class="table table-striped">
								  <thead>
									<tr>
									  <th> ID Buku </th>
									  <th> Title </th>
									  <th> Penulis </th>
									  <th> Penerbit </th>
									</tr>
								  </thead>
								  <tbody>
								    <tr>
									  <td>'.$row["id_buku"].'</td>
									  <td>'.$row["judul_buku"].'</td>
									  <td>'.$row["penulis"].'</td>
									  <td>'.$row["penerbit"].'</td>
									</tr>
									</tbody>
									</table>';
			if($row["status_buku"]=="Dipinjam"){
				$output .= '<div class="col-md-12"><a href="#" class="btn btn-warning btn-sm"><i class="ti-alert"></i>Status Buku: <input type="hidden" name="status_buku" value="'.$row["status_buku"].'">  '.$row["status_buku"].' oleh: '.$row["id_anggota"].' - '.$row["nama"].'</a></div>';
			}else{
				$output .= '<div class="col-md-12"><a href="#" class="btn btn-success btn-sm"> <i class="ti-check"></i>Status Buku: <input type="hidden" name="status_buku" value="'.$row["status_buku"].'">  '.$row["status_buku"].'</a></div>';
			}
			
			//$output .= '<div class="col-md-12">';
				//$output .= '<div class="col-md-12">ID: '.$row["id_buku"].'</div>';
				//$output .= '<div class="col-md-12">Nama: '.$row["judul_buku"].'</div>';
				//$output .= '<div class="col-md-12">Penulis: '.$row["penulis"].'</div>';
				//$output .= '<div class="col-md-12">Penerbit: '.$row["penerbit"].'</div>';
				//if($row["status_buku"]=="Dipinjam"){
				//	$output .= '<div class="col-md-12"><a href="#" class="btn btn-warning btn-sm"><i class="ti-alert"></i><input type="hidden" name="status_buku" value="'.$row["status_buku"].'">  '.$row["status_buku"].' oleh: '.$row["id_anggota"].' - '.$row["nama"].'</a></div>';
				//}else{
				//	$output .= '<div class="col-md-12"><a href="#" class="btn btn-success btn-sm"> <i class="ti-check"></i><input type="hidden" name="status_buku" value="'.$row["status_buku"].'">  '.$row["status_buku"].'</a></div>';
				//}
			//$output .= '</div>';
		$output .= '</div>';
	}
	}else{
		$output = '<div class="col-md-12"><i class="ti-info-alt"></i> Kamu belum memilih data anggota yang ingin meminjam...</div>';
	}
	echo $output;
}
}

// 1. Input Anggota
	function inputpeminjaman(){

		include'../config_db.php';
		$id_transaksi=$_POST['id_transaksi'];
		$tanggal_pinjam=$_POST['tanggal_pinjam'];
		$tanggal_kembali=$_POST['tanggal_kembali'];
		$tanggal_dikembalikan=null;
		$id_anggota=$_POST['id_anggota'];
		$id_buku=$_POST['id_buku'];
		//diambil dari function pilihanggota
		$status_anggota=$_POST['status_anggota'];
		//diambil dari function pilihbuku
		$status_buku=$_POST['status_buku'];
		$status="Aktif";
			
			if(isset($_POST['simpan'])){
				extract($_POST);
				
				//cek apakah anggota ada peminjaman
				if($status_anggota=='Meminjam'){
					echo "
					<script>
						alert('Anggota ".$id_anggota." sedang meminjam buku lain, mohon cek kembali')
						window.location.href = '../index.php?p=peminjaman-input';
					</script>";
				//cek apakah buku sedang dipinjam
				}elseif($status_buku=="Dipinjam"){
					echo "
					<script>
						alert('Buku ID: ".$id_buku." sedang dipinjam anggota lain, mohon cek kembali')
						window.location.href = '../index.php?p=peminjaman-input';
					</script>";
					//window.location.href = history.go(-1);
				}else{
				$sql = "INSERT INTO tbtransaksi(id_transaksi, id_anggota, id_buku, tanggal_pinjam, tanggal_kembali, tanggal_dikembalikan, status) VALUES('$id_transaksi','$id_anggota','$id_buku','$tanggal_pinjam','$tanggal_kembali',NULL,'$status')";
				$query = mysqli_query($koneksi, $sql);
				
				mysqli_query($koneksi,
				"UPDATE tbbuku
				SET status_buku='Dipinjam'
				WHERE id_buku='$id_buku'"
				);
				echo "
					<script>
						alert('Transaksi Peminjaman Berhasil di Buat')
						window.location.href = '../index.php?p=peminjaman';
					</script>";
				}
			}
	}
	
// 2. Edit Anggota
	function editdatapeminjaman(){

		include'../config_db.php';

		$id_transaksi=$_POST['id_transaksi'];
		$id_anggota=$_POST['id_anggota'];
		$id_buku=$_POST['id_buku'];
		$tanggal_peminjaman=$_POST['tanggal_peminjaman'];
		$tanggal_pengembalian=$_POST['tanggal_pengembalian'];
		$id_anggotasebelumnya=$_POST['id_anggotasebelumnya'];
		$id_bukusebelumnya=$_POST['id_bukusebelumnya'];
		//diambil dari function pilihanggota
		$status_anggota=$_POST['status_anggota'];
		//diambil dari function pilihbuku
		$status_buku=$_POST['status_buku'];
		

		
		

		If(isset($_POST['simpan'])){
			
				extract($_POST);
				if($id_anggotasebelumnya==$id_anggota and $status_anggota=='Meminjam' and $id_bukusebelumnya!=$id_buku and $status_buku=="Tersedia"){
					mysqli_query($koneksi,
										"UPDATE tbtransaksi
										SET id_anggota='$id_anggota',id_buku='$id_buku',tanggal_pinjam='$tanggal_peminjaman',tanggal_kembali='$tanggal_pengembalian',tanggal_dikembalikan=NULL
										WHERE id_transaksi='$id_transaksi'"
									);

									mysqli_query($koneksi, "UPDATE tbbuku SET status_buku='Dipinjam' WHERE id_buku='$id_buku'");
									mysqli_query($koneksi, "UPDATE tbbuku SET status_buku='Tersedia' WHERE id_buku='$id_bukusebelumnya'");
									mysqli_query($koneksi, "UPDATE tbanggota SET status_anggota='Meminjam' WHERE id_anggota='$id_anggota'");
									echo "
									<script>
										alert('Berhasil Melakukan Edit Transaksi Peminjaman Buku')
										window.location.href = '../index.php?p=peminjaman';
									</script>";
				}elseif($id_anggotasebelumnya==$id_anggota and $status_anggota=='Meminjam' and $id_bukusebelumnya!=$id_buku and $status_buku=="Dipinjam"){
					echo "
											<script>
												alert('Buku ID: ".$id_buku." sedang dipinjam anggota lain, mohon cek kembali')
												window.location.href = '../index.php?p=peminjaman-edit&id=".$id_transaksi."';
											</script>";				
				
				}elseif($id_anggotasebelumnya!=$id_anggota and $status_anggota=='Meminjam'){
							
									echo "
									<script>
										alert('Anggota ".$id_anggota." sedang meminjam buku lain, mohon cek kembali')
										window.location.href = '../index.php?p=peminjaman-edit&id=".$id_transaksi."';
									</script>";
									//cek apakah buku sedang dipinjam
				}elseif($id_anggotasebelumnya!=$id_anggota and $status_anggota=='Tidak Meminjam' and $id_bukusebelumnya==$id_buku){
					mysqli_query($koneksi,
										"UPDATE tbtransaksi
										SET id_anggota='$id_anggota',tanggal_pinjam='$tanggal_peminjaman',tanggal_kembali='$tanggal_pengembalian',tanggal_dikembalikan=NULL
										WHERE id_transaksi='$id_transaksi'"
									);

									mysqli_query($koneksi, "UPDATE tbbuku SET status_buku='Dipinjam' WHERE id_buku='$id_buku'");
									mysqli_query($koneksi, "UPDATE tbanggota SET status_anggota='Meminjam' WHERE id_anggota='$id_anggota'");
									mysqli_query($koneksi, "UPDATE tbanggota SET status_anggota='Tidak Meminjam' WHERE id_anggota='$id_anggotasebelumnya'");
									echo "
									<script>
										alert('Berhasil Melakukan Edit Transaksi Peminjaman Buku')
										window.location.href = '../index.php?p=peminjaman';
									</script>";
				}elseif($id_anggotasebelumnya!=$id_anggota and $status_anggota=='Tidak Meminjam' and $status_buku=="Dipinjam"){
											echo "
											<script>
												alert('Buku ID: ".$id_buku." sedang dipinjam anggota lain, mohon cek kembali')
												window.location.href = '../index.php?p=peminjaman-edit&id=".$id_transaksi."';
											</script>";				
				}else{
					mysqli_query($koneksi,
										"UPDATE tbtransaksi
										SET id_anggota='$id_anggota',id_buku='$id_buku',tanggal_pinjam='$tanggal_peminjaman',tanggal_kembali='$tanggal_pengembalian',tanggal_dikembalikan=NULL
										WHERE id_transaksi='$id_transaksi'"
									);

									mysqli_query($koneksi, "UPDATE tbbuku SET status_buku='Dipinjam' WHERE id_buku='$id_buku'");
									mysqli_query($koneksi, "UPDATE tbbuku SET status_buku='Tersedia' WHERE id_buku='$id_bukusebelumnya'");
									mysqli_query($koneksi, "UPDATE tbanggota SET status_anggota='Meminjam' WHERE id_anggota='$id_anggota'");
									mysqli_query($koneksi, "UPDATE tbanggota SET status_anggota='Tidak Meminjam' WHERE id_anggota='$id_anggotasebelumnya'");
									echo "
									<script>
										alert('Berhasil Melakukan Edit Transaksi Peminjaman Buku')
										window.location.href = '../index.php?p=peminjaman';
									</script>";
					
				}
			

	}
	}
	
	


// 3. Hapus Anggota
	function hapustransaksi(){

	include'../config_db.php';
	$id_transaksi=$_GET['id'];

	mysqli_query($koneksi,
		"DELETE FROM tbtransaksi
		WHERE id_transaksi='$id_transaksi'"
	);

	echo "
			<script>
				alert('Data Transaksi Berhasil di Hapus')
				window.location.href = '../index.php?p=peminjaman';
			</script>";	

	}

// 4. Cetak Data Transaksi Peminjaman
	function cetakdatapeminjaman(){
		$id_transaksi=$_GET['id'];
		//Redirect ke Halaman Cetak Data Anggota
		//echo"<script>
		//window.print();
	//</script>";
		header("location:../view/peminjaman-cetak-data.php?id=$id_transaksi");
	}
// 4. Cetak Data All Peminjaman
	function cetakdataallpeminjaman(){
		$id_transaksi=$_GET['id'];
		//Redirect ke Halaman Cetak Data Anggota
		//echo"<script>
		//window.print();
	//</script>";
		header("location:../view/peminjaman-cetak-all-data.php");
	}


?>