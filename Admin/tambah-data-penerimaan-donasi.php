<?php
include('Login.php');

if (!Login::isLoggedIn()) {
    echo '
    <form action="beranda-admin.php" method="post">
    <input type="submit" name="login" value="login">
    </form>
    ';
    if (isset($_POST['login'])) {
        header("location: login-admin.php");
    }
    die("Belum Login!");
}

if (isset($_POST['confirm'])) {

    if (isset($_POST['alldevices'])) {

        DB::query('DELETE FROM logintoken WHERE idadmin=:idadmin', array(':idadmin' => Login::isLoggedIn()));
    } else {
        if (isset($_COOKIE['SNID'])) {
            DB::query('DELETE FROM logintoken WHERE token=:token', array(':token' => sha1($_COOKIE['SNID'])));
            header("location: login-admin.php");
        }
        setcookie('SNID', '1', time() - 3600);
        setcookie('SNID_', '1', time() - 3600);

        header("location: login-admin.php");
    }
}

$pemberitahuan = $norekeningerr = $jumlaherr = $keteranganerr = '';

if (isset($_POST['terima'])) {
    if (is_numeric($_POST['rekeningasal'])) {
        if (is_numeric($_POST['jumlah'])) {
            if (strlen($_POST['keterangan']) <= 50 && !is_numeric($_POST['keterangan'])) {
                $bank = $_POST['bank'];
                $namarekening = $_POST['namarekening'];
                $rekeningasal = $_POST['rekeningasal'];
                $jumlah = $_POST['jumlah'];
                $keterangan = $_POST['keterangan'];
                $pemberitahuan = "Data Berhasil Di Input!";


                DB::query('INSERT INTO transaksipenerimaan VALUES (\'\', :bank, :namarekening, :rekeningasal, NOW(), :jumlah, :keterangan)',  array(':bank' => $bank, ':namarekening' => $namarekening, ':rekeningasal' => $rekeningasal, ':jumlah' => $jumlah, ':keterangan' => $keterangan));
            } else {
                $pemberitahuan = 'Ada Kesalahan Pada Input!';
                $keteranganerr = 'Keterangan Tidak Boleh Lebih Dari 50 Huruf Dan Tidak Boleh Berupa Angka!';
            }
        } else {
            $pemberitahuan = 'Ada Kesalahan Pada Input!';
            $jumlaherr = 'Jumlah Harus Berupa Angka!';
        }
    } else {
        $pemberitahuan = 'Ada Kesalahan Pada Input!';
        $norekeningerr = 'Nomor Rekening Harus Berupa Angka!';
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
    <section class="admin">
        <div class="bg-admin">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 sidenav">
                        <img class="logo-admin" src="assets/AmalKitaBG2.png" alt="">
                        <a class="menu-sidenav" href="data-panti-asuhan-admin.php">Data Panti</a>
                        <a class="menu-sidenav" href="data-penerimaan-donasi.php"><span>Data Penerimaan Uang</span></a>
                        <a class="menu-sidenav" href="data-penyaluran-donasi.php"><span>Data Penyaluran Uang</span></a>
                        <span>
                            <form action="beranda-admin.php" method="post">
                                <input class="bt-signout" type="submit" name="confirm" value="Keluar Akun">
                            </form>
                        </span>
                    </div>
                    <div class="col-10">
                        <div class="row">
                            <div class="col direktori-admin">
                                <span><a href="beranda-admin.php">Beranda</a> > <a href="data-penerimaan-donasi.php">Data Penerimaan Donasi</a> > Tambah Data Penerimaan Donasi</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="bgdata-panti-asuhan-admin">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col judul-admin">
                                                <div>
                                                    <span class="text-laporan">
                                                        Tambah Data Penerimaan Donasi
                                                    </span>
                                                    <hr class="hr5">
                                                    <div class="pemberitahuan"><?php echo $pemberitahuan; ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col bgform-penerimaan-donasi">
                                                <form class="form-isi-data" action="tambah-data-penerimaan-donasi.php" method="post">
                                                    <select name="bank" id="bank" required>
                                                        <option value="" disabled selected>Pilih BANK</option>
                                                        <option value="BNI">BNI</option>
                                                        <option value="BRI">BRI</option>
                                                        <option value="Mandiri">Mandiri</option>
                                                        <option value="BCA">BCA</option>
                                                    </select>
                                                    <label>Nama Pemilik Rekening</label>
                                                    <input class="input-form-admin" type="text" name="namarekening" value="" placeholder="Nama Pemilik Rekening..." required>
                                                    <label>Nomor Rekening</label>
                                                    <input class="input-form-admin" type="text" name="rekeningasal" value="" placeholder="Nomor Rekening Asal..." required>
                                                    <span class="error"><?php echo $norekeningerr; ?></span>
                                                    <label>Jumlah Donasi Yang DIterima</label>
                                                    <input class="input-form-admin" type="text" name="jumlah" value="" placeholder="Jumlah Donasi Yang Diterima..." required>
                                                    <span class="error"><?php echo $jumlaherr; ?></span>
                                                    <label>Keterangan Laporan</label>
                                                    <input class="input-form-admin" type="text" name="keterangan" value="" placeholder="Keterangan Laporan...." required>
                                                    <span class="error"><?php echo $keteranganerr; ?></span>
                                                    <input class="bt-CRUD" type="submit" name="terima" value="Tambah">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>