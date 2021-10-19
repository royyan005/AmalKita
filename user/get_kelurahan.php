<?php
	include '../class/DB.php';
	$kecamatan = $_POST['kecamatan'];
 
	echo "<option value=''>Pilih Kelurahan</option>";
    
    $query = DB::query('SELECT * FROM kelurahan WHERE id_kec=:id_kec ORDER BY nama ASC', array(':id_kec'=>$kecamatan));
	foreach ($query as $row) {
		echo "<option value='" . $row['id_kel'] . "'>" . $row['nama'] . "</option>";
	}
?>
