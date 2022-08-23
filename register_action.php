<?php 
  
session_start();
include 'config_db.php';
 
//error_reporting(0);

 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
}
 
//if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $level = $_POST['level'];
	
			
 
    if ($password == $cpassword) {
        $sql = "SELECT * FROM tbuser WHERE email='".$email."'";
        $result = mysqli_query($koneksi, $sql);
        if (!$result->num_rows > 0) {
			
			// Check ID data terakhir
			$checkid = "SELECT max(id_user)+1 as maks_id FROM tbuser";
			$hasilcheckid = mysqli_query($koneksi, $checkid);
			while($row = mysqli_fetch_array($hasilcheckid))
			  {
				$maks_id = $row['maks_id'];
			  }
			// End Check ID data terakhir 
			
			// Mulai Insert Data
            $sql = "INSERT INTO tbuser (id_user,username, email, password, level)
                    VALUES ('$maks_id','$username', '$email', '$password', '$level')";
            $result = mysqli_query($koneksi, $sql);
            if ($result) {
                $username = "";
                $email = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
				 echo "<script>
							alert('Selamat, registrasi berhasil!')
							window.location.href = 'login.php';
						</script>";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan sistem, hubungi administrator.')
				window.location.href = 'login.php';</script>";
            }
			// End Insert Data
        } else {
				 echo "<script>
							alert('Woops! Email Sudah Terdaftar sebelumnya, silahkan login.')
							window.location.href = 'login.php';
						</script>";
        }
         
    } else {
        echo "<script>
				alert('Password Tidak Sama, Yuk Cek Lagi!')
				history.back();
			  </script>";
    }
//}
 
?>