
<?php

// KONEKSI KEDATABASE

$conn = mysqli_connect("localhost", "root", "", "anekaria");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
//UNTUK TAMBAH 
// untuk kemanan jangan lupa pengimputan htmlspecialchars
function add($data)
{
    global $conn;
    $kode = htmlspecialchars($data["kode"]);
    $nama = htmlspecialchars($data["nama"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
    $lantai = htmlspecialchars($data["lantai"]);
    $tgl = htmlspecialchars($data["tgl"]);
    


    //UPLOD GAMBAR
    $foto = upload();
    if (!$foto) {

        return false;
    }

    //===================

    $query = ("INSERT INTO barangmasuk
                            VALUES
                            ('', '$kode', '$nama', '$jumlah',  '$lantai', '$tgl', '$foto')
                            
                            ");

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

// UNTUK GAMBAR FUNCTION UPLOAD
function upload()
{

    $namaFiles = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpname = $_FILES['foto']['tmp_name'];


    //UNTUK MENGECEK APAKAH ADA GAMBAR YANG DI UPLOD

    if ($error === 4) {
        echo " 
                    <script>
                        alert('Pilih Photo Terlebih Dahulu');
                    </script>";
        return false;
    }

    //  UNTK  YANG DI UPLOAD HANYA GAMBAR

    $extenseFotoFalid = ['png', 'jpg', 'jpeg'];
    $extensiFoto = explode('.', $namaFiles);
    $extensiFoto = strtolower(end($extensiFoto));
    if (!in_array($extensiFoto,  $extenseFotoFalid)) {
        echo " 
            <script>
                alert('Pilih Photo Tidak Sesuai..!');
            </script>";
        return false;
    }

    // UNTUK MENGECEK KAPASISTAS GAMBAR
    if ($ukuranFile >  1000000) {
        echo " 
            <script>
                alert(' Ukuran Photo Terlalu Besar..!');
            </script>";
        return false;
    }
    // UNTUK MENGECEK GAMBAR SIAP DI UPLAOD
    // jeneret nama file yang berbeda biar gk douber fotonya
    $namaFotoBaru = uniqid();

    $namaFotoBaru .= '.';
    $namaFotoBaru .= $extensiFoto;

    move_uploaded_file($tmpname, 'img/' . $namaFotoBaru);
    return $namaFotoBaru;
}



//UNTUK HAPUS

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barangmasuk WHERE id = $id");
    return mysqli_affected_rows($conn);
}

//UNTUK UBAH DATA
function ubah($data)
{
    global $conn;
    $id = $data["id"];
    $kode = htmlspecialchars($data["kode"]);
    $nama = htmlspecialchars($data["nama"]);
    $jumlah = htmlspecialchars($data["jumlah"]);
   
    $lantai = htmlspecialchars($data["lantai"]);
    $tgl = htmlspecialchars($data["tgl"]);
  
    $gambarlama = htmlspecialchars($data["gambarlama"]);
    // UNTUK MENGECEK JIKA FILE DI PILIH

    if ($_FILES['foto']['error'] === 4) {
        $foto = $gambarlama;
    } else {
        $foto = upload();
    }


    $query = "UPDATE barangmasuk SET
                            kode = '$kode',
                            nama = '$nama', 
                            jumlah = '$jumlah',
                         
                            lantai ='$lantai',
                            tgl = '$tgl', 
                        
                            foto = '$foto'
                            WHERE id = $id;
                            ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

//UNTUK FUNCTION CARI DATA

function cari($keyword)
{
    //Bikin Variabel Baru

    $cari = "SELECT * FROM barangmasuk 
                    WHERE
                    kode LIKE '%$keyword%' OR
                    nama LIKE '%$keyword%' OR
                    jumlah LIKE '%$keyword%' OR
                    tgl LIKE '%$keyword%'
                   
                 ";

    return query($cari); // return queri berasal dari function dari atas
}

// UNTUK REGITRASI


function registrasi($data)
{

    global $conn;

    $username = strtolower( stripslashes($data["username"])) ; // menerima satu paramer yaitu $data

    $password = mysqli_real_escape_string($conn, $data["password"]); // menerima dua paramer yaitu $coon dan $data

    $password2 = mysqli_real_escape_string($conn, $data["password2"]); // menerima dua paramer yaitu $coon dan $data


    // UNTUK MENGECEK JIKA USER SUDAH TERDAFTAR
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

         if(mysqli_fetch_assoc($result)){
            echo " 
            <script>
            alert('Username Sudah Pernah Terdaftar');
           
            </script>";
        return false;
         }
    // cek konfirmasi password apakah sesuai dengan konfirmasi passord

    if ($password !== $password2) {
        echo " 
            <script>
            alert('Konfirmasi Password Tidak Sesuai..!');
           
            </script>";
        return false;
    }
    //enkripsi password

    $password = password_hash($password, PASSWORD_DEFAULT);

    //memasukan data kedalam database

    mysqli_query($conn, "INSERT INTO users
                            VALUES
                            ('', '$username', '$password')
                            
                            ");

    return mysqli_affected_rows($conn);

}
