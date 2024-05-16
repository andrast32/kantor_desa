<?php 
error_reporting( error_reporting() & ~E_NOTICE );
include "../control/koneksi.php";
    if(isset($_GET['surat'])) {
        include "theme/sidebar/ss.php";
        include("view/surat/".$_GET['surat'].".php");
    } elseif (isset($_GET['user'])) {
        include "theme/sidebar/su.php";
        include ("view/user/".$_GET['user'].".php");
    }
    
    else {
        include "theme/sidebar/sh.php";
        include "fungsi/dashboard.php";
    }

?>