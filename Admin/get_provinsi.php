<?php
	include '../class/DB.php';
 
	echo "<option value=''>Pilih Provinsi</option>";
 
	$query = DB::query('SELECT * FROM provinsi ORDER BY nama ASC');
	foreach ($query as $row) {
		echo "<option value='" . $row['id_prov'] . "'>" . $row['nama'] . "</option>";
	}


?>