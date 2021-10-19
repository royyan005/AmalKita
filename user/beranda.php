<?php
include('class/DB.php');
$data = DB::query('SELECT idpanti FROM panti');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://kit.fontawesome.com/386e6055da.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <nav id="navbar" class="navbar navbar-expand-md fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="beranda.php"><img class="logo" src="assets/AmalKita.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span><i class="fas fa-bars fa-xs"></i></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
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
    <section class="welcome-page">
        <div class="bghome">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 text-welcome">
                        <p id="welcome"><b>Selamat Datang di</b></p>
                        <p id="text-amalkita"><b>"Amal<span class="textgreen">Kita</span>"</b></p>
                        <p id="text-quotes">“Barangsiapa yang menjumpai
                            saudaranya yang muslim dengan
                            (memberi) sesuatu yang disukainya agar
                            dia gembira, maka Allah akan
                            membuatnya gembira pada hari kiamat.”</p>
                        <p>
                        <div class="col">
                            <a class="text-donasi" href="donasi.php">Donasi Sekarang</a>
                        </div>
                        </p>
                    </div>
                    <div class="col-6">
                        <img class="anakpanti" src="assets/anakpanti.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="slide-panti">
        <div class="bg-slide-panti">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div id="text-carousel">Panti Terdaftar</div>
                        <hr class="hr5">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="owl-carousel owl-theme">
                            <?php foreach ($data as $loopidpanti) {
                                $gambar = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti[0]))[0]['gambar'];
                            ?>
                                <div class="item wrap-img-carousel">
                                    <a href="profil-panti.php?idpanti=<?php echo $loopidpanti[0]; ?>">
                                        <div class="liatpanti">
                                            <img class="img-carousel" src="<?php echo '../datapanti/gambar/' . $gambar; ?>">
                                            <div class="namapantihover">
                                                <div class="namahover">
                                                    <?php
                                                    echo   DB::query('SELECT panti FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $loopidpanti[0]))[0]['panti'];
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col lihat-selengkapnya-carousel">
                        <a id="lihat-selengkapnya-carousel" href="data-panti.php">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tentang-kami">
        <div class="bg-tentang-kami">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6 d-flex justify-content-center p-0">
                        <img class="foto1" src="assets/foto1.jpeg" alt="">
                    </div>
                    <div class="col-5 p-0">
                        <p id="about1">From Zero to Hero</p>
                        <hr class="hr hr1">
                        <p id="about2">Masih banyaknya ketidaktahuan masyarakat tentang keberadaan adik-adik di Panti
                            Asuhan yang membutuhkan uluran tangan kita, maka terbentuklah gagasan untuk mengumpulkan
                            data-data
                            Panti Asuhan dalam bentuk platform website AmalKita. <br><br>
                            Selain melakukan pendataan, kami juga menerima titipan donasi dari para donatur,
                            baik berupa uang maupun barang, yang alhamdulillah tiap bulan kami salurkan secara rutin.
                        </p>
                        <a id="about3" href="tentang-kami.php">Lihat Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <div class="col-1">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="proses-pendataan">
        <div class="bg-proses-pendataan">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <p id="pp1"><b>Proses Pendataan Panti</b></p>
                        <hr class="hr" style="width: 20%;">
                        <p id="pp2">Kami Melakukan Beberapa Proses Dalam Pendataan Pada Panti Yang Tergabung Di AmalKita
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-icon" src="assets/icon-locaction.png" alt="">
                                <h5 class="card-title"><b>Info Panti</b></h5>
                                <div class="card-body">
                                    <p class="card-text">Menerima infrormasi Lokasi Panti Asuhan dari sahabat ataupun
                                        para Donatur.
                                </div>
                                </p>
                            </div>
                            <img class="circle" src="assets/icon-circle1.png" alt="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-icon" src="assets/icon-filetext.png" alt="">
                                <h5 class="card-title"><b>Validasi Data</b></h5>
                                <div class="card-body">
                                    <p class="card-text">Melakukan Pengecakan informasi dengan mendatangi panti secara
                                        langsung</p>
                                </div>
                            </div>
                            <img class="circle" src="assets/icon-circle2.png" alt="">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
                                <img class="img-icon" src="assets/icon-shopbag.png" alt="">
                                <h5 class="card-title"><b>Mendata Panti</b></h5>
                                <div class="card-body">
                                    <p class="card-text">Input Data Panti ke Website, sehingga bisa di akses semua orang
                                    </p>
                                </div>
                            </div>
                            <img class="circle" src="assets/icon-circle3.png" alt="">
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
                        <p class="text-footer1">AmalKita adalah platform digital yang bergerak dalam pemetaan dan penyaluran Donasi kepada Panti Asuhan.</p>
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

    <script>
        window.addEventListener('scroll', function() {
            let header = document.getElementById('navbar')
            let windowPosition = window.scrollY > 0;
            header.classList.toggle('scrolling-active', windowPosition);
        })
    </script>

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
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        });
    </script>
</body>
<script>

</script>

</html>