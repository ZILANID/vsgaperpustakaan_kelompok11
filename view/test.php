
<!doctype html>
  <html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <title>Live Search Data Dengan PHP Dan AJAX</title>
  </head>
  <body>
    <div class="container">
      <div class="card mt-5">
        <div class="card-header">
        Live Search Data Dengan PHP Dan AJAX
       </div>
       <div class="card-body">
        <div class="row">
          <div class="col-md-8"></div>
          <div class="col-md-4">
            <div class="mb-3">
            <input type="text" class="form-control" id="search" name="search" placeholder="Cari disini...">
          </div>
          </div>
        </div>
          <div id="hasil"></div>
        <p class="text-center mt-2"><a href="https://www.belajarwithib.my.id/" target="_blank" style="text-decoration:none;">www.belajarwithib.my.id</a></p>
      </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    load_data();
    function load_data(search){
      $.ajax({
        url:"controller/test.php",
        method:"POST",
        data: {
          search: search
        },
        success:function(data){
          $('#hasil').html(data);
        }
      });
    }
    $('#search').keyup(function(){
      var search = $("#search").val();
      load_data(search);
    });
  });
  </script>
</body>
</html>