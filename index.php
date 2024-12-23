<?php
require 'includes/db.php';
require 'includes/auth.php';

if (isLoggedIn()) {
    if (isAdmin()) {
        header('Location: /admin/dashboard.php');
    } else {
        header('Location: /user/history.php');
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Topup Rank</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
    <header>
        <h1>Topup Rank</h1>
        <p>Platform terbaik untuk membeli rank Anda!</p>
    </header>
    <div class="container">
        <h2>Selamat Datang</h2>
        <p>Silakan login untuk melanjutkan:</p>
        <a href="/user/login.php" class="button">Login Pengguna</a>
        <a href="/admin/login.php" class="button">Login Admin</a>
    </div>
</body>
</html>
