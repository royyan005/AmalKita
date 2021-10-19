<?php
include('class/DB.php');

if (isset($_POST['daftar'])) {
        $panti = $_POST['nama'];
        $jmlpenghuni = $_POST['jmlpenghuni'];
        $notelp = $_POST['notelp'];
        $susunanpengurus = $_POST['susunanpengurus'];
        $aktanotaris = $_POST['akta'];
        $rekening = $_POST['rekening'];
        $alamat = $_POST['alamat'];
        $kecamatan = $_POST['kecamatan'];
        $kodepos = $_POST['kodepos'];

        DB::query('INSERT INTO panti VALUES (\'\', :panti, :jmlpenghuni, :notelp, :susunanpengurus, :aktanotaris, :rekening, :alamat, :kecamatan, :kodepos)', 
        array(':panti'=>$panti, ':jmlpenghuni'=>$jmlpenghuni, ':notelp'=>$notelp, ':susunanpengurus'=>$susunanpengurus, ':aktanotaris'=>$aktanotaris,
        ':rekening'=>$rekening, ':alamat'=>$alamat, ':kecamatan'=>$kecamatan, ':kodepos'=>$kodepos));

}

if (isset($_POST['list'])) {
        header("location: listpanti.php");
}
?>

<h1>Daftar</h1>
<form action="daftarkanpanti.php" method="post">
<input type="text" name="nama" value="" placeholder="Masukkan nama panti asuhan"><p />
<input type="text" name="jmlpenghuni" value="" placeholder="Masukkan jumlah penghuni panti asuhan"><p />
<input type="text" name="notelp" value="" placeholder="Nomor telepon ..."><p />
<input type="text" name="susunanpengurus" value="" placeholder="Susunan Pengurus.."><p />
<input type="text" name="akta" value="" placeholder="Akta ..."><p />
<input type="text" name="rekening" value="" placeholder="Nomor rekening ..."><p />
<input type="text" name="alamat" value="" placeholder="Alamat panti ..."><p />
<input type="text" name="kecamatan" value="" placeholder="Kecamatan panti ..."><p />
<input type="text" name="kodepos" value="" placeholder="Kode pos ..."><p />
<input type="submit" name="daftar" value="Daftarkan panti">
<input type="submit" name="list" value="Lihat List"/>
</form>
