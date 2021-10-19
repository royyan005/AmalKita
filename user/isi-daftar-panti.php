<?php
include('class/DB.php');
$pemberitahuan = $pantiErr = $deskripsiErr = $jumlahErr = $namakontakErr = $notelpErr = $bankErr = $pemilikrekErr = $rekErr = $provinsiErr = $kabupatenErr = $kecamatanErr = $kelurahanErr = $alamatErr = $kodeposErr = $susunanpengurusErr = $aktanotarisErr = $gambarErr = $gambar1Err = $gambar2Err = $gambar3Err = $gambar4Err = $gambar5Err = '';
function test_input($data1)
{
    $data1 = trim($data1);
    $data1 = stripslashes($data1);
    $data1 = htmlspecialchars($data1);
    return $data1;
}

if (isset($_POST['submit'])) {
    $namakontak = test_input($_POST['namakontak']);
    $notelp = test_input($_POST['notelp']);
    $bank = test_input($_POST['bank']);
    $namapemilikrekening = test_input($_POST['namapemilikrekening']);
    $provinsi = test_input($_POST['provinsi']);
    $kabupaten = test_input($_POST['kabupaten']);
    $kecamatan = test_input($_POST['kecamatan']);
    $kelurahan = test_input($_POST['kelurahan']);
    $alamat = test_input($_POST['alamat']);

    // CEK SUDAH TERDAFTAR
    if (empty(DB::query('SELECT panti FROM verifikasipanti WHERE panti=:panti', array(':panti' => $_POST['nama']))[0]['panti'])) {
        $panti = test_input($_POST['nama']);
    } else {
        $pantiErr = "Panti Sudah Terdaftar!";
        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
    }

    //   CEK DESKRIPSI
    if (str_word_count($_POST["deskripsi"]) <= 50) {
        $deskripsiErr = "Deskripsi Harus Lebih Dari 50 Kata!";
        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
    } else if (strlen($_POST["deskripsi"]) > 5000) {
        $deskripsiErr = "Deskripsi Tidak Boleh Lebih Dari 5000 Huruf!";
        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
    } else {
        $deskripsi = test_input($_POST['deskripsi']);
    }

    //   CEK NUMERIC JUMLAH
    if (!is_numeric($_POST["jmlhpenghuni"])) {
        $jumlahErr = "Jumlah Harus Berupa Angka!";
        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
    } else {
        $jmlhpenghuni = test_input($_POST['jmlhpenghuni']);
    }

    //   CEK NUMERIC REKENING
    if (!is_numeric($_POST["notelp"])) {
        $notelpErr = "Nomor Telepon Harus Berupa Angka!";
        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
    } else {
        $notelp = test_input($_POST['notelp']);
    }

    //   CEK NUMERIC REKENING
    if (!is_numeric($_POST["rekening"])) {
        $rekErr = "Nomor Rekening Harus Berupa Angka!";
        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
    } else {
        $rekening = test_input($_POST['rekening']);
    }

    //   CEK NUMERIC KODEPOS
    if (!is_numeric($_POST["kodepos"])) {
        $kodeposErr = "Kode Pos Harus Berupa Angka!";
        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
    } else if (strlen($_POST["kodepos"]) != 5) {
        $kodeposErr = "Kode Pos Harus 5 Angka!";
        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
    } else {
        $kodepos = test_input($_POST['kodepos']);
    }

    $data = array('susunanpengurus', 'aktanotaris', 'gambar', 'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5');
    $simpangambar = array('gambar', 'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5');

    $susunanpengurus = '';
    $aktanotaris = '';
    $uploaddata = 0;

    if (!(empty($panti) || empty($deskripsi) || empty($jmlhpenghuni) || empty($notelp) || empty($rekening) || empty($kodepos))) {
        foreach ($data as $loop) {
            $file = $_FILES[$loop];

            $filename = $_FILES[$loop]['name'];
            $fileTMP = $_FILES[$loop]['tmp_name'];
            $filesize = $_FILES[$loop]['size'];
            $fileerror = $_FILES[$loop]['error'];
            $filetype = $_FILES[$loop]['type'];

            $fileExt = explode('.', $filename);
            $fileExtNew = strtolower(end($fileExt));

            $fileallow = array('pdf', 'jpg', 'jpeg', 'png');

            if (in_array($fileExtNew, $fileallow)) {
                if ($fileerror === 0) {
                    if ($filesize <  52428800) {
                        $filenamenew = uniqid('', true) . "." . $fileExtNew;
                        if ($uploaddata == 1) {
                            DB::query(
                                'INSERT INTO verifikasipanti VALUES (\'\', :panti, :deskripsi, :jmlhpenghuni, :namakontak, :notelp, :bank, :namapemilikrekening, :rekening, :susunanpengurus, :aktanotaris, :provinsi, :kabupaten, :kecamatan, :kelurahan, :alamat, :kodepos)',
                                array(
                                    ':panti' => $panti, ':deskripsi' => $deskripsi, ':jmlhpenghuni' => $jmlhpenghuni, ':namakontak' => $namakontak, ':notelp' => $notelp, ':bank' => $bank, ':namapemilikrekening' => $namapemilikrekening, ':rekening' => $rekening, ':susunanpengurus' => $susunanpengurus, ':aktanotaris' => $aktanotaris,
                                    ':provinsi' => $provinsi, ':kabupaten' => $kabupaten, ':kecamatan' => $kecamatan, ':kelurahan' => $kelurahan, ':alamat' => $alamat, ':kecamatan' => $kecamatan, ':kodepos' => $kodepos
                                )
                            );
                            $uploaddata = 0;
                            $pemberitahuan = "Data Telah Dikirim! Mohon Tunggu Konfirmasi Dari Admin!";
                        }

                        if (in_array($loop, $simpangambar)) {
                            $filedestination = '../dataverifikasipanti/' . $loop . '/' . $filenamenew;
                            move_uploaded_file($fileTMP, $filedestination);
                            $idpanti = DB::query('SELECT idpanti FROM verifikasipanti WHERE panti=:panti', array(':panti' => $panti))[0]['idpanti'];
                            DB::query('INSERT INTO verifikasigambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpanti, ':gambar' => $filenamenew));
                        } else if ($loop == 'susunanpengurus') {
                            $susunanpengurus = $filenamenew;
                            $filedestination = '../dataverifikasipanti/susunanpengurus/' . $filenamenew;
                            move_uploaded_file($fileTMP, $filedestination);
                        } else if ($loop == 'aktanotaris') {
                            $aktanotaris = $filenamenew;
                            $filedestination = '../dataverifikasipanti/aktanotaris/' . $filenamenew;
                            move_uploaded_file($fileTMP, $filedestination);
                            $uploaddata = 1;
                        }
                    } else {
                        if ($loop == 'susunanpengurus') {
                            $susunanpengurusErr = 'Ukuran File Terlalu Besar!';
                        } else if ($loop == 'aktanotaris') {
                            $aktanotarisErr = 'Ukuran File Terlalu Besar!';
                        } else if ($loop == 'gambar') {
                            $gambarErr = 'Ukuran File Terlalu Besar!';
                        } else if (($loop == 'gambar1') && (!empty($_FILES['gambar1']['name']))) {
                            $gambar1Err = 'Ukuran File Terlalu Besar!';
                        } else if (($loop == 'gambar2') && (!empty($_FILES['gambar2']['name']))) {
                            $gambar2Err = 'Ukuran File Terlalu Besar!';
                        } else if (($loop == 'gambar3') && (!empty($_FILES['gambar3']['name']))) {
                            $gambar3Err = 'Ukuran File Terlalu Besar!';
                        } else if (($loop == 'gambar4') && (!empty($_FILES['gambar4']['name']))) {
                            $gambar4Err = 'Ukuran File Terlalu Besar!';
                        } else if (($loop == 'gambar5') && (!empty($_FILES['gambar5']['name']))) {
                            $gambar5Err = 'Ukuran File Terlalu Besar!';
                        }
                        $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                    }
                } else {
                    if ($loop == 'susunanpengurus') {
                        $susunanpengurusErr = 'File Gagal Di Upload Karena Error!';
                    } else if ($loop == 'aktanotaris') {
                        $aktanotarisErr = 'File Gagal Di Upload Karena Error!';
                    } else if ($loop == 'gambar') {
                        $gambarErr = 'File Gagal Di Upload Karena Error!';
                    } else if (($loop == 'gambar1') && (!empty($_FILES['gambar1']['name']))) {
                        $gambar1Err = 'File Gagal Di Upload Karena Error!';
                    } else if (($loop == 'gambar2') && (!empty($_FILES['gambar2']['name']))) {
                        $gambar2Err = 'File Gagal Di Upload Karena Error!';
                    } else if (($loop == 'gambar3') && (!empty($_FILES['gambar3']['name']))) {
                        $gambar3Err = 'File Gagal Di Upload Karena Error!';
                    } else if (($loop == 'gambar4') && (!empty($_FILES['gambar4']['name']))) {
                        $gambar4Err = 'File Gagal Di Upload Karena Error!';
                    } else if (($loop == 'gambar5') && (!empty($_FILES['gambar5']['name']))) {
                        $gambar5Err = 'File Gagal Di Upload Karena Error!';
                    }
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                }
            } else {
                if ($loop == 'susunanpengurus') {
                    $susunanpengurusErr = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                } else if ($loop == 'aktanotaris') {
                    $aktanotarisErr = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                } else if ($loop == 'gambar') {
                    $gambarErr = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                } else if (($loop == 'gambar1') && (!empty($_FILES['gambar1']['name']))) {
                    $gambar1Err = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                } else if (($loop == 'gambar2') && (!empty($_FILES['gambar2']['name']))) {
                    $gambar2Err = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                } else if (($loop == 'gambar3') && (!empty($_FILES['gambar3']['name']))) {
                    $gambar3Err = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                } else if (($loop == 'gambar4') && (!empty($_FILES['gambar4']['name']))) {
                    $gambar4Err = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                } else if (($loop == 'gambar5') && (!empty($_FILES['gambar5']['name']))) {
                    $gambar5Err = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
                    $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
                }
            }
        }
    }
}
?>
<script>
    function hasExtension(inputID, exts) {
        var fileName = document.getElementById(inputID).value;
        return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
    }

    function previewImagesusunan() {
        if (hasExtension('image-source-susunan', ['png', 'jpg', 'jpeg', 'JPEG', 'JPG', 'PNG'])) {
            document.getElementById("image-preview-susunan").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image-source-susunan").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview-susunan").src = oFREvent.target.result;
            };
            var str = document.getElementById("susunanpdf").innerHTML;
            str = str.split("\\").pop()
            var res = str.replace(str, "");
            document.getElementById("susunanpdf").innerHTML = res;
        } else if (hasExtension('image-source-susunan', ['pdf'])) {
            document.getElementById("image-preview-susunan").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image-source-susunan").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview-susunan").src = "assets/pdf.png";
            };
            var str = document.getElementById("susunanpdf").innerHTML;
            var source = document.getElementById('image-source-susunan').value;
            str = str.split("\\").pop()
            source = source.split("\\").pop()
            var res = str.replace(str, source);
            document.getElementById("susunanpdf").innerHTML = res;
        }
    };

    function previewImageakta() {
        if (hasExtension('image-source-akta', ['png', 'jpg', 'jpeg', 'JPEG', 'JPG', 'PNG'])) {
            document.getElementById("image-preview-akta").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image-source-akta").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview-akta").src = oFREvent.target.result;
            };
            var str = document.getElementById("aktapdf").innerHTML;
            str = str.split("\\").pop()
            var res = str.replace(str, "");
            document.getElementById("aktapdf").innerHTML = res;
        } else if (hasExtension('image-source-akta', ['pdf'])) {
            document.getElementById("image-preview-akta").style.display = "block";
            var oFReader = new FileReader();
            oFReader.readAsDataURL(document.getElementById("image-source-akta").files[0]);

            oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview-akta").src = "assets/pdf.png";
            };
            var str = document.getElementById("aktapdf").innerHTML;
            var source = document.getElementById('image-source-akta').value;
            str = str.split("\\").pop()
            source = source.split("\\").pop()
            var res = str.replace(str, source);
            document.getElementById("aktapdf").innerHTML = res;
        }
    };

    function previewImagegambar() {
        document.getElementById("image-preview-gambar").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source-gambar").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview-gambar").src = oFREvent.target.result;
        };
    };

    function previewImagegambar1() {
        document.getElementById("image-preview-gambar1").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source-gambar1").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview-gambar1").src = oFREvent.target.result;
        };
    };

    function previewImagegambar2() {
        document.getElementById("image-preview-gambar2").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source-gambar2").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview-gambar2").src = oFREvent.target.result;
        };
    };

    function previewImagegambar3() {
        document.getElementById("image-preview-gambar3").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source-gambar3").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview-gambar3").src = oFREvent.target.result;
        };
    };

    function previewImagegambar4() {
        document.getElementById("image-preview-gambar4").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source-gambar4").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview-gambar4").src = oFREvent.target.result;
        };
    };

    function previewImagegambar5() {
        document.getElementById("image-preview-gambar5").style.display = "block";
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("image-source-gambar5").files[0]);

        oFReader.onload = function(oFREvent) {
            document.getElementById("image-preview-gambar5").src = oFREvent.target.result;
        };
    };
