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
$pdo = new PDO("mysql:host=localhost;dbname=amalkita", "root", "");
$query = "select * from panti";
$d = DB::query('SELECT * FROM panti');
$pemberitahuan = '';
if (isset($_POST['delete'])) {
    if (!empty($_POST['idpanti'])) {
        $idpanti = $_POST['idpanti'];
        foreach ($idpanti as $loopidpanti) {
            $susunanpengurus = DB::query('SELECT susunanpengurus FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[0]['susunanpengurus'];
            unlink('../datapanti/susunanpengurus/' . $susunanpengurus);
            $aktanotaris = DB::query('SELECT aktanotaris FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[0]['aktanotaris'];
            unlink('../datapanti/aktanotaris/' . $aktanotaris);
            $max = DB::query('SELECT COUNT(id) FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[0][0];
            $no = 0;
            while ($no < $max) {
                if ($no == 0) {
                    $idgambar = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[$no]['id'];
                    $gambar = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $loopidpanti, ':idgambar' => $idgambar))[0]['gambar'];
                } else if ($no == 1) {
                    $idgambar1 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[$no]['id'];
                    $gambar1 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $loopidpanti, ':idgambar' => $idgambar1))[0]['gambar'];
                } else if ($no == 2) {
                    $idgambar2 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[$no]['id'];
                    $gambar2 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $loopidpanti, ':idgambar' => $idgambar2))[0]['gambar'];
                } else if ($no == 3) {
                    $idgambar3 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[$no]['id'];
                    $gambar3 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $loopidpanti, ':idgambar' => $idgambar3))[0]['gambar'];
                } else if ($no == 4) {
                    $idgambar4 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[$no]['id'];
                    $gambar4 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $loopidpanti, ':idgambar' => $idgambar4))[0]['gambar'];
                } else if ($no == 5) {
                    $idgambar5 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti))[$no]['id'];
                    $gambar5 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $loopidpanti, ':idgambar' => $idgambar5))[0]['gambar'];
                }
                $no += 1;
            }
            unlink('../datapanti/gambar/' . $gambar);
            unlink('../datapanti/gambar1/' . $gambar1);
            unlink('../datapanti/gambar2/' . $gambar2);
            unlink('../datapanti/gambar3/' . $gambar3);
            unlink('../datapanti/gambar4/' . $gambar4);
            unlink('../datapanti/gambar5/' . $gambar5);
        }
        DB::query("DELETE FROM gambar WHERE idpanti IN(" . implode(",", $idpanti) . ")");
        DB::query("DELETE FROM transaksipanti WHERE idpanti IN(" . implode(",", $idpanti) . ")");
        DB::query("DELETE FROM panti WHERE idpanti IN(" . implode(",", $idpanti) . ")");
        $pemberitahuan = "Data Berhasil Di Hapus!";
        header("location: data-panti-asuhan-admin.php");
    } else {
        $pemberitahuan = "Tidak Ada Data Yang Dipilih!";
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
                                <span><a href="beranda-admin.php">Beranda</a> > Data Panti</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="bgdata-panti-asuhan-admin">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col judul-admin">
                                                <div>
                                                    <form method="post" action="data-panti-asuhan-admin.php">
                                                        <span class="text-laporan">
                                                            Data Panti Asuhan
                                                        </span>
                                                        <hr class="hr5">
                                                        <span class="text-penjelas-laporan">
                                                            Berikut adalah data panti yang telah terdaftar.
                                                        </span>
                                                </div>
                                                <span class="pemberitahuan"><?php echo $pemberitahuan; ?></span>
                                            </div>
                                        </div>

                                        <!-- TEMPAT PEMBERITAHUAN -->
                                        <div class="row">
                                            <div class="col table-admin">
                                                <div class="CRUD">
                                                    <input class="bt-delete" type="submit" name="delete" value="Hapus" onclick="return confirm('Are you sure?')" />
                                                </div>
                                                <table class="table-admin">
                                                    <tr>
                                                        <th></th>
                                                        <th>No</th>
                                                        <th>Nama Panti Asuhan</th>
                                                        <th>Lokasi</th>
                                                        <th>No Telepon</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                    <?php $i = 1;
                                                    foreach ($d as $data) {
                                                    ?>
                                                        <tr>
                                                            <td><input type="checkbox" class="check-item" name="idpanti[]" value="<?php echo $data['idpanti']; ?>"></td>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $data['panti']; ?></td>
                                                            <td><?php echo $data['alamat']; ?></td>
                                                            <td><?php echo $data['notelp']; ?></td>
                                                            <td><a class="detail" href="detail-data-panti-asuhan-admin.php?idpanti=<?php echo $data['idpanti']; ?>">Detail</a></td>
                                                        </tr>
                                                    <?php $i++;
                                                    }
                                                    ?>
                                                </table>
                                            </div>
                                            </form>
                                        </div>
                                        <div class="row">
                                            <div class="col btdaftar-admin">
                                                <span class="btdaftar-panti-admin"><a href="verifikasi-data-panti-asuhan.php">Verifikasi Panti</a></span>
                                                <span class="btdaftar-panti-admin"><a href="pendaftaran-panti-admin.php">Daftar Panti</a></span>
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