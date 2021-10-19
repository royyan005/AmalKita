<?php

class Login {
    public static function isLoggedIn() {
    
        if (isset($_COOKIE['SNID'])) {
            if (DB::query('SELECT idadmin FROM logintoken WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))) {
                    $idadmin = DB::query('SELECT idadmin FROM logintoken WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['idadmin'];
                    
                    if (isset($_COOKIE['SNID_'])){
                    return $idadmin; 
                    } else {
                        $cstrong = True;
                        $token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong)) ;
                        DB::query('INSERT INTO logintoken VALUES (\'\', :token, :idadmin)', array(':token'=>sha1($token), ':idadmin'=>$idadmin));
                        DB::query('DELETE FROM logintoken WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
    
                        setcookie("SNID", $token, time() + 60 * 60 * 24 * 7, '/', NULL, NULL, TRUE);
                        setcookie("SNID_", '1', time() + 60 * 60 * 24 * 3, '/', NULL, NULL, TRUE);
    
                        return $idadmin;
                    }
            }
        }
    
        return false;
    }
}
?>