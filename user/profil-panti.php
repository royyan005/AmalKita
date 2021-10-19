<?php
include('class/DB.php');

$idpanti = $_GET['idpanti'];
$namakontak = DB::query('SELECT namakontak FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['namakontak'];
$alamat = DB::query('SELECT alamat FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['alamat'];
$notelp = DB::query('SELECT notelp FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['notelp'];
$deskripsi = DB::query('SELECT deskripsi FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['deskripsi'];
$jmlhgambar = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti));
$idkabupaten = DB::query('SELECT kabupaten FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kabupaten'];
$kabupaten = DB::query('SELECT nama FROM kabupaten WHERE id_kab=:idkabupaten', array(':idkabupaten' => $idkabupaten))[0]['nama'];
$idprovinsi = DB::query('SELECT provinsi FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['provinsi'];
$provinsi = DB::query('SELECT nama FROM kabupaten WHERE id_prov=:idprovinsi', array(':idprovinsi' => $idprovinsi))[0]['nama'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
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
                            <a class="text-nav nav-link" href="donasi.php"><i class="fas fa-wallet"></i>&nbsp;
                                Donasi</a>
                        </li>
                        <li class="nav-item bt-black ">
                            <a class="text-nav nav-link active-link" href="daftar-panti.php"><i class="fas fa-home"></i>&nbsp; Daftarkan Panti</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="profil-panti">
        <div class="bg-profil-panti">
            <div class="container-fluid">
                <div class="row">
                    <div class="col judul-profil-panti">
                        <div>
                            <?php echo DB::query('SELECT panti FROM panti WHERE idpanti=:idpanti', array(':idpanti'=>$idpanti))[0]['panti'];?>
                        </div>
                        <div>
                            <span class="loc-profil"><i class="fas fa-map-marker-alt"></i>&nbsp; 
                            <?php echo DB::query('SELECT nama FROM kabupaten WHERE id_kab=:idkabupaten', array(':idkabupaten'=>$idkabupaten))[0]['nama'];?>
                            , <?php echo DB::query('SELECT nama FROM provinsi WHERE id_prov=:idprovinsi', array(':idprovinsi'=>$idprovinsi))[0]['nama'];?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content-profil">
        <div class="bg-profile">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-9 main-profile">
                        <div class="galeri-panti">
                            <div class="bg-judul-profil">Galeri</div>
                            <div class="bg-content-profil">
                                <div class="owl-carousel owl-theme">
                                    <?php $i = 0;
                                    foreach ($jmlhgambar as $loopgambar) {
                                    ?>
                                        <div class="item wrap-img-carousel">
                                            <img class="img-carousel" src="../datapanti/gambar<?php if ($i > 0) {
                                                                                                    echo $i;
                                                                                                } ?>/<?php echo $loopgambar[0]; ?>" alt="<?php echo $loopgambar[0]; ?>">
                                        </div>
                                    <?php $i = $i + 1;
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="profile-panti">
                            <div class="bg-judul-profil">Profile</div>
                            <div class="bg-content-profil">
                                <span>
                                    <?php echo $deskripsi; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 side-profile">
                        <div class="owner-panti">
                            <div class="bg-judul-profil">Pimpinan/Pengasuh</div>
                            <div class="bg-content-profil" id="pimpinan">
                                <span>
                                    <?php echo $namakontak; ?>
                                </span>
                            </div>
                        </div>
                        <div class="alamat-panti">
                            <div class="bg-judul-profil">Alamat & Kontak</div>
                        </div>
                        <div class="bg-content-profil">
                            <span>
                                <?php echo $alamat; ?>
                            </span>
                            <hr style="margin: 1vw 0;">
                            <span>
                                <i class="fas fa-phone-alt"></i>&nbsp; <?php echo $notelp; ?>
                            </span>
                        </div>
                    </div>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    </script>
</body>

</html>