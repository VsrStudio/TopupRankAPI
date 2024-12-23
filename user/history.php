<?php
require '../includes/db.php';
require '../includes/auth.php';

requireLogin();

$username = $_SESSION['user']['username'];

$stmt = $conn->prepare("SELECT * FROM transactions WHERE username = ? ORDER BY id DESC");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
    <div class="container">
        <h1>Riwayat Transaksi</h1>
        <p>Halo, <?= htmlspecialchars($username) ?>! Berikut adalah riwayat transaksi Anda:</p>
        <a href="logout.php" class="button">Logout</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Rank</th>
                    <th>Status</th>
                    <th>Pesan</th>
                    <th>Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['rank']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td><?= htmlspecialchars($row['message']) ?></td>
                        <td><?= $row['created_at'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
