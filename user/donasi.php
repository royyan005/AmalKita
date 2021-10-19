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
                            <a class="text-nav nav-link" href="daftar-panti.php"><i class="fas fa-home"></i>&nbsp; Daftarkan Panti</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>
    <section class="donasi">
        <div class="bgdonasi">
            <div class="container-fluid">
                <div class="row">
                    <div class="col textdonasi">
                        <p id="JudulDonasi"><b>DONASI</b></p>
                        <hr class="hr" style="width: 25%; background-color: #00643c">
                        <p id="pp2">Salurkan Donasi Terbaik Anda
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col metode-bayar">
                        <div class="row judul-metode-bayar">
                            <span>Metode Pembayaran</span>
                        </div>
                        <div class="row jenis-metode-bayar">
                            <div class="col collapsible">
                                <button type="button" class="bt-collapsible bt-BCA">
                                    <i class="fas fa-wallet"></i>&nbsp; BCA
                                </button>
                                <div class="content-collapsible">
                                    <div class="row rek">
                                        <div class="col no-rek">
                                            <span id="rek1">042.476.2349 </span>
                                        </div>
                                        <div class="col copy-button">
                                            <button id="bt-copy1" title="Salin">Salin</button>
                                        </div>
                                    </div>
                                    <div class="row nama-rek">
                                        <div class="col">
                                            <span>
                                                <i class="fas fa-user"></i> Muhammad Iqbal Syahbana [Kode Bank 002]
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row jenis-metode-bayar">
                            <div class="col collapsible">
                                <button type="button" class="bt-collapsible">
                                    <i class="fas fa-wallet"></i>&nbsp; Gopay
                                </button>
                                <div class="content-collapsible">
                                    <div class="row rek">
                                        <div class="col no-rek">
                                            <span id="rek2">089636376248 </span>
                                        </div>
                                        <div class="col copy-button">
                                            <button id="bt-copy2" title="Salin">Salin</button>
                                        </div>
                                    </div>
                                    <div class="row nama-rek">
                                        <div class="col">
                                            <span>
                                                <i class="fas fa-user"></i> AmalKita
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row jenis-metode-bayar">
                            <div class="col collapsible">
                                <button type="button" class="bt-collapsible">
                                    <i class="fas fa-wallet"></i>&nbsp; Shoope Pay
                                </button>
                                <div class="content-collapsible">
                                    <div class="row rek">
                                        <div class="col no-rek">
                                            <span id="rek3">089636376248 </span>
                                        </div>
                                        <div class="col copy-button">
                                            <button id="bt-copy3" title="Salin">Salin</button>
                                        </div>
                                    </div>
                                    <div class="row nama-rek">
                                        <div class="col">
                                            <span>
                                                <i class="fas fa-user"></i> AmalKita
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row jenis-metode-bayar">
                            <div class="col collapsible">
                                <button type="button" class="bt-collapsible">
                                    <i class="fas fa-wallet"></i>&nbsp; DANA
                                </button>
                                <div class="content-collapsible">
                                    <div class="row">
                                        <div class="col qr-code1">
                                            <div>
                                                <img class="img-qr-code1" src="assets/qrcode-dana.jpeg" alt="">
                                            </div>
                                            <div>
                                                AmalKita<br>089636376248
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row jenis-metode-bayar">
                            <div class="col collapsible">
                                <button type="button" class="bt-collapsible">
                                    <i class="fas fa-wallet"></i>&nbsp; OVO
                                </button>
                                <div class="content-collapsible">
                                    <div class="row">
                                        <div class="col qr-code1">
                                            <div>
                                                <img class="img-qr-code1" src="assets/qrcode-ovo.jpeg" alt="">
                                            </div>
                                            <div>
                                                AmalKita<br>089636376248
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

        <script>
            document.querySelectorAll('.bt-collapsible').forEach(button => {
                button.addEventListener('click', () => {
                    const collapsibleContent = button.nextElementSibling;

                    button.classList.toggle('bt-collapsible--active');

                    if (button.classList.contains('bt-collapsible--active')) {
                        collapsibleContent.style.maxHeight = collapsibleContent.scrollHeight + 'px';
                    } else {
                        collapsibleContent.style.maxHeight = 0;
                    }
                });
            });
        </script>

        <script>
            document.getElementById("bt-copy1").addEventListener("click", copy_password);

            function copy_password() {
                var copyText = document.getElementById("rek1");
                var textArea = document.createElement("textarea");
                textArea.value = copyText.textContent;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand("Copy");
                textArea.remove();
            }
        </script>

        <script>
            document.getElementById("bt-copy2").addEventListener("click", copy_password);

            function copy_password() {
                var copyText = document.getElementById("rek2");
                var textArea = document.createElement("textarea");
                textArea.value = copyText.textContent;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand("Copy");
                textArea.remove();
            }
        </script>

        <script>
            document.getElementById("bt-copy3").addEventListener("click", copy_password);

            function copy_password() {
                var copyText = document.getElementById("rek3");
                var textArea = document.createElement("textarea");
                textArea.value = copyText.textContent;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand("Copy");
                textArea.remove();
            }
        </script>
</body>
</html>