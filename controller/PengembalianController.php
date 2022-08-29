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
			$output .= '<div class="col-md-4">';
				$output .= '<div class="col-md-12"><br></div>';
				$output .= '<div class="col-md-12"><img width="75px" src=asset/anggota/'.$row["foto"].'></img></div>';
			$output .= '</div>';
			$output .= '<div class="col-md-8">';
				$output .= '<div class="col-md-12">ID: '.$row["id_anggota"].'</div>';
				$output .= '<div class="col-md-12">Nama: '.$row["nama"].'</div>';
				$output .= '<div class="col-md-12">Jenis Kelamin: '.$row["jenis_kelamin"].'</div>';
				$output .= '<div class="col-md-12">Alamat: '.$row["alamat"].'</div>';
				if($row["status_anggota"]=="Meminjam"){
					$output .= '<div class="col-md-12"><button class="btn btn-warning btn-sm"><i class="ti-alert"></i> '.$row["status_anggota"].'</button></div>';
				}else{
					$output .= '<div class="col-md-12"><button class="btn btn-success btn-sm"> <i class="ti-check"></i> '.$row["status_anggota"].'</button></div>';
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
		$sql = "SELECT * FROM tbbuku WHERE id_buku = '$id_buku'";
	
	$result = mysqli_query($koneksi, $sql);
	while ($row = mysqli_fetch_array($result)) {
		$output .= '<div class="col-md-12 row">';
			//$output .= '<div class="col-md-4">';
				//$output .= '<div class="col-md-12"><br></div>';
				//$output .= '<div class="col-md-12"><img width="75px" src=asset/anggota/'.$row["foto"].'></img></div>';
			//$output .= '</div>';
			$output .= '<div class="col-md-12">';
				$output .= '<div class="col-md-12">ID: '.$row["id_buku"].'</div>';
				$output .= '<div class="col-md-12">Nama: '.$row["judul_buku"].'</div>';
				$output .= '<div class="col-md-12">Penulis: '.$row["penulis"].'</div>';
				$output .= '<div class="col-md-12">Penerbit: '.$row["penerbit"].'</div>';
				if($row["status_buku"]=="Dipinjam"){
					$output .= '<div class="col-md-12"><button class="btn btn-warning btn-sm"><i class="ti-alert"></i> '.$row["status_buku"].'</button></div>';
				}else{
					$output .= '<div class="col-md-12"><button class="btn btn-success btn-sm"> <i class="ti-check"></i> '.$row["status_buku"].'</button></div>';
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

function pilihtransaksipengembalian(){
include'../config_db.php';
$output = '';
if(isset($_POST["id_transaksi"])){
	$id_transaksi = $_POST["id_transaksi"];
	if($_POST["id_transaksi"] != ""){
		$sql = "SELECT * FROM tbtransaksi a, tbanggota b, tbbuku c WHERE a.id_anggota=b.id_anggota and a.id_buku=c.id_buku and a.id_transaksi = '$id_transaksi'";
	
	$result = mysqli_query($koneksi, $sql);
	while ($row = mysqli_fetch_array($result)) {
		
			$output .= '<div class="row">';
			
				$output .= '<div class="form-group col-md-6">';
					$output .= '<div class="form-group row">';
						$output .= '<label for="inputpengembalian" class="col-sm-4 p-1 col-form-label">No. Pengembalian / Peminjaman</label>';
						$output .= '<label class="col-md-8 p-1 col-form-label">'.$row["id_transaksi"].' / '.$row["id_transaksi"].'</label>';
					$output .= '</div>';
					$output .= '<div class="form-group row">';
						$output .= '<label for="inputpengembalian" class="col-sm-4 p-1 col-form-label">Tgl. Peminjaman</label>';
						$output .= '<label class="col-md-8 p-1 col-form-label">'.$row["tanggal_pinjam"].'</label>';
					$output .= '</div>';
					$output .= '<div class="form-group row">';
						$output .= '<label for="inputpengembalian" class="col-sm-4 p-1 col-form-label">Tgl. Pengembalian</label>';
						$output .= '<label class="col-md-8 p-1 col-form-label">'.$row["tanggal_kembali"].'</label>';
					$output .= '</div>';
				$output .= '</div>';
				
				$output .= '<div class="form-group col-md-6">';
					$output .= '<div class="form-group row">';
						$output .= '<label for="tanggal_dikembalikan" class="col-sm-4 col-form-label">Tgl. Dikembalikan</label>';
						$output .= '<div class="col-md-8">
										<input type="datetime-local" name="tanggal_dikembalikan" id="tanggal_dikembalikan" class="form-control" value="'.$row["tanggal_dikembalikan"].'">
										<label class="form-label text-danger">* Isi tanggal pengembalian buku</label>
									</div>';
						$output .= '<label for="tanggal_dikembalikan" class="col-sm-12 col-form-label"><b>Data Buku Yang Dipinjam</b></label>';
						$output .= '
							<table class="table table-striped">
								<thead>
									<tr>
									  <th> Title </th>
									  <th> Penulis </th>
									  <th> Penerbit </th>
									</tr>
								</thead>
								<tbody>
								    <tr>
									  <td>
									   '.$row["judul_buku"].'
									  </td>
									  <td>
										'.$row["penulis"].'
									  </td>
									   <td>
										 '.$row["penerbit"].'
									  </td>
									</tr>
								</tbody>
							</table>
								  ';
					$output .= '</div>';
				$output .= '</div>';
				
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
		$status="Aktif";
			
			if(isset($_POST['simpan'])){
				extract($_POST);
				
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
	
// 2. Edit Anggota
	function editdatapengembalian(){

		include'../config_db.php';

		$id_transaksi=$_POST['id_transaksi'];
		$status=$_POST['status'];
		$tanggal_dikembalikan=$_POST['tanggal_dikembalikan'];
		$id_buku=$_POST['id_buku'];
		$id_anggota=$_POST['id_anggota'];

		If(isset($_POST['simpan'])){
			
				extract($_POST);

			
			
			
			if($_POST['status']=='Aktif'){
				mysqli_query($koneksi,
				"UPDATE tbtransaksi
				SET tanggal_dikembalikan=NULL,status='$status'
				WHERE id_transaksi='$id_transaksi'"
				);
				mysqli_query($koneksi, "UPDATE tbbuku SET status_buku='Dipinjam' WHERE id_buku='$id_buku'");
				mysqli_query($koneksi, "UPDATE tbanggota SET status_anggota='Meminjam' WHERE id_anggota='$id_anggota'");
			}else{
				mysqli_query($koneksi,
				"UPDATE tbtransaksi
				SET tanggal_dikembalikan='$tanggal_dikembalikan',status='$status'
				WHERE id_transaksi='$id_transaksi'"
				);
				mysqli_query($koneksi, "UPDATE tbbuku SET status_buku='Tersedia' WHERE id_buku='$id_buku'");
				mysqli_query($koneksi, "UPDATE tbanggota SET status_anggota='Tidak Meminjam' WHERE id_anggota='$id_anggota'");
			}
			echo "
					<script>
						alert('Data Pengembalian Buku Berhasil Diubah')
						window.location.href = '../index.php?p=pengembalian';
					</script>";
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

// 4. Cetak Data Anggota
	function cetakdatapengembalian(){
		$id_transaksi=$_GET['id'];
		//Redirect ke Halaman Cetak Data Anggota
		//echo"<script>
		//window.print();
	//</script>";
		header("location:../view/pengembalian-cetak-data.php?id=$id_transaksi");
	}

// 4. Cetak Data All Pengembalian
	function cetakdataallpengembalian(){
		$id_transaksi=$_GET['id'];
		//Redirect ke Halaman Cetak Data Anggota
		//echo"<script>
		//window.print();
	//</script>";
		header("location:../view/pengembalian-cetak-all-data.php");
	}

?>