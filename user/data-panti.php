<?php
include('class/DB.php');

$d = DB::query('SELECT * FROM panti');
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
    <script src="https://kit.fontawesome.com/386e6055da.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
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
    <section class="data-panti">
        <div class="bg-data-panti">
            <div class="container-fluid">
                <div class="row">
                    <div class="col header-data-panti">
                        <img class="logo3" src="assets/AmalKita.png" alt="">
                        <span>“Sedekah Saat Berkecukupan Itu Biasa, Akan Tetapi Sedekah Saat Kita Susah Itu Luar Biasa”
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- <section class="maps-data-panti">
        <div class="bg-maps">
            <div class="container-fluid" id="mapid">
            </div>
        </div>
    </section> -->
    <section class="direktori-data-panti">
        <div class="bgdirektori">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <span class="tulisandirektori"><a href="beranda.php">Beranda</a> > Data Panti</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="list-panti">
        <div class="bg-list-panti">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 bg-filter">
                        <form action="" class="filter" method="post">
                            <div><i class="fas fa-search"></i> Search</div>
                            <hr class="hr3">
                            <input class="input-filter form-control" id="nama-panti" type="search" name="caripanti" value="" placeholder="Cari Nama Panti Disini" required />
                            <input class="bt-cari" type="submit" name="cari" value="Cari">
                        </form>
                        <form action="" class="filter" method="post">
                            <div><i class="fas fa-filter"></i> Filter</div>
                            <hr class="hr3">
                            <select class="form-control" name="provinsi" id="provinsi">
                                <option value=""> Pilih Provinsi</option>
                            </select>
                            <select class="form-control" name="kabupaten" id="kabupaten">
                                <option value=""> Pilih kabupaten</option>
                            </select>
                            <input class="bt-cari" type="submit" name="filter" value="Filter">
                        </form>
                    </div>
                    <div class="col-9">

                        <?php
                        if (isset($_POST['cari'])) {
                            if (isset($_POST['caripanti'])) {
                                $keyword = $_POST['caripanti'];
                                $d = DB::query('SELECT * FROM panti WHERE panti LIKE :keyword', array(':keyword' => $keyword));
                            } ?>
                            <div class="row">
                                <div class="col top-sort-panti">
                                    <span>
                                        Total : <span>
                                            <?php echo DB::query('SELECT COUNT(idpanti) FROM panti WHERE panti=:panti ', array(':panti' => $_POST['caripanti']))[0][0]; ?>
                                        </span> Panti
                                    </span>
                                </div>
                            </div>
                            <?php foreach ($d as $data) {
                                $gambar = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $data['idpanti']))[0]['gambar']; ?>

                                <div class="row">
                                    <div class="col content-panti">
                                        <div class="row">
                                            <div class="col-3 wrap-img-panti">
                                                <img class="img-panti" src="../datapanti/gambar/<?php echo $gambar; ?>" alt="">
                                            </div>
                                            <div class="col-9 desc-data-panti">
                                                <div class="judul-panti"><a href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"><?php echo $data['panti']; ?></a></div>
                                                <div class="alamat-panti"><a href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"><?php echo DB::query('SELECT nama FROM kabupaten WHERE id_kab=:id_kab', array(':id_kab'=>$data['kabupaten']))[0]['nama'];
                                                                                                                                                echo ", ";
                                                                                                                                                echo DB::query('SELECT nama FROM provinsi WHERE id_prov=:id_prov', array(':id_prov'=>$data['provinsi']))[0]['nama']; ?></a></div>
                                                <hr style="margin: 0.5vw;">
                                                <div class="desc-panti"><?php echo substr($data['deskripsi'], 0, 200); ?><a class="lihat-selengkapnya" href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"> Lihat
                                                        Selengkapnya...</a></div>
                                                <hr style="margin: 0.5vw;">
                                                <div class="desc-pemilik-panti">
                                                    <span class="pemilik-panti"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;<?php echo $data['namakontak']; ?></span>
                                                    <span><i class="far fa-envelope fa-lg"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } else if (isset($_POST['filter'])) {
                            if (isset($_POST['provinsi'])&&isset($_POST['kabupaten'])) {
                                $keyword = $_POST['provinsi'];
                                $keyword2 = $_POST['kabupaten'];
                                $d = DB::query('SELECT * FROM panti WHERE provinsi LIKE :keyword AND kabupaten LIKE :keyword2', array(':keyword' => $keyword, ':keyword2' => $keyword2));
                            } ?>
                            <div class="row">
                                <div class="col top-sort-panti">
                                    <span>
                                        Total : <span>
                                            <?php 
                                                echo DB::query('SELECT COUNT(idpanti) FROM panti WHERE provinsi=:provinsi AND kabupaten=:kabupaten', array(':provinsi' => $_POST['provinsi'], ':kabupaten' => $_POST['kabupaten']))[0][0];
                                            ?>
                                        </span> Panti
                                    </span>
                                </div>
                            </div>
                            <?php foreach ($d as $data) {
                                $gambar = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $data['idpanti']))[0]['gambar']; ?>
                                <div class="row">
                                    <div class="col content-panti">
                                        <div class="row">
                                            <div class="col-3 wrap-img-panti">
                                                <img class="img-panti" src="../datapanti/gambar/<?php echo $gambar; ?>" alt="">
                                            </div>
                                            <div class="col-9 desc-data-panti">
                                                <div class="judul-panti"><a href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"><?php echo $data['panti']; ?></a></div>
                                                <div class="alamat-panti"><a href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"><?php echo DB::query('SELECT nama FROM kabupaten WHERE id_kab=:id_kab', array(':id_kab'=>$data['kabupaten']))[0]['nama'];
                                                                                                                                                echo ", ";
                                                                                                                                                echo DB::query('SELECT nama FROM provinsi WHERE id_prov=:id_prov', array(':id_prov'=>$data['provinsi']))[0]['nama']; ?></a></div>
                                                <hr style="margin: 0.5vw;">
                                                <div class="desc-panti"><?php echo substr($data['deskripsi'], 0, 200); ?><a class="lihat-selengkapnya" href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"> Lihat
                                                        Selengkapnya...</a></div>
                                                <hr style="margin: 0.5vw;">
                                                <div class="desc-pemilik-panti">
                                                    <span class="pemilik-panti"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;<?php echo $data['namakontak']; ?></span>
                                                    <span><i class="far fa-envelope fa-lg"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        <?php } else { ?>
                            <div class="row">
                                <div class="col top-sort-panti">
                                    <span>
                                        Total : <span>
                                            <?php echo DB::query('SELECT COUNT(idpanti) FROM panti')[0][0]; ?>
                                        </span> Panti
                                    </span>
                                </div>
                            </div>
                            <?php foreach ($d as $data) { ?>

                                <div class="row">
                                    <div class="col content-panti">
                                        <div class="row">
                                            <div class="col-3 wrap-img-panti">
                                                <img class="img-panti" src="../datapanti/gambar/<?php echo DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $data['idpanti']))[0]['gambar']; ?>" alt="">
                                            </div>
                                            <div class="col-9 desc-data-panti">
                                                <div class="judul-panti"><a href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"><?php echo $data['panti']; ?></a></div>
                                                <div class="alamat-panti"><a href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"><?php echo DB::query('SELECT nama FROM kabupaten WHERE id_kab=:id_kab', array(':id_kab'=>$data['kabupaten']))[0]['nama'];
                                                                                                                                                echo ", ";
                                                                                                                                                echo DB::query('SELECT nama FROM provinsi WHERE id_prov=:id_prov', array(':id_prov'=>$data['provinsi']))[0]['nama']; ?></a></div>
                                                <hr style="margin: 0.5vw;">
                                                <div class="desc-panti"><?php echo substr($data['deskripsi'], 0, 200); ?><a class="lihat-selengkapnya" href="profil-panti.php?idpanti=<?php echo $data['idpanti']; ?>"> Lihat
                                                        Selengkapnya...</a></div>
                                                <hr style="margin: 0.5vw;">
                                                <div class="desc-pemilik-panti">
                                                    <span class="pemilik-panti"><i class="fas fa-user-circle"></i>&nbsp;&nbsp;<?php echo $data['namakontak']; ?></span>
                                                    <span><i class="far fa-envelope fa-lg"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php }
                        }
                        ?>
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
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    <script>
        var center = [-5.3760680478732334, 105.27928948402405]
        var mymap = L.map('mapid').setView(center, 15);

        var TileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        TileLayer.addTo(mymap)

        var marker = L.marker(center).addTo(mymap);
    </script>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      	$.ajax({
            type: 'POST',
          	url: "get_provinsi.php",
          	cache: false, 
          	success: function(msg){
              $("#provinsi").html(msg);
            }
        });
 
      	$("#provinsi").change(function(){
      	var provinsi = $("#provinsi").val();
          	$.ajax({
          		type: 'POST',
              	url: "get_kabupaten.php",
              	data: {provinsi: provinsi},
              	cache: false,
              	success: function(msg){
                  $("#kabupaten").html(msg);
                }
            });
        });
 
        $("#kabupaten").change(function(){
      	var kabupaten = $("#kabupaten").val();
          	$.ajax({
          		type: 'POST',
              	url: "get_kecamatan.php",
              	data: {kabupaten: kabupaten},
              	cache: false,
              	success: function(msg){
                  $("#kecamatan").html(msg);
                }
            });
        });
 
        $("#kecamatan").change(function(){
      	var kecamatan = $("#kecamatan").val();
          	$.ajax({
          		type: 'POST',
              	url: "get_kelurahan.php",
              	data: {kecamatan: kecamatan},
              	cache: false,
              	success: function(msg){
                  $("#kelurahan").html(msg);
                }
            });
        });
     });
</script>

</html>