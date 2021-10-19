<?php
include('database.php');
include('Login.php');

if (!Login::isLoggedIn()){
    die("Sudah Keluar Ce.");
}

if (isset($_POST['confirm'])) {

    if (isset($_POST['alldevices'])) {                
        
        DB::query('DELETE FROM logintoken WHERE idadmin=:idadmin', array(':idadmin'=>Login::isLoggedIn()));

    } else {
            if (isset($_COOKIE['SNID'])) {
                DB::query('DELETE FROM logintoken WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
            }
            setcookie('SNID', '1', time()-3600);
            setcookie('SNID_', '1', time()-3600);
    }
}
?>
<h1>Logout of Your Account?</h1>
<p>Are you sure you'd like to logout ?</p>
<form action="logout.php" method="post">
        <input type="checkbox" name="alldevices" value="alldevices"> logout of all device?<br/>
        <input type="submit" name="confirm" values="Confirm">
</form>