<?php

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'school_login_db';

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $db = new mysqli(DB_HOST, DB_USER, DB_PASS);
    $db->set_charset('utf8mb4');
    $db->query('CREATE DATABASE IF NOT EXISTS `school_login_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci');
    $db->select_db(DB_NAME);
    $db->query("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('admin','student') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");

    
    $demo = [
        ['System Administrator', 'admin', 'Admin123!', 'admin'],
        ['Second Administrator', 'admin2', 'Admin234!', 'admin'],
        ['Student One', 'student1', 'Student123!', 'student'],
        ['Student Two', 'student2', 'Student234!', 'student'],
    ];

    $check = $db->prepare('SELECT id FROM users WHERE username = ?');
    $insert = $db->prepare('INSERT INTO users (full_name, username, password, role) VALUES (?, ?, ?, ?)');

    foreach ($demo as [$name, $username, $password, $role]) {
        $check->bind_param('s', $username);
        $check->execute();

        if (!$check->get_result()->fetch_assoc()) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $insert->bind_param('ssss', $name, $username, $hash, $role);
            $insert->execute();
        }
    }
} catch (mysqli_sql_exception $e) {
    error_log('Database error: ' . $e->getMessage());
    http_response_code(500);
    exit('Database connection or setup failed. Check MySQL in XAMPP and db.php settings.');
}

function start_secure_session(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        ini_set('session.use_strict_mode', '1');

        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
            'httponly' => true,
            'samesite' => 'Lax'
        ]);

        session_start();
    }

    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');
    header('Expires: 0');
}

function destination(): string
{
    return ($_SESSION['role'] ?? '') === 'admin' ? 'home.php' : 'home2.php';
}

function require_role(string $role): void
{
    start_secure_session();

    if (empty($_SESSION['user_id'])) {
        header('Location: index.php');
        exit;
    }

    if (($_SESSION['role'] ?? '') !== $role) {
        header('Location: ' . destination());
        exit;
    }
}
