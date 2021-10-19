<?php
	include '../class/DB.php';
	$provinsi = $_POST['provinsi'];
 
	echo "<option value=''>Pilih Kabupaten</option>";
 
    $query = DB::query('SELECT * FROM kabupaten WHERE id_prov=:id_prov ORDER BY nama ASC', array(':id_prov'=>$provinsi));
	foreach ($query as $row) {
		echo "<option value='" . $row['id_kab'] . "'>" . $row['nama'] . "</option>";
	}
?>