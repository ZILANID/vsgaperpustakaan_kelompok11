<?php 
    // memulai session
    session_start();
	//Ambil Koneksi Database
	include 'config_db.php';

	//Mengambil isian dari form login + password terenkripsi md5
    $username = $_POST['username'];
    $password = md5($_POST['password']);
	
	//Cek username query ke database
	$query = "SELECT * FROM tbuser where username='".$username."'" ;
	$query = str_replace("\'","",$query);
	$result = mysqli_query($koneksi,$query);
	//Validasi Login
	if ($result->num_rows > 0) {
		while($row = mysqli_fetch_array($result))
		  {
			// Cek ketika username & password benar
			if ($username == $row['username'] && $password == $row['password']) {
				session_start();
				$_SESSION['username'] = $username;
				header("Location: index.php?p=beranda");
			// Cek ketika password salah
			}elseif($username == $row['username'] && $password != $row['password']){
				echo "
				<script>
					alert('Password Anda salah. Silahkan coba lagi!')
					window.location.href = 'login.php';
				</script>";
		   }
		   //End Validasi Login
		}
	}else{
		// Cek ketika data query berdasarkan username tidak ada / username tidak terdaftar
       echo "
			<script>
				alert('Username Anda salah. Silahkan coba lagi!')
				window.location.href = 'login.php';
			</script>";
    }
   
?>