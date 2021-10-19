<?php
	include '../class/DB.php';
	$kabupaten = $_POST['kabupaten'];
 
	echo "<option value=''>Pilih Kecamatan</option>";

    $query = DB::query('SELECT * FROM kecamatan WHERE id_kab=:id_kab ORDER BY nama ASC', array(':id_kab'=>$kabupaten));
	foreach ($query as $row) {
		echo "<option value='" . $row['id_kec'] . "'>" . $row['nama'] . "</option>";
	}
?>