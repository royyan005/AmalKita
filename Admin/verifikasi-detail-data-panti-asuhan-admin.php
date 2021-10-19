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

$idpanti = $_GET['idpanti'];
$panti = DB::query('SELECT panti FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['panti'];
$jmlhpenghuni = DB::query('SELECT jmlhpenghuni FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['jmlhpenghuni'];
$namakontak = DB::query('SELECT namakontak FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['namakontak'];
$notelp = DB::query('SELECT notelp FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['notelp'];
$bank = DB::query('SELECT bank FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['bank'];
$namapemilikbank = DB::query('SELECT namarekening FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['namarekening'];
$rekening = DB::query('SELECT norekening FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['norekening'];
$alamat = DB::query('SELECT alamat FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['alamat'];
$idkelurahan = DB::query('SELECT kelurahan FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kelurahan'];
$kelurahan = DB::query('SELECT nama FROM kelurahan WHERE id_kel=:idkelurahan', array(':idkelurahan' => $idkelurahan))[0]['nama'];
$idkecamatan = DB::query('SELECT kecamatan FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kecamatan'];
$kecamatan = DB::query('SELECT nama FROM kecamatan WHERE id_kec=:idkecamatan', array(':idkecamatan' => $idkecamatan))[0]['nama'];
$idkabupaten = DB::query('SELECT kabupaten FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kabupaten'];
$kabupaten = DB::query('SELECT nama FROM kabupaten WHERE id_kab=:idkabupaten', array(':idkabupaten' => $idkabupaten))[0]['nama'];
$idprovinsi = DB::query('SELECT provinsi FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['provinsi'];
$provinsi = DB::query('SELECT nama FROM kabupaten WHERE id_prov=:idprovinsi', array(':idprovinsi' => $idprovinsi))[0]['nama'];
$kodepos = DB::query('SELECT kodepos FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kodepos'];
$deskripsi = DB::query('SELECT deskripsi FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['deskripsi'];
$susunanpengurus = DB::query('SELECT susunanpengurus FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['susunanpengurus'];
$susunanpengurusExt = explode('.', $susunanpengurus);
$susunanpengurusExtNew = strtolower(end($susunanpengurusExt));
$aktanotaris = DB::query('SELECT aktanotaris FROM verifikasipanti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['aktanotaris'];
$aktanotarisExt = explode('.', $aktanotaris);
$aktanotarisExtNew = strtolower(end($aktanotarisExt));

$max = DB::query('SELECT COUNT(id) FROM verifikasigambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0][0];
$no = 0;
$gambar = $gambar1 = $gambar2 = $gambar3 = $gambar4 = $gambar5 = 'no_file.png';
while ($no < $max) {
    if ($no == 0) {
        $idgambar = DB::query('SELECT id FROM verifikasigambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
        $gambar = DB::query('SELECT gambar FROM verifikasigambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar))[0]['gambar'];
    } else if ($no == 1) {
        $idgambar1 = DB::query('SELECT id FROM verifikasigambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
        $gambar1 = DB::query('SELECT gambar FROM verifikasigambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar1))[0]['gambar'];
    } else if ($no == 2) {
        $idgambar2 = DB::query('SELECT id FROM verifikasigambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
        $gambar2 = DB::query('SELECT gambar FROM verifikasigambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar2))[0]['gambar'];
    } else if ($no == 3) {
        $idgambar3 = DB::query('SELECT id FROM verifikasigambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
        $gambar3 = DB::query('SELECT gambar FROM verifikasigambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar3))[0]['gambar'];
    } else if ($no == 4) {
        $idgambar4 = DB::query('SELECT id FROM verifikasigambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
        $gambar4 = DB::query('SELECT gambar FROM verifikasigambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar4))[0]['gambar'];
    } else if ($no == 5) {
        $idgambar5 = DB::query('SELECT id FROM verifikasigambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
        $gambar5 = DB::query('SELECT gambar FROM verifikasigambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar5))[0]['gambar'];
    }
    $no += 1;
}
$filegambar = array('jpg', 'png', 'jpeg');

if (isset($_POST['tolak'])) {
    header("location: verifikasi-data-panti-asuhan.php");
    unlink('../dataverifikasipanti/susunanpengurus/' . $susunanpengurus);
    unlink('../dataverifikasipanti/aktanotaris/' . $aktanotaris);
    if ($max > 0) {
        unlink('../dataverifikasipanti/gambar/' . $gambar);
    }
    if ($max > 1) {
        unlink('../dataverifikasipanti/gambar1/' . $gambar1);
    }
    if ($max > 2) {
        unlink('../dataverifikasipanti/gambar2/' . $gambar2);
    }
    if ($max > 3) {
        unlink('../dataverifikasipanti/gambar3/' . $gambar3);
    }
    if ($max > 4) {
        unlink('../dataverifikasipanti/gambar4/' . $gambar4);
    }
    if ($max > 5) {
        unlink('../dataverifikasipanti/gambar5/' . $gambar5);
    }
    DB::query("DELETE FROM verifikasigambar WHERE idpanti=:idpanti", array(':idpanti' => $idpanti));
    DB::query("DELETE FROM verifikasipanti WHERE idpanti=:idpanti", array(':idpanti' => $idpanti));
}

if (isset($_POST['terima'])) {
    DB::query(
        'INSERT INTO panti VALUES (\'\', :panti, :deskripsi, :jmlhpenghuni, :namakontak, :notelp, :bank, :namapemilikrekening, :rekening, :susunanpengurus, :aktanotaris, :provinsi, :kabupaten, :kecamatan, :kelurahan, :alamat, :kodepos)',
        array(':panti' => $panti, ':deskripsi' => $deskripsi, ':jmlhpenghuni' => $jmlhpenghuni, ':namakontak' => $namakontak, ':notelp' => $notelp, ':bank' => $bank, ':namapemilikrekening' => $namapemilikbank, ':rekening' => $rekening, ':susunanpengurus' => $susunanpengurus, ':aktanotaris' => $aktanotaris, ':provinsi' => $idprovinsi, ':kabupaten' => $idkabupaten, ':kecamatan' => $idkecamatan, ':kelurahan' => $idkelurahan, ':alamat' => $alamat, ':kecamatan' => $idkecamatan, ':kodepos' => $kodepos)
    );
    $idpantibaru = DB::query('SELECT idpanti FROM panti WHERE panti=:panti', array(':panti' => $panti))[0]['idpanti'];
    if ($max > 0) {
        DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpantibaru, ':gambar' => $gambar));
        rename("../dataverifikasipanti/gambar/" . $gambar, "../datapanti/gambar/" . $gambar);
    }
    if ($max > 1) {
        DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpantibaru, ':gambar' => $gambar1));
        rename("../dataverifikasipanti/gambar1/" . $gambar1, "../datapanti/gambar1/" . $gambar1);
    }
    if ($max > 2) {
        DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpantibaru, ':gambar' => $gambar2));
        rename("../dataverifikasipanti/gambar2/" . $gambar2, "../datapanti/gambar2/" . $gambar2);
    }
    if ($max > 3) {
        DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpantibaru, ':gambar' => $gambar3));
        rename("../dataverifikasipanti/gambar3/" . $gambar3, "../datapanti/gambar3/" . $gambar3);
    }
    if ($max > 4) {
        DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpantibaru, ':gambar' => $gambar4));
        rename("../dataverifikasipanti/gambar4/" . $gambar4, "../datapanti/gambar4/" . $gambar4);
    }
    if ($max > 5) {
        DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpantibaru, ':gambar' => $gambar5));
        rename("../dataverifikasipanti/gambar5/" . $gambar5, "../datapanti/gambar5/" . $gambar5);
    }
    rename("../dataverifikasipanti/susunanpengurus/" . $susunanpengurus, "../datapanti/susunanpengurus/" . $susunanpengurus);
    rename("../dataverifikasipanti/aktanotaris/" . $aktanotaris, "../datapanti/aktanotaris/" . $aktanotaris);
    DB::query("DELETE FROM verifikasigambar WHERE idpanti=:idpanti", array(':idpanti' => $idpanti));
    DB::query("DELETE FROM verifikasipanti WHERE idpanti=:idpanti", array(':idpanti' => $idpanti));
    header("location: verifikasi-data-panti-asuhan.php");
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
                                <span><a href="beranda-admin.php">Beranda</a> > <a href="data-panti-asuhan-admin.php">Data Panti</a> > Daftar Panti Asuhan</span>
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
                                                        Daftar Panti Asuhan
                                                    </span>
                                                    <hr class="hr5">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <form action="" class="form-isi-data-panti" method="post">
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-home"></i>&nbsp;&nbsp;Nama Panti Asuhan</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $panti; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Jumlah Penghuni Panti Asuhan</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $jmlhpenghuni; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Nama Kontak</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $namakontak; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;No Telepon</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $notelp; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Nama Bank</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $bank; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Nama Pemilik Bank</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $namapemilikbank; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-credit-card"></i>&nbsp;&nbsp;Rekening</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $rekening; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Alamat</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $alamat; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kelurahan</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $kelurahan; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kecamatan</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $kecamatan; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kabupaten/Kota</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $kabupaten; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Provinsi</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $provinsi; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kode Pos</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $kodepos; ?>
                                                    </span>
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-unlock"></i>&nbsp;&nbsp;Deskripsi Panti Asuhan</label>
                                                    <span class="input-isi-data-panti">
                                                        <?php echo $deskripsi; ?>
                                                    </span>

                                                    <!-- GAMBAR AKTANOTARIS -->
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Akta Notaris</label>
                                                    <div class="row gatauapaan">
                                                        <div class="linkgambar">
                                                            <a style="text-decoration: none;" href="../dataverifikasipanti/aktanotaris/<?php echo $aktanotaris; ?>" target="_blank">
                                                                <img src="
                                                                        <?php
                                                                        if (in_array($aktanotarisExtNew, $filegambar)) {
                                                                            echo '../dataverifikasipanti/aktanotaris/' . $aktanotaris;
                                                                        } else {
                                                                            echo 'assets/pdf.png';
                                                                        }
                                                                        ?>" style="width: 8vw;">
                                                                <div class="aktapdf">
                                                                    <?php if (!(in_array($aktanotarisExtNew, $filegambar))) {
                                                                        echo $aktanotaris;
                                                                    } ?>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <!-- ------------------------- -->


                                                    <!-- GAMBAR SUSUNAN PENGURUS -->
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Susunan Pengurusan Panti Asuhan</label>
                                                    <div class="row gatauapaan">
                                                        <div class="linkgambar">
                                                            <a style="text-decoration: none;" href=../dataverifikasipanti/susunanpengurus/<?php echo $susunanpengurus; ?> target="_blank">
                                                                <img src="
                                                                        <?php
                                                                        if (in_array($susunanpengurusExtNew, $filegambar)) {
                                                                            echo '../dataverifikasipanti/susunanpengurus/' . $susunanpengurus;
                                                                        } else {
                                                                            echo 'assets/pdf.png';
                                                                        }
                                                                        ?>" style="width:8vw;">
                                                                <div class="susunanpdf">
                                                                    <?php if (!(in_array($susunanpengurusExtNew, $filegambar))) {
                                                                        echo $susunanpengurus;
                                                                    } ?>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <!-- ------------------------- -->

                                                    <!-- Gambar 1-6 -->
                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Gambar Panti Asuhan</label>
                                                    <div class="row">
                                                        <?php if ($max > 0) { ?>
                                                            <div class="col nofile">
                                                                <a href="../dataverifikasipanti/gambar/<?php echo $gambar; ?>" target="_blank">
                                                                    <img src="<?php if (!empty($gambar)) {
                                                                                    echo '../dataverifikasipanti/gambar/' . $gambar;
                                                                                } else {
                                                                                    echo 'assets/no_file.png';
                                                                                } ?>" style="width:15vw;">
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($max > 1) { ?>
                                                            <div class="col nofile">
                                                                <a href="../dataverifikasipanti/gambar1/<?php echo $gambar1; ?>" target="_blank">
                                                                    <img src="<?php if (!empty($gambar1)) {
                                                                                    echo '../dataverifikasipanti/gambar1/' . $gambar1;
                                                                                } else {
                                                                                    echo 'assets/no_file.png';
                                                                                } ?>" style="width:15vw;">
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                        <?php if ($max > 2) { ?>
                                                            <div class="col nofile">
                                                                <a href="../dataverifikasipanti/gambar2/<?php echo $gambar2; ?>" target="_blank">
                                                                    <img src="<?php if (!empty($gambar2)) {
                                                                                    echo '../dataverifikasipanti/gambar2/' . $gambar2;
                                                                                } else {
                                                                                    echo 'assets/no_file.png';
                                                                                } ?>" style="width:15vw;">
                                                                </a>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <?php if ($max > 3) { ?>
                                                        <div class="row mt-5">
                                                            <div class="col nofile">
                                                                <a href="../dataverifikasipanti/gambar3/<?php echo $gambar3; ?>" target="_blank">
                                                                    <img src="<?php if (!empty($gambar3)) {
                                                                                    echo '../dataverifikasipanti/gambar3/' . $gambar3;
                                                                                } else {
                                                                                    echo 'assets/no_file.png';
                                                                                } ?>" style="width:15vw;">
                                                                </a>
                                                            </div>

                                                        <?php if ($max <= 4) {
                                                            echo '</div>';
                                                        }
                                                    } ?>
                                                        <?php if ($max > 4) { ?>
                                                            <div class="col nofile">
                                                                <a href="../dataverifikasipanti/gambar4/<?php echo $gambar4; ?>" target="_blank">
                                                                    <img src="<?php if (!empty($gambar4)) {
                                                                                    echo '../dataverifikasipanti/gambar4/' . $gambar4;
                                                                                } else {
                                                                                    echo 'assets/no_file.png';
                                                                                } ?>" style="width:15vw;">
                                                                </a>
                                                            </div>
                                                        <?php if ($max <= 5) {
                                                                echo '</div>';
                                                            }
                                                        } ?>
                                                        <?php if ($max > 5) { ?>
                                                            <div class="col nofile">
                                                                <a href="../dataverifikasipanti/gambar5/<?php echo $gambar5; ?>" target="_blank">
                                                                    <img src="<?php if (!empty($gambar5)) {
                                                                                    echo '../dataverifikasipanti/gambar5/' . $gambar5;
                                                                                } else {
                                                                                    echo 'assets/no_file.png';
                                                                                } ?>" style="width:15vw;">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="text-verifikasi">Apakah anda ingin memverifikasi data panti asuhan ini ?</div>
                                                    <span class="bt-verifikasi">
                                                        <input class="bt-daftar-admin" type="submit" name="terima" value="Terima">
                                                        <input class="bt-tolak-admin" type="submit" name="tolak" value="Tolak">
                                                    </span>
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