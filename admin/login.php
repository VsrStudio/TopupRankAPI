<?php
require '../includes/db.php';
require '../includes/auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: /admin/dashboard.php');
        exit();
    } else {
        $message = 'Login gagal. Username atau password salah.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
    <div class="container">
        <h2>Login Admin</h2>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p><?= htmlspecialchars($message) ?></p>
    </div>
</body>
</html>
