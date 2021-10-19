<?php
include("../class/DB.php");


if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  if (DB::query('SELECT username FROM admin WHERE username=:username', array(':username'=>$username))) {

          if(password_verify($password,DB::query('SELECT password FROM admin WHERE username=:username', array(':username'=>$username))[0]['password'])) {
              echo "<script>window.location ='logout.php'</script>";
              
              $cstrong = True;
              $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong)) ;
              $idadmin = DB::query('SELECT idadmin FROM admin WHERE username=:username', array(':username'=>$username))[0]['idadmin'];
              DB::query('INSERT INTO logintoken VALUES (\'\', :token, :idadmin)', array(':token'=>sha1($token), ':idadmin'=>$idadmin));

              setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
              setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
         
              header("location: beranda-admin.php");
          } else {
              echo "Incorrect Password !!";
          }

  } else {
      echo "Username Belum Terdaftar !!";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmalKita</title>
    <link rel="stylesheet" href="vendor/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/js/bootstrap.min.js">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/admin.css">
    <script src="https://kit.fontawesome.com/386e6055da.js" crossorigin="anonymous"></script>
</head>
<body>
    <section class="login-admin">
        <div class="bg-login-admin">
            <div class="container-fluid">
                <div class="judul-login-admin">
                    <span>LOGIN</span>
                </div>
                <hr class="hr4">
                <div class="form-login">
                    <form class="form-login-admin" action="login-admin.php" method="post">
                        <input class="input-login-admin" type="text" name="username" placeholder="Username">
                        <input class="input-login-admin" type="password" name="password" placeholder="Password">
                        <input class="bt-login-admin" type="submit" name="login" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="copyright">
            <div class="container-fluid">
                <div class="row">
                    <div class="col d-flex justify-content-center">
                        <p>© AmalKita 2021. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
</body>
</html>