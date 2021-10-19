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
    <script src="https://kit.fontawesome.com/386e6055da.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav id="navbar2" class="navbar navbar-expand-md fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="beranda.php"><img class="logo1" src="assets/AmalKitaBG2.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span><i
                            class="fas fa-bars fa-xs"></i></span></button>
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
                            <a class="text-nav nav-link active-link" href="daftar-panti.php"><i class="fas fa-home"></i>&nbsp; Daftarkan Panti</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
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
                <div class="row">
                    <div class="col bt-daftar-panti">
                        <a class="text-donasi" href="isi-daftar-panti.php">Daftar Panti Sekarang &nbsp;<i class="fas fa-arrow-circle-right"></i></a>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
</body>
</html>