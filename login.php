<?php

require  'functions.php';
session_start();
//INI UNTUK COOKIE
if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {

    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // CEK COOKIE DAN USERNAME
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    };
}
// ============
//INI UNTUK SESSION




if (isset($_SESSION["login"])) {

    header("Location: index.php");
    exit;
}

// cek jika regitrasi sudah di tekan

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    //UNTUK MENGECEK APAKAH USERNAME ADA YANG SAMA DIDALM DATABASE
    $result = mysqli_query($conn, "SELECT *FROM users WHERE username = '$username'");

    // untuk mengecek berapak baris di dalam query SELECT * FROM user

    if (mysqli_num_rows($result) === 1) {
        // cek password 
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])); // kebalikan dari pasword hash kebalikan dari hash

        {

            // SET SESSION

            $_SESSION["login"] = true;

            // CEK REMEMBER ME ATAU INGAT SAYA

            if (isset($_POST["remember"])) {

                // UNTUK MEMBUAT COOCKINYA

                setcookie('id', $row['id'], time() + 60);

                // COOKIE USERNAME ENSKRIPSI BIAR GK BISA DI HEAKER
                setcookie('key', hash('sha256', $row['username']), time() + 60);
            }

            header("Location: index.php");
            exit;
        }
    }
    $error = true;
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
    <title>Halama Login</title>
</head>

<body>
    <div class="form-box">
        <h2>Halaman Login</h2>

        <?php if (isset($error)) : ?>
            <p style="color: red ; font-style:italic ;">Username dan Password Anda Salah </p>
        <?php endif; ?>



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


            <div class="checkbox">
                <input type="checkbox" class="form-check-input" name="remember" id="check">
                <label for="check" class="form-check-input">Rember Me</label>

            </div>

            <button type="submit" id="login" name="login" class="login-btn">Login</button>
        </form>
    </div>
    <script src="js/script.js"></script>

</body>

</html>