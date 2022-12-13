
<?php 
require  'functions.php';

// cek jika regitrasi sudah di tekan


if(isset($_POST["register"])){
    if (registrasi($_POST) > 0) {
        echo " 
  <script>
  alert('User Berhasil Di Tambahkan');

  </script>
  
  ";
    } else {
        echo mysqli_error($conn);
    

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Halama Registrasi</title>
</head>
<body>
    <div class="form-box">
        <h2> Registrasi</h2>
        <form action="" method="POST">
            <div class="input-box">
                <i class="fa fa-user"></i>
                <input type="text" id="username" name="username" placeholder="Username">
            </div>


            <div class="input-box">
                <i class="fa fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Password">
                <span class="eye" onclick="myFunctions()">
                    <i id="hide1" class="fa fa-eye-slash"></i>
                    <i id="hide2" class="fa fa-eye-slash"></i>
                </span>
            </div>


            <div class="input-box">
                <i class="fa fa-unlock-alt"></i>
                <input type="password" id="password2" name="password2" placeholder="Konfirmasi Password">
                <span class="eye" onclick="myFunction()">
                    <i id="hide1" class="fa fa-eye-slash"></i>
                    <i id="hide2" class="fa fa-eye-slash"></i>

                </span>
            </div>
            <button type="submit" name="register" class="register-btn">Registrasi</button>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>

</html>