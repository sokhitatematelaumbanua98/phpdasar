<?php 
session_start();
if(!isset($_SESSION["login"])){

    header("Location: login.php");
    exit;

}
require 'functions.php';
$id = $_GET["id"];

if(delete($id) > 0 ){
    // APAKAH DATA BERHASI DI HAPUS
    echo " 
  <script>
  alert('Data Berhasil Dihapus');
  document.location.href ='index.php';
  </script>
  
  ";
}else{
    echo " 
  <script>
  alert('Data Gagal Hapsu');
  document.location.href ='index.php';
  </script>
  
  ";
}


?>