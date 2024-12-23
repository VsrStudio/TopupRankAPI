<?php
require '../includes/db.php';
require '../includes/auth.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: /user/history.php');
        exit();
    } else {
        $message = 'Login gagal. Username atau password salah.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Pengguna</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" required>
        <label>Password</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
    <p><?= $message ?></p>
</body>
</html>
