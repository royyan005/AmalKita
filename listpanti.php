<?php
include('class/DB.php');
$pdo = new PDO("mysql:host=localhost;dbname=amalkita", "root", "");
$query = "select * from panti";
$d = $pdo->query($query);


if (isset($_POST['delete'])) {
    $idpanti = $_POST['idpanti'];
    $query = "DELETE FROM panti WHERE idpanti IN(".implode(",", $idpanti).")";
    $sql = $pdo->prepare($query);
    $sql->execute();
    header("location: listpanti.php");   
    }

if (isset($_POST['insert'])) {
    header("location: daftarkanpanti.php");
}
?>

<form method="post" action="listpanti.php">
	<input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure?')"/>
    <input type="submit" name="insert" value="Insert"/>
	<table cellpadding="2" cellspacing="2" border="1">
		<tr>
			<th></th>
			<th>Panti</th>
			<th>Jumlah Penghuni</th>
			<th>No Telp</th>
            <th>Susunan Pengurus</th>
            <th>Akta Notaris</th>
            <th>Rekening</th>
            <th>Alamat</th>
            <th>Kecamatan</th>
            <th>Kode Pos</th>
		</tr>
        <?php   
        foreach($d as $data) {
        ?>
        <tr>
        <td><input type="checkbox" class="check-item" name="idpanti[]" value="<?php echo $data['idpanti']; ?>"></td>
        <td><?php echo $data['panti']; ?></td>
        <td><?php echo $data['jmlhpenghuni']; ?></td>
        <td><?php echo $data['notelp']; ?></td>
        <td><?php echo $data['susunanpengurus']; ?></td>
        <td><?php echo $data['aktanotaris']; ?></td>
        <td><?php echo $data['rekening']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['kecamatan']; ?></td>
        <td><?php echo $data['kodepos']; ?></td>
        </tr>
        <?php 
        }
     ?>
	</table>
</form>


