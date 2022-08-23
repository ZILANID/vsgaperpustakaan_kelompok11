 <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
				
				<div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
		
		<h4 class="card-title">Input Data Anggota</h4>
		<div id="content">
			<form action="proses/create-anggota-action.php" method="post" enctype="multipart/form-data">
			

					<div class="form-group row">
                    <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                    <div class="col-sm-9">
                        <div class="input-group">
							<input type="file" id="foto" name="foto" class="form-control">
							<div class="input-group-append">
								<button class="btn btn-sm btn-primary" type="button">Pilih</button>
							</div>
						</div>
                    </div>
                    </div>
					
					<div class="form-group row">
                      <label for="id_anggota" class="col-sm-3 col-form-label">ID Anggota</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="id_anggota" name="id_anggota">
                      </div>
                    </div>
					
					<div class="form-group row">
                      <label for="nama" class="col-sm-3 col-form-label">Nama Anggota</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama" name="nama">
                      </div>
                    </div>
					
					<div class="form-group row">
                      <label for="jenis_kelamin" class="col-sm-3 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-9">
						  <div class="form-check form-check-primary">
                            <label class="form-check-label">
                              <input type="checkbox" id="jenis_kelamin" name="jenis_kelamin" value="Pria" class="form-check-input">
                              Pria
                            </label>
                          </div>
						  <div class="form-check form-check-primary">
                            <label class="form-check-label">
                              <input type="checkbox" id="jenis_kelamin" name="jenis_kelamin" value="Wanita" class="form-check-input">
                              Wanita
                            </label>
                          </div>
                      </div>
                    </div>
					
					<div class="form-group row">
                      <label for="nama" class="col-sm-3 col-form-label">Alamat</label>
                      <div class="col-sm-9">
                        <input type="textarea" class="form-control" rows="2" cols="40"  id="alamat" name="alamat">
                      </div>
                    </div>
					
					<div class="form-group row">	
					 <input type="submit" name="simpan" value="Simpan" class="btn btn-md btn-outline-primary btn-icon-text">
                    </div>

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