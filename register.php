<?php
error_reporting(0);
?>
 


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://kit.fontawesome.com/6baec8d48e.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="skydash/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="skydash/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<title>Register - Sistem Perpustakaan Online</title>
</head>

<style>
.divider:after,
.divider:before {
content: "";
flex: 1;
height: 1px;
background: #eee;
}
.h-custom {
height: calc(100% - 73px);
}
@media (max-width: 450px) {
.h-custom {
height: 100%;
}
}
</style>
<body>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Register</p>

                <form class="mx-1 mx-md-4" action="register_action.php" method="POST">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" name="username" id="form3Example1c" class="form-control" required/>
                      <label class="form-label" for="form3Example1c">Username</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" name="email" id="form3Example3c" class="form-control" required/>
                      <label class="form-label" for="form3Example3c">Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" name="password" id="form3Example4c" class="form-control" required/>
                      <label class="form-label" for="form3Example4c">Password</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" name="cpassword" id="form3Example4cd" class="form-control" required/>
                      <label class="form-label" for="form3Example4cd">confirm password</label>
                    </div>
                  </div>
				  
				   <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <select name="level" class="js-example-basic-single w-100" required>
						<option value="">Pilih level</option>
						<option value="Admin">Admin</option>
						<option value="Anggota">Anggota</option>
					  </select>
                    </div>
                  </div>


                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                      Setuju dengan ketentuan <a href="#!">Terms of service</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
					<button type="submit" class="btn btn-primary btn-lg" name="submit"/><i class="fa fa-btn fa-sign-in"></i> Register
					</button>
                  </div>
					* Sudah punya akun? yuk login <a class="link-primary" href="login.php">disini</a>
                </form>

              </div>
			  
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                <img src="asset/image/library.jpg"
                  class="img-fluid" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- plugins:js -->
  <script src="skydash/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="skydash/vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="skydash/vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="skydash/js/off-canvas.js"></script>
  <script src="skydash/js/hoverable-collapse.js"></script>
  <script src="skydash/js/template.js"></script>
  <script src="skydash/js/settings.js"></script>
  <script src="skydash/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="skydash/js/file-upload.js"></script>
  <script src="skydash/js/typeahead.js"></script>
  <script src="skydash/js/select2.js"></script>
  <!-- End custom js for this page-->
</body>
</html>