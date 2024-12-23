<?php
$host = 'localhost';
$user = 'root';
$pass = 'password';
$dbname = 'topuprank';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
