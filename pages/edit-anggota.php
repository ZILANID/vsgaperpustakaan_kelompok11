<?php
	$id_anggota=$_GET['id'];
	$q_tampil_anggota=mysqli_query($koneksi,"SELECT * FROM tbanggota WHERE id_anggota='$id_anggota'");
	$r_tampil_anggota=mysqli_fetch_array($q_tampil_anggota);
	if(empty($r_tampil_anggota['foto'])or($r_tampil_anggota['foto']=='-'))
				$foto = "default.jpg";
			else
				$foto = $r_tampil_anggota['foto'];
?>

 <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
				
				<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">

<div id="label-page"><h3>Edit Data Anggota</h3></div>
<div id="content">
	<form action="proses/edit-anggota-action.php" method="post" enctype="multipart/form-data">
	<table id="tabel-input">
		
		<div class="form-group row">
            <label for="foto" class="col-sm-3 col-form-label">Foto</label>
			<div class="col-sm-2">
				<img src="asset/anggota/<?php echo $foto; ?>" width=70px height=75px>
			</div>
            <div class="col-sm-6">
                <div class="input-group">
					<input type="file" id="foto" name="foto" class="form-control">
					<input type="hidden" name="foto_awal" value="<?php echo $r_tampil_anggota['foto']; ?>">
					<div class="input-group-append">
						<button class="btn btn-sm btn-primary" type="button">Pilih</button>
					</div>
				</div>
            </div>
        </div>
		
		<div class="form-group row">
            <label for="id_anggota" class="col-sm-3 col-form-label">ID Anggota</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="id_anggota" name="id_anggota" value="<?php echo $r_tampil_anggota['id_anggota']; ?>" readonly="readonly">
                </div>
        </div>
		
		<div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama Anggota</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $r_tampil_anggota['nama']; ?>">
                </div>
        </div>
		
		<div class="form-group row">
            <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-9">
					
					<?php
						if($r_tampil_anggota['jenis_kelamin']=="Pria")
						{
							echo " 
								<div class='form-check form-check-primary'>
									<label class='form-check-label'>
										<input type='checkbox' id='jenis_kelamin' name='jenis_kelamin' class='form-check-input' value='Pria' checked> Pria
									</label>
								</div>
								<div class='form-check form-check-primary'>
									<label class='form-check-label'>
										<input type='checkbox' id='jenis_kelamin' name='jenis_kelamin' class='form-check-input' value='Wanita'> Wanita
									</label>
								</div>";
						}
						elseif($r_tampil_anggota['jenis_kelamin']=="Wanita")
						{
							echo "
								<div class='form-check form-check-primary'>
									<label class='form-check-label'>
										<input type='checkbox' id='jenis_kelamin' name='jenis_kelamin' class='form-check-input' value='Pria'> Pria
									</label>
								</div>
								<div class='form-check form-check-primary'>
									<label class='form-check-label'>
										<input type='checkbox' id='jenis_kelamin' name='jenis_kelamin' class='form-check-input' value='Wanita' checked> Wanita
									</label>
								</div>";
					
						}
					?>
				<input type="hidden" name="jenis_kelamin" value="<?php echo $r_tampil_anggota['jenis_kelamin']; ?>" class="isian-formulir isian-formulir-border"></td>
			    </div>
		</div>
				
		<div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Alamat</label>
            <div class="col-sm-9">
				<textarea rows="2" cols="40" id="alamat" name="alamat" class="isian-formulir isian-formulir-border"><?php echo $r_tampil_anggota['alamat']; ?></textarea>
            </div>
        </div>
		
		<div class="form-group row">	
			<input type="submit" name="simpan" value="Simpan" class="btn btn-md btn-outline-primary btn-icon-text">
        </div>

	</table>
	</form>
</div>

</div>
		</div>
		</div>

				</div>
			</div>
		</div>
	</div>
</div>