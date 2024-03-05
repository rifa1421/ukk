<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script>
        alert('Anda belum login');
        location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Galeri Foto</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
      <div class="navbar-nav me-auto">
        <a href="album.php" class="nav-link">Album</a>
      </div>
   
      <a herf=".../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
    </div>
  </div>
</nav>

<div class="container">
   <div class="row">
    <div class="col-md-4">
       <div class="card mt-2">
         <div class="card-header">Tambah Album</div>
         <div class="card-body">
            <form action="../config/aksi_album.php" method="post">
              <label class="form-label">Nama Album</label>
              <input type="text" name="namaalbum" class="form-control" required>
              <label class="form-label">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" required></textarea>
               <button type="submit" class="btn btn-primary mt-2" name="tambah">Tambah Data</button>
            </form>
         </div>
       </div>
    </div>

    <div class="col-md-8">
     <div class="card mt-2">
      <div class="card-header">Data Album</div>
        <div class="card-body">
         <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Nama Album</th>
                <th>Deskripsi</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>    
            </thead>
            <tbody>
               <?php
               $no = 1;
               $userid = $_SESSION['userid'];
               $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
               while($data = mysqli_fetch_array($sql)){
               ?> 

                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['namaalbum'] ?></td>
                    <td><?php echo $data['deskripsi'] ?></td>
                    <td><?php echo $data['tanggaldibuat'] ?></td>
                    <td>
<a href="#"data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid'] ?>">h</a>

                        <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../config/aksi_album.php" method="POST">
                                                                <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                                Apakah anda yakin akan menghapus data <strong><?php $data['namaalbum'] ?></strong>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<a   href="#" data-bs-toggle="modal"
                            data-bs-target="#edit<?php echo $data['albumid'] ?>"><i
                                class="fa-regular fa-comment"></i>K</a>

                                          <!-- Modal -->
                                      
                                            <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../config/aksi_album.php" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                                <label class="form-label">Nama Album</label>
                                                                <input type="text" name="namaalbum" value="<?php echo $data['namaalbum'] ?>" class="form-control" required>
                                                                <label class="form-label">Deskripsi</label>
                                                                <textarea name="deskripsi" class="form-control" required><?php echo $data['deskripsi'] ?></textarea>

                                                                
                                                        <div class="modal-footer">
                                                            <button type="submit" name="edit" class="btn btn-warning">Edit
                                                                Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

</td>



                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
      </div>
     </div>
    </div>
   </div> 
</div>



<footer class="d-flex justify-content-center border top mt-3 bg-light fixed-bottom">
    <p>&copy; UKK RPL 2024 | Lisha Amalia</p>
    </footer>


     <script src="../assets/js/bootstrap.min.js"></script>
    

</body>
</html>