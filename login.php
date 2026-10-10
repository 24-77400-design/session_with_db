<?php
require_once __DIR__ . '/db.php';
start_secure_session();

if (!empty($_SESSION['user_id'])) {
    header('Location: ' . destination());
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $db->prepare('SELECT id, full_name, username, password, role FROM users WHERE username = ? LIMIT 1');
$stmt->bind_param('s', $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if (!$user || !password_verify($password, $user['password'])) {
    header('Location: index.php?error=1');
    exit;
}

session_regenerate_id(true);
$_SESSION['user_id'] = (int) $user['id'];
$_SESSION['name'] = $user['full_name'];
$_SESSION['role'] = $user['role'];

header('Location: ' . destination());
exit;
