<?php
require '../includes/db.php';
require '../includes/auth.php';

requireAdmin();

$result = $conn->query("SELECT * FROM transactions ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h1>Dashboard Admin</h1>
    <a href="logout.php">Logout</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
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
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['rank']) ?></td>
                    <td><?= htmlspecialchars($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['message']) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
