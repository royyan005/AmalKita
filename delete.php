<?php
include "class/DB.php";

$pdo = new PDO("mysql:host=localhost;dbname=amalkita", "root", "");
$query = "select * from panti";
$d = $pdo->query($query);

if (isset($_POST['delete'])) {
$idpanti = $_POST['idpanti'];
$query = "DELETE FROM panti WHERE idpanti IN(".implode(",", $idpanti).")";
$sql = $pdo->prepare($query);
$sql->execute();   
}
?>
