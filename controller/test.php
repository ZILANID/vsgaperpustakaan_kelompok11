<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th width="1%">No</th>
            <th>ID Buku</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        include'../config_db.php';

        $keyword="";
        if (isset($_POST['search'])) {
            $keyword = $_POST['search'];
        }

        $query = mysqli_query($koneksi,"SELECT * FROM tbbuku WHERE judul_buku LIKE '%".$keyword."%'");
        $hitung_data = mysqli_num_rows($query);
        if ($hitung_data > 0) {
            while ($data = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['id_buku']; ?></td>
                    <td><?php echo $data['judul_buku']; ?></td>
                    <td><?php echo $data['penulis']; ?></td>
                </tr>
            <?php } } else { ?> 
                <tr>
                    <td colspan='4' class="text-center">Tidak ada data ditemukan</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>