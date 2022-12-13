<?php

session_start();
if (!isset($_SESSION["login"])) {

    header("Location: login.php");
    exit;
}

require 'functions.php'; // ini berfungsi sebagai untuk mengkoneksikan file koneksi data base ke index.php

// UNTUK MENGAMBIL DATA DARI TABLE / QUERY DATA tb_barang

$barang = query("SELECT * FROM barangmasuk  ");


// ketika tombol cari di klik

if (isset($_POST["cari"])) {
    // mencari mahasiswa berdasarkan apa yang di masukan 
    $barang = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
    <link rel="stylesheet" href="css/styles.css" />
    <title>Halaman Admin</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">Aneka Ria</div>
            <div class="list-group list-group-flush my-3">



                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-home me-2"></i>Gudang Baru</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-reply  me-2"></i>Barang Keluar</a>
              
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-university me-2"></i>Gudang Lama</a>
             

                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-map-marker-alt me-2"></i>Outlet</a>
                <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
          
          
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0"> <i class="fas fa-share me-2"></i>Barang Masuk Gudang Baru</a></h2>

                </div>
            </nav>

         
            <nav class="navbar navbar-light px-4">

                <a href="tambah.php" class="btn btn-primary btn-tambah "> <i class="fa fa-plus-square mr-2"></i> Tambah Data</a>


            </nav>

            <nav class="navbar navbar-light px-4">

                <form class="d-flex " action="" method="post">
                    <input class="form-control me-2 btn-input" name="keyword" id="keyword" autofocus autocomplete="off" type="search" placeholder="Search" aria-label="Search">
                    <button class=" mb-3" id="tombolcari" name="cari" type="submit"></button>
                </form>
                <img src="img/loadingg.gif" class="loader">
               
            </nav>

              <nav class="navbar navbar-light px-4">

                <a href="print.php" class="btn btn-primary btn-warning btn-tambah " target="_blank"> <i class="fa fa-print me-2" ></i>Print</a>


            </nav>
 
            <!-- ================================================== -->
            <div class="container-fluid px-4  " id="container">
               
                  
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Kode</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Lantai</th>
                                    <th scope="col">Tanggal</th>

                                    <th scope="col">foto</th>
                                    <th scope="col" class="btn-cari">Aksi</th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php $no = 1 ?>
                                <?php foreach ($barang as $cek) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $cek["kode"]; ?></td>
                                        <td><?= $cek["nama"] ?></td>
                                        <td><?= $cek["jumlah"] ?></td>
                                        <td><?= $cek["lantai"] ?></td>
                                        <td><?= $cek["tgl"] ?></td>
                                        <td><img src="img/<?= $cek["foto"] ?>" style="width:30px"></td>
                                        <td class="btn-cari">
                                            <a href="hapus.php?id=<?php echo $cek["id"]; ?>" onclick="return confirm('Yakin Data Di Hapus..?'); "><i class="fa fa-trash  text-danger p-2 rounded btn-lg" data-toggle="tooltip" title="Hapus"></i></a>

                                            <a href="ubah.php?id=<?php echo $cek["id"]; ?>"><i class="fa fa-edit  text-warning p-2 rounded btn-lg" data-toggle="tooltip" title="Edit"></i></a>

                                        </td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>


                            </tbody>
                        </table>
                   
                </div>

        </div>
    </div>
    <!-- ============================================== -->
    <!-- /#page-content-wrapper -->
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
    </script>
   
</body>

</html>