</script>

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
    <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
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
    <section class="isi-data-panti">
        <div class="bgisi-data-panti">
            <div class="container-fluid w-75">
                <div class="row">
                    <div class="col text-judul">
                        <span>Masukan Data Panti Asuhan</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-0">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-isi-data-panti" method="post" enctype="multipart/form-data">

                            <!-- INFORMASI KALO DATA UDAH DIKIRIM -->
                            <!-- INFORMASI KALO DATA UDAH DIKIRIM -->
                            <!-- INFORMASI KALO DATA UDAH DIKIRIM -->
                            <!-- INFORMASI KALO DATA UDAH DIKIRIM -->
                            <!-- EDIT DISINI EDIT DISINI EDIT DISINI EDIT DISINI EDIT DISINI -->
                            <!-- EDIT PESAN DARI $pemberitahuan ADA DI LINE 160 -->
                            <!-- EDIT PESAN DARI $pemberitahuan ADA DI LINE 160 -->
                            <!-- EDIT PESAN DARI $pemberitahuan ADA DI LINE 160 -->
                            <!-- EDIT PESAN DARI $pemberitahuan ADA DI LINE 160 -->
                            <span class="pemberitahuan"><?php echo $pemberitahuan; ?></span>
                            <!-- INFORMASI KALO DATA UDAH DIKIRIM -->
                            <!-- INFORMASI KALO DATA UDAH DIKIRIM -->
                            <!-- INFORMASI KALO DATA UDAH DIKIRIM -->
                            <!-- INFORMASI KALO DATA UDAH DIKIRIM -->
                            <!-- CSS DI <STYLE> PINDAHIN AJA -->

                            <label class="label-isi-data-panti" for=""><i class="fas fa-home"></i>&nbsp;&nbsp;Nama Panti Asuhan</label>
                            <input class="input-isi-data-panti" type="text" name="nama" placeholder="Masukan nama panti asuhan" required>
                            <span class="error"><?php echo $pantiErr; ?></span>
                            <label class="label-isi-data-panti" for=""><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Jumlah Penghuni Panti Asuhan</label>
                            <input class="input-isi-data-panti" type="text" name="jmlhpenghuni" placeholder="Masukan jumlah penghuni panti asuhan" required>
                            <span class="error"><?php echo $jumlahErr; ?></span>
                            <label class="label-isi-data-panti" for=""><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Nama Kontak</label>
                            <input class="input-isi-data-panti" type="text" name="namakontak" placeholder="Masukan nama kontak" required>
                            <span class="error"><?php echo $namakontakErr; ?></span>
                            <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;No Telepon</label>
                            <input class="input-isi-data-panti" type="text" name="notelp" placeholder="Masukan nomor telepon" required>
                            <span class="error"><?php echo $notelpErr; ?></span>
                            <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Nama Bank</label>
                            <select class="form-control" name="bank" id="bank" required>
                                    <option value=""> Pilih Bank</option>
                                    <?php $databasebank = DB::query('SELECT name FROM bank');
                                    foreach($databasebank as $loopbank){?>
                                        <option value="<?php echo $loopbank[0];?>"> <?php echo $loopbank[0];?></option>
                                    <?php } ?>
                                </select>
                            <span class="error"><?php echo $bankErr; ?></span>
                            <label class="label-isi-data-panti" for=""><i class="fas fa-credit-card"></i>&nbsp;&nbsp;No Rekening</label>
                            <input class="input-isi-data-panti" type="text" name="rekening" placeholder="Masukan no. rekening" required>
                            <span class="error"><?php echo $rekErr; ?></span>
                            <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Nama Pemilik Bank</label>
                            <input class="input-isi-data-panti" type="text" name="namapemilikrekening" placeholder="Masukan nama pemilik Bank" required>
                            <span class="error"><?php echo $pemilikrekErr; ?></span>
                            <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Alamat</label>
                            <input class="input-isi-data-panti" type="text" name="alamat" placeholder="Masukan alamat panti asuhan" required>
                            <span class="error"><?php echo $alamatErr; ?></span>

                            <label class="label-isi-data-panti form-group" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Provinsi</label>
                            <select class="form-control" name="provinsi" id="provinsi">
                                <option value=""> Pilih Provinsi</option>
                            </select>
                            <span class="error"><?php echo $provinsiErr; ?></span>

                            <label class="label-isi-data-panti form-group" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kabupaten/Kota</label>
                            <select class="form-control" name="kabupaten" id="kabupaten">
                                <option value=""></option>
                            </select>
                            <span class="error"><?php echo $kabupatenErr; ?></span>

                            <label class="label-isi-data-panti form-group" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kecamatan</label>
                            <select class="form-control" name="kecamatan" id="kecamatan">
                                <option value=""></option>
                            </select>
                            <span class="error"><?php echo $kecamatanErr; ?></span>

                            <label class="label-isi-data-panti form-group" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kelurahan</label>
                            <select class="form-control" name="kelurahan" id="kelurahan">
                                <option value=""></option>
                            </select>
                            <span class="error"><?php echo $kelurahanErr; ?></span>



                            <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kode Pos</label>
                            <input class="input-isi-data-panti" type="text" name="kodepos" placeholder="Masukan Kodepos" required>
                            <span class="error"><?php echo $kodeposErr; ?></span>
                            <label class="label-isi-data-panti" for=""><i class="fas fa-unlock"></i>&nbsp;&nbsp;Deskripsi Panti Asuhan</label>
                            <textarea id="input-isi-data-panti-textarea" name="deskripsi" rows="5" placeholder="Masukan Deskripsi Panti Asuhan(Minimal 50 Kata)" required></textarea>
                            <span class="error"><?php echo $deskripsiErr; ?></span>

                            <!-- TAMBAH AKTANOTARIS -->
                            <!-- TAMBAH AKTANOTARIS -->
                            <!-- TAMBAH AKTANOTARIS -->
                            <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Akta Notaris</label>
                            <div class="row">
                                <div class="col">
                                    <img id="image-preview-akta" alt="image preview" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="aktapdf"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Tambahkan File</button>
                                        <div class="teksnotifikasi">
                                            <input type="file" name="aktanotaris" id="image-source-akta" accept="image/*,.pdf" onchange="previewImageakta();" required>Hanya Menerima File Berformat PDF,PNG Atau JPG
                                        </div>
                                        <span class="error"><?php echo $aktanotarisErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- ----------------------------- -->

                            <!-- TAMBAH SUSUNAN  -->
                            <!-- TAMBAH SUSUNAN  -->
                            <!-- TAMBAH SUSUNAN  -->
                            <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Susunan Pengurusan
                                Panti Asuhan</label>
                            <div class="row">
                                <div class="col">
                                    <img id="image-preview-susunan" alt="image-preview" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div id="susunanpdf"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Tambahkan File</button>
                                        <div class="teksnotifikasi">
                                            <input type="file" name="susunanpengurus" id="image-source-susunan" accept="image/*,.pdf" onchange="previewImagesusunan();" required>Hanya Menerima File Berformat PDF,PNG Atau JPG
                                        </div>
                                        <span class="error"><?php echo $susunanpengurusErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <!-- ----------------------------- -->

                            <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Gambar Panti
                                Asuhan</label>
                            <div class="row">
                                <div class="col nofile">
                                    <img id="image-preview-gambar" alt="image preview" src="assets/no_file.png" />
                                </div>
                                <div class="col nofile">
                                    <img id="image-preview-gambar1" alt="image preview" src="assets/no_file.png" />
                                </div>
                                <div class="col nofile">
                                    <img id="image-preview-gambar2" alt="image preview" src="assets/no_file.png" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col nofile">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Tambahkan File</button>
                                        <input type="file" name="gambar" id="image-source-gambar" accept="image/*" onchange="previewImagegambar();" required>
                                        <span class="error"><?php echo $gambarErr; ?></span>
                                    </div>
                                </div>
                                <div class="col nofile">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Tambahkan File</button>
                                        <input type="file" name="gambar1" id="image-source-gambar1" accept="image/*" onchange="previewImagegambar1();">
                                        <span class="error"><?php echo $gambarErr; ?></span>
                                    </div>
                                </div>
                                <div class="col nofile">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Tambahkan File</button>
                                        <input type="file" name="gambar2" id="image-source-gambar2" accept="image/*" onchange="previewImagegambar2();">
                                        <span class="error"><?php echo $gambarErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="height: 2vw;">

                            </div>
                            <div class="row">
                                <div class="col nofile">
                                    <img id="image-preview-gambar3" alt="image preview" src="assets/no_file.png" />
                                </div>
                                <div class="col nofile">
                                    <img id="image-preview-gambar4" alt="image preview" src="assets/no_file.png" />
                                </div>
                                <div class="col nofile">
                                    <img id="image-preview-gambar5" alt="image preview" src="assets/no_file.png" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col nofile">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Tambahkan File</button>
                                        <input type="file" name="gambar3" id="image-source-gambar3" accept="image/*" onchange="previewImagegambar3();">
                                        <span class="error"><?php echo $gambarErr; ?></span>
                                    </div>
                                </div>
                                <div class="col nofile">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Tambahkan File</button>
                                        <input type="file" name="gambar4" id="image-source-gambar4" accept="image/*" onchange="previewImagegambar4();">
                                        <span class="error"><?php echo $gambarErr; ?></span>
                                    </div>
                                </div>
                                <div class="col nofile">
                                    <div class="upload-btn-wrapper">
                                        <button class="btn">Tambahkan File</button>
                                        <input type="file" name="gambar5" id="image-source-gambar5" accept="image/*" onchange="previewImagegambar5();">
                                        <span class="error"><?php echo $gambarErr; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="teksnotifikasi">
                                Gambar hanya dapat berformat PNG atau JPG, dan Minimal 1 Gambar
                            </div>

                            <input class="bt-daftar" type="submit" name="submit" value="Daftarkan Sekarang">
                        </form>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
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