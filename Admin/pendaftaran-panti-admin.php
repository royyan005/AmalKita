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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
                        <a class="menu-sidenav" href="#"><span>
                                <form action="beranda-admin.php" method="post">
                                    <input class="bt-signout" type="submit" name="confirm" value="Keluar Akun">
                                </form>
                            </span></a>
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

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-home"></i>&nbsp;&nbsp;Nama Panti
                                                        Asuhan</label>
                                                    <input class="input-isi-data-panti" type="text" name="nama" placeholder="Masukan nama panti asuhan" required>
                                                    <span class="error"><?php echo $pantiErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Jumlah Penghuni
                                                        Panti Asuhan</label>
                                                    <input class="input-isi-data-panti" type="text" name="jmlhpenghuni" placeholder="Masukan jumlah penghuni panti asuhan" required>
                                                    <span class="error"><?php echo $jumlahErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Nama
                                                        Kontak</label>
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

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Nama Pemilik
                                                        Bank</label>
                                                    <input class="input-isi-data-panti" type="text" name="namapemilikrekening" placeholder="Masukan nama pemilik Bank" required>
                                                    <span class="error"><?php echo $pemilikrekErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-credit-card"></i>&nbsp;&nbsp;Rekening</label>
                                                    <input class="input-isi-data-panti" type="text" name="rekening" placeholder="Masukan no. rekening" required>
                                                    <span class="error"><?php echo $rekErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Alamat</label>
                                                    <input class="input-isi-data-panti" type="text" name="alamat" placeholder="Masukan alamat panti asuhan" required>
                                                    <span class="error"><?php echo $alamatErr; ?></span>


                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Provinsi</label>
                                                    <select class="form-control" name="provinsi" id="provinsi" required>
                                                        <option value=""> Pilih Provinsi</option>
                                                    </select>
                                                    <span class="error"><?php echo $provinsiErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Kabupaten/Kota</label>
                                                    <select class="form-control" name="kabupaten" id="kabupaten" required>
                                                        <option value=""></option>
                                                    </select>
                                                    <span class="error"><?php echo $kabupatenErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Kecamatan</label>
                                                    <select class="form-control" name="kecamatan" id="kecamatan" required>
                                                        <option value=""></option>
                                                    </select>
                                                    <span class="error"><?php echo $kecamatanErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Kelurahan</label>
                                                    <select class="form-control" name="kelurahan" id="kelurahan" required>
                                                        <option value=""></option>
                                                    </select>   
                                                    <span class="error"><?php echo $kelurahanErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Kodepos</label>
                                                    <input class="input-isi-data-panti" type="text" name="kodepos" placeholder="Masukan kodepos" required>
                                                    <span class="error"><?php echo $kodeposErr; ?></span>

                                                    <label class="label-isi-data-panti" for=""><i class="fas fa-unlock"></i>&nbsp;&nbsp;Deskripsi Panti
                                                        Asuhan</label>
                                                    <textarea id="input-isi-data-panti-textarea" rows="5" name="deskripsi" placeholder="Masukan Deskripsi Panti Asuhan" required></textarea>
                                                    <div class="teksnotifikasi">Minimal 50 Kata!</div>
                                                    <span class="error"><?php echo $deskripsiErr; ?></span>

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
                                                    <div class="teksnotifikasi" style="text-align: center; margin-top: 1vw">
                                                        Gambar hanya dapat berformat PNG atau JPG, dan Minimal 1 Gambar
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" bt-center">
                                        <button type="button" class="bt-daftar-admin" data-toggle="modal" data-target="#bagikan">Daftarkan Panti</button>
                                    </div>
                                    <!-- Design Pop Up -->
                                    <div class="modal fade" id="bagikan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="border-radius: 1vw;">
                                                <div class="bgpopup close" data-dismiss="modal"></div>
                                                <div class="popupdaftarpanti">
                                                    Apakah Anda Yakin Ingin Menambahkan Panti? <br>
                                                    <input type="submit" name="submit" class="bt-oke-popup" value="Oke">
                                                    <input type="button" class="bt-tidak-popup" data-dismiss="modal" value="Batalkan">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <!-- Design Pop Up -->
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
</body>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
</script>
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