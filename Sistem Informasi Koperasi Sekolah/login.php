<?php
require_once __DIR__ . '/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$auth = require __DIR__ . '/config/auth.php';
$username = requestText($_POST, 'username');
$password = isset($_POST['password']) && is_string($_POST['password'])
    ? $_POST['password']
    : '';

if (
    hash_equals($auth['username'], $username)
    && password_verify($password, $auth['password_hash'])
) {
    session_regenerate_id(true);

    $_SESSION['auth_user'] = [
        'username' => $auth['username'],
        'name' => $auth['display_name'],
    ];

    unset($_SESSION['login_error'], $_SESSION['login_username']);
    $_SESSION['login_notice'] = 'Login berhasil. Semua menu pengelolaan tetap bisa digunakan, baik login maupun tidak.';

    header('Location: index.php');
    exit;
}

$_SESSION['login_error'] = 'Username atau password salah. Kamu tetap bisa mengelola data tanpa login.';
$_SESSION['login_username'] = $username;
header('Location: index.php#login');
exit;
