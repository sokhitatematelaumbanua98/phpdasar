<?php

session_start();
if(!isset($_SESSION["login"])){

    header("Location: login.php");
    exit;

}

require 'functions.php';

//MENGAMBIL DATA DARU URL
$id = $_GET["id"];
//Queri data barang sesuai dengan id
$barang = query("SELECT * FROM barangmasuk WHERE id   = $id")[0];




// cek apakah tombol submit sudah di tekan atau belum
if (isset($_POST["submit"])) {


    // APAKAH DATA BERHASI DI UBAH
    if (ubah($_POST) > 0) {
        echo " 
  <script>
  alert('Data Berhasil Di Ubah');
  document.location.href ='index.php';
  </script>
  
  ";
    } else {
        echo "
    <script>
    alert('Data Gagal Di Ubah');
    document.location.href ='index.php';
    </script>
    
    ";
    }
}



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Halaman Admin</title>
</head>

<body>

    <div class="container">
        <h1 class="mt-5">Ubah Data Barang</h1>
        <a href="index.php" class="btn btn-danger mt-3">Kembali</a>
        <form action="" method="POST" enctype="multipart/form-data" class="mt-3">

            <input type="hidden" name="id" value="<?= $barang["id"]?>">
            <input type="hidden" name="gambarlama" value="<?= $barang["foto"]?>">



            <div class="mb-3">
                <label for="kode" class="form-label">Kode Barang </label>
                <input type="text" name="kode" class="form-control" id="kode" required autocomplete="off" value="<?= $barang["kode"] ?>">

            </div>


            <div class="mb-3">
                <label fo--r="nama" class="form-label">Nama Barang </label>
                <input type="text" name="nama" class="form-control" id="nama" autocomplete="off" required value="<?= $barang["nama"] ?>">

            </div>

            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah </label>
                <input type="text" name="jumlah" class="form-control" id="jumlah" autocomplete="off" required value="<?= $barang["jumlah"] ?>">

            </div>


            
            <div class="mb-3">
                <label for="lantai" class="form-label">Lantai</label>
                <input type="text" name="lantai" class="form-control" id="lantai" autocomplete="off" required value="<?= $barang["lantai"] ?>">

            </div>
            <div class="mb-3">
                <label for="tgl" class="form-label">Tanggal </label>
                <input type="date" name="tgl" class="form-control" id="tgl" required value="<?= $barang["tgl"] ?>">

            </div>

           
            <div class="mb-3">
                <label for="foto" class="form-label">Foto </label> <br>
                <img src="img/<?= $barang["foto"]?>" style="width:60px" >
                <input type="file" name="foto" class="form-control mt-3" id="foto">

            </div>

            <button type="submit" name="submit" class="btn btn-primary">Ubah</button>

        </form>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

</body>

</html>