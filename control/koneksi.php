<?php 
$host = "localhost";
$username = "root";
$password = "";
$database = "db_desa";

$mysqli = new mysqli($host, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Koneksi gagal :" . $mysqli->connect_error);
}
?>