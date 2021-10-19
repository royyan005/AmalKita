<?php
include('class/DB.php');

$d = DB::query('SELECT * FROM transaksipanti');
$htg = DB::query('SELECT SUM(jumlah) AS total FROM transaksipanti');
$total = 0;

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/386e6055da.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav id="navbar2" class="navbar navbar-expand-md fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="beranda.php"><img class="logo1" src="assets/AmalKitaBG2.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span><i class="fas fa-bars fa-xs"></i></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="beranda.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="data-panti.php">Data Panti</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="laporan-penyaluran.php">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="tentang-kami.php">Tentang Kami</a>
                        </li>
                        <li class="nav-item bt-black">
                            <a class="text-nav nav-link" href="donasi.php"><i class="fas fa-wallet"></i>&nbsp; Donasi</a>
                        </li>
                        <li class="nav-item bt-black ">
                            <a class="text-nav nav-link" href="daftar-panti.php"><i class="fas fa-home"></i>&nbsp; Daftarkan Panti</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="laporan-penerimaan">
        <div class="bgataslaporandonasi">
            <div class="container-fluid">
                <div class="row">
                    <div class="col bglogo">
                        <img class="logo2" src="assets/AmalKitaBG.png" alt="">
                    </div>
                </div>
                <div class="row bt-laporan">
                    <div class="col p-0">
                        <a class="bt-penyaluran-donasi-active" href="laporan-penyaluran.php">
                            Penyaluran Donasi
                        </a>
                    </div>
                    <div class="col">
                        <a class="bt-penerimaan-donasi" href="laporan-penerimaan.php">
                            Penerimaan Donasi
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span class="quotebwh"> “Sedekah Saat Berkecukupan Itu Biasa, Akan Tetapi Sedekah Saat Kita Susah Itu Luar Biasa”</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="direktori">
        <div class="bgdirektori">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <span class="tulisandirektori"><a href="beranda.php">Beranda</a> > Laporan</span>
                    </div>
                    <div class="col bt-direktori">
                        <a class="bt-white" href="https://api.whatsapp.com/send?phone=6285801573072" target="_blank"><i class="far fa-flag"></i>&nbsp; Laporkan</a>
                        <button type="button" class="bt-white" data-toggle="modal" data-target="#bagikan"><i class="fas fa-share"></i> &nbsp; Bagikan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tabelpenerimaan">
        <div class="rectangletable">
            <div class="container-fluid">
                <div class="row">
                    <div class="col text-laporan">
                        <div class="judul-laporan">
                            Laporan Penyaluran Donasi
                        </div>
                        <div class="line-laporan">
                        </div>
                        <div class="desc-laporan">
                            Berikut adalah laporan donasi yang telah kami salurkan.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <table class="table-user">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                        </tr>
                        <?php $i = 1;
                        foreach ($d as $data) {  ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php
                                    $nama = DB::query('SELECT panti FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $data['idpanti']))[0]['panti'];
                                    echo $nama; ?></td>
                                <td><?php echo $data['keterangan']; ?></td>
                                <td><?php echo $data['waktu']; ?></td>
                                <td><?php echo "Rp. " . $data['jumlah'] ?></td>
                            </tr>
                        <?php
                            $i++;
                            $total += $data['jumlah'];
                        }
                        ?>
                        <tr id="tfoot">
                            <td id="total-donasi" colspan="4">Total Donasi</td>
                            <td><?php echo "Rp. " . $total ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="bg-footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <img class="white-logo" src="assets/AmalKitaBG.png" alt="">
                        <p class="text-footer1">AmalKita adalah platform digital yang bergerak dalam pemetaan dan
                            penyaluran Donasi kepada Panti Asuhan.</p>
                        <p class="text-footer2"><b>Media Sosial :</b></p>
                        <p class="sosmed"><a target="_blank" href="https://www.instagram.com/amal__kita/"><i class="fab fa-instagram"></i></a> <a target="_blank" href="https://web.facebook.com/AmalKita-100282452140288"><i class="fab fa-facebook"></i></a> <a target="_blank" href="https://api.whatsapp.com/send?phone=6285801573072"><i class="fab fa-whatsapp"></i></a></p>
                    </div>
                    <div class="col-6">
                        <p class="text-footer3">Hubungi Kami</p>
                        <hr class="hr2">
                        <div class="contact-list">
                            <a id="contact" href="mailto: amalkita07@gmail.com"><i class="far fa-envelope"></i>&nbsp; AmalKita@gmail.com</a>
                            <a id="contact" href="https://goo.gl/maps/ZEyyuEHZHhzUtd3t7" target="_blank"><i class="fas fa-map-marker-alt"></i>&nbsp; Bandar Lampung, Lampung</a>
                            <a id="contact" href="tel:+6289636376248"><i class="fas fa-phone-alt"></i>&nbsp; 0896-3637-6248</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

    <!-- Design Pop Up -->
    <div class="modal fade" id="bagikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="bgpopup close" data-dismiss="modal"></div>
                <div class="popupbagikan">
                    <div class="row">
                        <div class="col" style="font-size: 1.5vw;">
                            <span><b>Bagikan Ke</b></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col link-bagikan">
                            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.facebook.com%2FAmalKita-100282452140288&amp;src=sdkpreparse"><i class="fab fa-facebook-f"></i></a>
                            <a href="whatsapp://send?text=http://www.google.com"><i class="fab fa-whatsapp"></i></a>
                            <a target="_blank" href="http://www.linkedin.com/shareArticle?url=http://www.google.com"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>

</html>