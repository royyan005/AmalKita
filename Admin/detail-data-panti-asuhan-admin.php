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


  // MENGAMBIL DATA DARI DATABASE
  $idpanti = $_GET['idpanti'];
  $panti = DB::query('SELECT panti FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['panti'];
  $deskripsi = DB::query('SELECT deskripsi FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['deskripsi'];
  $jmlhpenghuni = DB::query('SELECT jmlhpenghuni FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['jmlhpenghuni'];
  $namakontak = DB::query('SELECT namakontak FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['namakontak'];
  $notelp = DB::query('SELECT notelp FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['notelp'];
  $bank = DB::query('SELECT bank FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['bank'];
  $namarekening = DB::query('SELECT namarekening FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['namarekening'];
  $norekening = DB::query('SELECT norekening FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['norekening'];
  $idkelurahan = DB::query('SELECT kelurahan FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kelurahan'];
  $kelurahan = DB::query('SELECT nama FROM kelurahan WHERE id_kel=:idkelurahan', array(':idkelurahan' => $idkelurahan))[0]['nama'];
  $idkecamatan = DB::query('SELECT kecamatan FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kecamatan'];
  $kecamatan = DB::query('SELECT nama FROM kecamatan WHERE id_kec=:idkecamatan', array(':idkecamatan' => $idkecamatan))[0]['nama'];
  $idkabupaten = DB::query('SELECT kabupaten FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kabupaten'];
  $kabupaten = DB::query('SELECT nama FROM kabupaten WHERE id_kab=:idkabupaten', array(':idkabupaten' => $idkabupaten))[0]['nama'];
  $idprovinsi = DB::query('SELECT provinsi FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['provinsi'];
  $provinsi = DB::query('SELECT nama FROM kabupaten WHERE id_prov=:idprovinsi', array(':idprovinsi' => $idprovinsi))[0]['nama'];
  $alamat = DB::query('SELECT alamat FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['alamat'];
  $kodepos = DB::query('SELECT kodepos FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['kodepos'];
  $susunanpengurus = DB::query('SELECT susunanpengurus FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['susunanpengurus'];
  $susunanpengurus = DB::query('SELECT susunanpengurus FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['susunanpengurus'];
  $susunanpengurusExt = explode('.', $susunanpengurus);
  $susunanpengurusExtNew = strtolower(end($susunanpengurusExt));
  $aktanotaris = DB::query('SELECT aktanotaris FROM panti WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0]['aktanotaris'];
  $aktanotarisExt = explode('.', $aktanotaris);
  $aktanotarisExtNew = strtolower(end($aktanotarisExt));
  $filegambar = array('jpg', 'png', 'jpeg');
  $max = DB::query('SELECT COUNT(id) FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[0][0];
  $no = 0;
  $gambar = $gambar1 = $gambar2 = $gambar3 = $gambar4 = $gambar5 = 'no_file.png';
  while ($no < $max) {
    if ($no == 0) {
      $idgambar = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
      $gambar = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar))[0]['gambar'];
    } else if ($no == 1) {
      $idgambar1 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
      $gambar1 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar1))[0]['gambar'];
    } else if ($no == 2) {
      $idgambar2 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
      $gambar2 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar2))[0]['gambar'];
    } else if ($no == 3) {
      $idgambar3 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
      $gambar3 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar3))[0]['gambar'];
    } else if ($no == 4) {
      $idgambar4 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
      $gambar4 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar4))[0]['gambar'];
    } else if ($no == 5) {
      $idgambar5 = DB::query('SELECT id FROM gambar WHERE idpanti=:idpanti', array(':idpanti' => $idpanti))[$no]['id'];
      $gambar5 = DB::query('SELECT gambar FROM gambar WHERE idpanti=:idpanti AND id=:idgambar', array(':idpanti' => $idpanti, ':idgambar' => $idgambar5))[0]['gambar'];
    }
    $no += 1;
  }

  // UPDATE DATABASE DARI FORM
  // UPDATE DATABASE DARI FORM
  $pemberitahuan = $pantiErr = $deskripsiErr = $jumlahErr = $namakontakErr = $notelpErr = $bankErr = $pemilikrekErr = $rekErr = $alamatErr = $kodeposErr = $susunanpengurusErr = $aktanotarisErr = $gambarErr = $gambar1Err = $gambar2Err = $gambar3Err = $gambar4Err = $gambar5Err = '';
  function test_input($data1)
  {
    $data1 = trim($data1);
    $data1 = stripslashes($data1);
    $data1 = htmlspecialchars($data1);
    return $data1;
  }

  if (isset($_POST['submit'])) {
    //   MEMASUKKAN DATA DARI FORM KE VAR 
    $updatenamakontak = test_input($_POST['namakontak']);
    $updatenotelp = test_input($_POST['notelp']);
    $updatebank = test_input($_POST['bank']);
    $updatenamapemilikrekening = test_input($_POST['namarekening']);
    $updatealamat = test_input($_POST['alamat']);
    $updatesusunanpengurus = $susunanpengurus;
    $updateaktanotaris = $aktanotaris;

    //   CEK APAKAH NAMA SUDAH DIPAKAI
    if (empty(DB::query('SELECT panti FROM panti WHERE idpanti!=:idpanti AND panti=:panti', array(':idpanti' => $idpanti, ':panti' => $_POST['nama']))[0]['panti'])) {
      $updatepanti = test_input($_POST['nama']);
    } else {
      $pantiErr = "Panti Sudah Terdaftar!";
    }

    //   CEK DESKRIPSI
    if (str_word_count($_POST["deskripsi"]) <= 50) {
      $deskripsiErr = "Deskripsi Harus Lebih Dari 50 Kata!";
    } else if (strlen($_POST["deskripsi"]) > 5000) {
      $deskripsiErr = "Deskripsi Tidak Boleh Lebih Dari 5000 Huruf!";
    } else {
      $updatedeskripsi = test_input($_POST['deskripsi']);
    }

    //   CEK NUMERIC JUMLAH
    if (!is_numeric($_POST["jmlhpenghuni"])) {
      $jumlahErr = "Jumlah Harus Berupa Angka!";
    } else {
      $updatejmlhpenghuni = test_input($_POST['jmlhpenghuni']);
    }

    //   CEK NUMERIC REKENING
    if (!is_numeric($_POST["norekening"])) {
      $rekErr = "Nomor Rekening Harus Berupa Angka!";
    } else {
      $updaterekening = test_input($_POST['norekening']);
    }

    //   CEK NUMERIC KODEPOS
    if (!is_numeric($_POST["kodepos"])) {
      $kodeposErr = "Kode Pos Harus Berupa Angka!";
    } else if (strlen($_POST["kodepos"]) != 5) {
      $kodeposErr = "Kode Pos Harus 5 Angka!";
    } else {
      $updatekodepos = test_input($_POST['kodepos']);
    }

    $data = array('susunanpengurus', 'aktanotaris', 'gambar', 'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5');
    $simpangambar = array('gambar', 'gambar1', 'gambar2', 'gambar3', 'gambar4', 'gambar5');

    if (!(empty($updatepanti) || empty($updatedeskripsi) || empty($updatejmlhpenghuni) || empty($updatenotelp) || empty($updaterekening) || empty($updatekodepos))) {
      DB::query(
        'UPDATE panti SET panti=:panti, deskripsi=:deskripsi, jmlhpenghuni=:jmlhpenghuni, namakontak=:namakontak, notelp=:notelp, bank=:bank, namarekening=:namapemilikrekening, norekening=:rekening, alamat=:alamat, kodepos=:kodepos WHERE idpanti=:idpanti',
        array(':idpanti' => $idpanti, ':panti' => $updatepanti, ':deskripsi' => $updatedeskripsi, ':jmlhpenghuni' => $updatejmlhpenghuni, ':namakontak' => $updatenamakontak, ':notelp' => $updatenotelp, ':bank' => $updatebank, ':namapemilikrekening' => $updatenamapemilikrekening, ':rekening' => $updaterekening, ':alamat' => $updatealamat, ':kodepos' => $updatekodepos)
      );
      $pemberitahuan = "Data Telah Diubah!";
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

              if ((in_array($loop, $simpangambar)) && (!empty($filenamenew))) {
                $filedestination = '../datapanti/' . $loop . '/' . $filenamenew;
                move_uploaded_file($fileTMP, $filedestination);

                if ($loop == 'gambar') {
                  unlink('../datapanti/gambar/' . $gambar);
                  DB::query('UPDATE gambar SET gambar=:gambar WHERE gambar=:gambarlama', array(':gambarlama' => $gambar, ':gambar' => $filenamenew));
                } else if ($loop == 'gambar1') {
                  if ($max > 1) {
                    unlink('../datapanti/gambar1/' . $gambar1);
                    DB::query('UPDATE gambar SET gambar=:gambar WHERE gambar=:gambarlama', array(':gambarlama' => $gambar1, ':gambar' => $filenamenew));
                  } else {
                    DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpanti, ':gambar' => $filenamenew));
                  }
                } else if ($loop == 'gambar2') {
                  if ($max > 2) {
                    unlink('../datapanti/gambar2/' . $gambar2);
                    DB::query('UPDATE gambar SET gambar=:gambar WHERE gambar=:gambarlama', array(':gambarlama' => $gambar2, ':gambar' => $filenamenew));
                  } else {
                    DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpanti, ':gambar' => $filenamenew));
                  }
                } else if ($loop == 'gambar3') {
                  if ($max > 3) {
                    unlink('../datapanti/gambar3/' . $gambar3);
                    DB::query('UPDATE gambar SET gambar=:gambar WHERE gambar=:gambarlama', array(':gambarlama' => $gambar3, ':gambar' => $filenamenew));
                  } else {
                    DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpanti, ':gambar' => $filenamenew));
                  }
                } else if ($loop == 'gambar4') {
                  if ($max > 4) {
                    unlink('../datapanti/gambar4/' . $gambar4);
                    DB::query('UPDATE gambar SET gambar=:gambar WHERE gambar=:gambarlama', array(':gambarlama' => $gambar4, ':gambar' => $filenamenew));
                  } else {
                    DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpanti, ':gambar' => $filenamenew));
                  }
                } else if ($loop == 'gambar5') {
                  if ($max > 5) {
                    unlink('../datapanti/gambar5/' . $gambar5);
                    DB::query('UPDATE gambar SET gambar=:gambar WHERE gambar=:gambarlama', array(':gambarlama' => $gambar5, ':gambar' => $filenamenew));
                  } else {
                    DB::query('INSERT INTO gambar VALUES(\'\', :idpanti, :gambar)', array(':idpanti' => $idpanti, ':gambar' => $filenamenew));
                  }
                }
              } else if (($loop == 'susunanpengurus') && (!empty($filename))) {
                $filedestination = '../datapanti/susunanpengurus/' . $filenamenew;
                move_uploaded_file($fileTMP, $filedestination);
                $updatesusunanpengurus = $filenamenew;
                DB::query('UPDATE panti SET susunanpengurus=:susunanpengurus WHERE idpanti=:idpanti', array(':susunanpengurus' => $updatesusunanpengurus, ':idpanti' => $idpanti));
                unlink('../datapanti/susunanpengurus/' . $susunanpengurus);
              } else if (($loop == 'aktanotaris') && (!empty($filename))) {
                unlink('../datapanti/aktanotaris/' . $aktanotaris);
                $updateaktanotaris = $filenamenew;
                $filedestination = '../datapanti/aktanotaris/' . $filenamenew;
                move_uploaded_file($fileTMP, $filedestination);
                DB::query('UPDATE panti SET aktanotaris=:aktanotaris WHERE idpanti=:idpanti', array(':aktanotaris' => $updateaktanotaris, ':idpanti' => $idpanti));
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
          if ($loop == 'susunanpengurus' && (!empty($_FILES['susunanpengurus']['name']))) {
            $susunanpengurusErr = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
            $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
          } else if ($loop == 'aktanotaris' && (!empty($_FILES['aktanotaris']['name']))) {
            $aktanotarisErr = 'Anda Tidak Bisa Upload File Dengan Tipe Data Ini!';
            $pemberitahuan = 'Ada Kesalahan Pada Data Yang Di Daftarkan!';
          } else if ($loop == 'gambar' && (!empty($_FILES['gambar']['name']))) {
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
  // UPDATE DATABASE DARI FORM
  // UPDATE DATABASE DARI FORM
?>
<script>
  function hasExtension(inputID, exts) {
    var fileName = document.getElementById(inputID).value;
    return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
  }

  function previewImagesusunan() {
    if (hasExtension('image-source-susunan', ['png', 'jpg', 'jpeg', 'JPEG', 'JPG', 'PNG'])) {
      document.getElementById("image-preview-susunan-update");
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source-susunan").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview-susunan-update").src = oFREvent.target.result;
      };
      var str = document.getElementById("susunanpdf").innerHTML;
      str = str.split("\\").pop()
      var res = str.replace(str, "");
      document.getElementById("susunanpdf").innerHTML = res;
    } else if (hasExtension('image-source-susunan', ['pdf'])) {
      document.getElementById("image-preview-susunan-update");
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source-susunan").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview-susunan-update").src = "assets/pdf.png";
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
      document.getElementById("image-preview-akta-update");
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source-akta").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview-akta-update").src = oFREvent.target.result;
      };
      var str = document.getElementById("aktapdf").innerHTML;
      str = str.split("\\").pop()
      var res = str.replace(str, "");
      document.getElementById("aktapdf").innerHTML = res;
    } else if (hasExtension('image-source-akta', ['pdf'])) {
      document.getElementById("image-preview-akta-update");
      var oFReader = new FileReader();
      oFReader.readAsDataURL(document.getElementById("image-source-akta").files[0]);

      oFReader.onload = function(oFREvent) {
        document.getElementById("image-preview-akta-update").src = "assets/pdf.png";
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
    document.getElementById("image-preview-gambar");
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image-source-gambar").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview-gambar").src = oFREvent.target.result;
    };
  };

  function previewImagegambar1() {
    document.getElementById("image-preview-gambar1");
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image-source-gambar1").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview-gambar1").src = oFREvent.target.result;
    };
  };

  function previewImagegambar2() {
    document.getElementById("image-preview-gambar2");
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image-source-gambar2").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview-gambar2").src = oFREvent.target.result;
    };
  };

  function previewImagegambar3() {
    document.getElementById("image-preview-gambar3");
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image-source-gambar3").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview-gambar3").src = oFREvent.target.result;
    };
  };

  function previewImagegambar4() {
    document.getElementById("image-preview-gambar4");
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("image-source-gambar4").files[0]);

    oFReader.onload = function(oFREvent) {
      document.getElementById("image-preview-gambar4").src = oFREvent.target.result;
    };
  };

  function previewImagegambar5() {
    document.getElementById("image-preview-gambar5");
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
  <link rel="stylesheet" href="css/admin.css">
  <script src="https://kit.fontawesome.com/386e6055da.js" crossorigin="anonymous"></script>
  <style>

  </style>
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
                <span><a href="beranda-admin.php">Beranda</a> > <a href="data-panti-asuhan-admin.php">Data Panti</a> > Detail Data Panti Asuhan</span>
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
                            Detail Data Panti Asuhan
                          </span>
                          <hr class="hr5">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <form action="" method="post" class="form-isi-data-panti" enctype="multipart/form-data">
                          <span class="pemberitahuan"><?php echo $pemberitahuan; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-home"></i>&nbsp;&nbsp;Nama Panti Asuhan</label>
                          <input class="input-isi-data-panti" name="nama" value="<?php echo $panti; ?>" type="text" placeholder="Masukan nama panti asuhan" required>
                          <span class="error"><?php echo $pantiErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Jumlah Penghuni Panti Asuhan</label>
                          <input class="input-isi-data-panti" name="jmlhpenghuni" value="<?php echo $jmlhpenghuni; ?>" type="text" placeholder="Masukan jumlah penghuni panti asuhan" required>
                          <span class="error"><?php echo $jumlahErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Nama Kontak</label>
                          <input class="input-isi-data-panti" name="namakontak" value="<?php echo $namakontak; ?>" type="text" placeholder="Masukan nama kontak" required>
                          <span class="error"><?php echo $namakontakErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;No Telepon</label>
                          <input class="input-isi-data-panti" name="notelp" value="<?php echo $notelp; ?>" type="text" placeholder="Masukan nomor telepon" required>
                          <span class="error"><?php echo $notelpErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Nama Bank</label>
                          <input class="input-isi-data-panti" name="bank" value="<?php echo $bank; ?>" type="text" placeholder="Masukan nama Bank" required>
                          <span class="error"><?php echo $bankErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-phone-alt"></i>&nbsp;&nbsp;Nama Pemilik Bank</label>
                          <input class="input-isi-data-panti" name="namarekening" value="<?php echo $namarekening; ?>" type="text" placeholder="Masukan nama pemilik Bank" required>
                          <span class="error"><?php echo $pemilikrekErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-credit-card"></i>&nbsp;&nbsp;Rekening</label>
                          <input class="input-isi-data-panti" name="norekening" value="<?php echo $norekening; ?>" type="text" placeholder="Masukan no. rekening" required>
                          <span class="error"><?php echo $rekErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Alamat</label>
                          <input class="input-isi-data-panti" name="alamat" value="<?php echo $alamat; ?>" type="text" placeholder="Masukan alamat panti asuhan" required>
                          <span class="error"><?php echo $alamatErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Provinsi</label>
                          <span class="input-isi-data-panti">
                            <?php echo $provinsi; ?>
                          </span>
                          <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kabupaten/Kota</label>
                          <span class="input-isi-data-panti">
                            <?php echo $kabupaten; ?>
                          </span>
                          <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kecamatan</label>
                          <span class="input-isi-data-panti">
                            <?php echo $kecamatan; ?>
                          </span>
                          <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kelurahan</label>
                          <span class="input-isi-data-panti">
                            <?php echo $kelurahan; ?>
                          </span>



                          

                          <label class="label-isi-data-panti" for=""><i class="far fa-folder"></i>&nbsp;&nbsp;Kode Pos</label>
                          <input class="input-isi-data-panti" name="kodepos" value="<?php echo $kodepos; ?>" type="text" placeholder="Masukan Kode Pos" required>
                          <span class="error"><?php echo $kodeposErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-unlock"></i>&nbsp;&nbsp;Deskripsi Panti Asuhan</label>
                          <textarea id="input-isi-data-panti-textarea" name="deskripsi" rows="5" placeholder="Masukan Deskripsi Panti Asuhan"><?php echo $deskripsi; ?>"</textarea>
                          <span class="error"><?php echo $deskripsiErr; ?></span>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Akta Notaris</label>
                          <div class="row gatauapaan">
                            <div class="linkgambar">
                              <a href="../datapanti/aktanotaris/<?php echo $aktanotaris; ?>" target="_blank">
                                <img src="<?php if (!(in_array($aktanotarisExtNew, $filegambar))) {
                                            echo 'assets/pdf.png';
                                          } else {
                                            echo '../datapanti/aktanotaris/' . $aktanotaris;
                                          } ?>" id="image-preview-akta-update" style="width: 8vw;">
                                <div id="aktapdf"><?php if (!(in_array($aktanotarisExtNew, $filegambar))) {
                                                    echo $aktanotaris;
                                                  } ?></div>
                              </a>
                            </div>
                          </div>
                          <div class="row gatauapaan">
                            <div class="upload-btn-wrapper">
                              <button class="btn">Ganti Berkas</button>
                              <input type="file" name="aktanotaris" id="image-source-akta" accept="image/*,.pdf" onchange="previewImageakta();" <?php if (empty($aktanotaris)) {
                                                                                                                                                  echo 'required';
                                                                                                                                                } ?>>
                            </div>
                            <span class="error"><?php echo $aktanotarisErr; ?></span>
                          </div>

                          <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Susunan Pengurusan Panti Asuhan</label>
                          <div class="row gatauapaan">
                            <div class="linkgambar">
                              <a href="../datapanti/susunanpengurus/<?php echo $susunanpengurus; ?>" target="_blank">
                                <img src="<?php if (!(in_array($susunanpengurusExtNew, $filegambar))) {
                                            echo 'assets/pdf.png';
                                          } else {
                                            echo '../datapanti/susunanpengurus/' . $susunanpengurus;
                                          } ?>" id="image-preview-susunan-update" style="width: 8vw;">
                                <div id="susunanpdf"><?php if (!(in_array($susunanpengurusExtNew, $filegambar))) {
                                                        echo $susunanpengurus;
                                                      } ?></div>
                              </a>
                            </div>
                          </div>
                          <div class="row gatauapaan">
                            <div class="upload-btn-wrapper">
                              <button class="btn">Ganti Berkas</button>
                              <input type="file" name="susunanpengurus" id="image-source-susunan" accept="image/*,.pdf" onchange="previewImagesusunan();" <?php if (empty($susunanpengurus)) {
                                                                                                                                                            echo 'required';
                                                                                                                                                          } ?>>
                            </div>
                            <span class="error"><?php echo $susunanpengurusErr; ?></span>
                          </div>


                          <label class="label-isi-data-panti" for=""><i class="fas fa-image"></i>&nbsp;&nbsp;Gambar Panti Asuhan</label>
                          <div class="row">
                            <div class="col nofile">
                              <img src="../datapanti/gambar/<?php echo $gambar; ?>" id="image-preview-gambar" style="width:15vw">
                            </div>
                            <div class="col nofile">
                              <img src="<?php if ($gambar1 == 'no_file.png') {
                                          echo 'assets/no_file.png';
                                        } else {
                                          echo '../datapanti/gambar1/' . $gambar1;
                                        } ?>" id="image-preview-gambar1" id="image-preview-gambar1" style="width:15vw">
                            </div>
                            <div class="col nofile">
                              <img src="<?php if ($gambar2 == 'no_file.png') {
                                          echo 'assets/no_file.png';
                                        } else {
                                          echo '../datapanti/gambar2/' . $gambar2;
                                        } ?>" id="image-preview-gambar2" style="width:15vw">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col nofile">
                              <div class="upload-btn-wrapper">
                                <button class="btn">Ganti Berkas</button>
                                <input type="file" name="gambar" id="image-source-gambar" accept="image/*" onchange="previewImagegambar();" <?php if (empty($gambar)) {
                                                                                                                                              echo 'required';
                                                                                                                                            } ?>>
                              </div>
                              <span class="error"><?php echo $gambarErr; ?></span>
                            </div>
                            <div class="col nofile">
                              <div class="upload-btn-wrapper">
                                <button class="btn">Ganti Berkas</button>
                                <input type="file" name="gambar1" id="image-source-gambar1" accept="image/*" onchange="previewImagegambar1();" s>
                              </div>
                              <span class="error"><?php echo $gambar1Err; ?></span>
                            </div>
                            <div class="col nofile">
                              <div class="upload-btn-wrapper">
                                <button class="btn">Ganti Berkas</button>
                                <input type="file" name="gambar2" id="image-source-gambar2" accept="image/*" onchange="previewImagegambar2();">
                              </div>
                              <span class="error"><?php echo $gambar2Err; ?></span>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col nofile">
                              <img src="<?php if ($gambar3 == 'no_file.png') {
                                          echo 'assets/no_file.png';
                                        } else {
                                          echo '../datapanti/gambar3/' . $gambar3;
                                        } ?>" id="image-preview-gambar3" style="width:15vw">
                            </div>
                            <div class="col nofile">
                              <img src="<?php if ($gambar4 == 'no_file.png') {
                                          echo 'assets/no_file.png';
                                        } else {
                                          echo '../datapanti/gambar4/' . $gambar4;
                                        } ?>" id="image-preview-gambar4" style="width:15vw">
                            </div>
                            <div class="col nofile">
                              <img src="<?php if ($gambar5 == 'no_file.png') {
                                          echo 'assets/no_file.png';
                                        } else {
                                          echo '../datapanti/gambar5/' . $gambar5;
                                        } ?>" id="image-preview-gambar5" style="width:15vw">
                            </div>
                          </div>
                          <div class="row">
                            <div class="col nofile">
                              <div class="upload-btn-wrapper">
                                <button class="btn">Ganti Berkas</button>
                                <input type="file" name="gambar3" id="image-source-gambar3" accept="image/*" onchange="previewImagegambar3();">
                              </div>
                              <span class="error"><?php echo $gambar3Err; ?></span>
                            </div>
                            <div class="col nofile">
                              <div class="upload-btn-wrapper">
                                <button class="btn">Ganti Berkas</button>
                                <input type="file" name="gambar4" id="image-source-gambar4" accept="image/*" onchange="previewImagegambar4();">
                              </div>
                              <span class="error"><?php echo $gambar4Err; ?></span>
                            </div>
                            <div class="col nofile">
                              <div class="upload-btn-wrapper">
                                <button class="btn">Ganti Berkas</button>
                                <input type="file" name="gambar5" id="image-source-gambar5" accept="image/*" onchange="previewImagegambar5();">
                              </div>
                              <span class="error"><?php echo $gambar5Err; ?></span>
                            </div>
                          </div>
                          <input class="bt-daftar-admin" type="submit" name="submit" value="Simpan">
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