<?php 
$host = getenv('DB_HOST') ?: '127.0.0.1';
$port = getenv('DB_PORT') ?: '3306';
$dbname = getenv('DB_DATABASE') ?: 'arengapp_bd';
$username = getenv('DB_USERNAME') ?: 'arengapp_admin';
$password = getenv('DB_PASSWORD') !== false ? getenv('DB_PASSWORD') : 'arengapp_secret';

$options = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $db = new PDO("mysql:host={$host};port={$port};dbname={$dbname};charset=utf8", $username, $password, $options);
} catch (PDOException $ex) {
    // Fallback gracefully so UI still loads even if DB is offline during build/checks
    $db = null;
    $db_error = $ex->getMessage();
}

if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
    function undo_magic_quotes_gpc(&$array) {
        foreach ($array as &$value) {
            if (is_array($value)) {
                undo_magic_quotes_gpc($value);
            } else {
                $value = stripslashes($value);
            }
        }
    }
    undo_magic_quotes_gpc($_POST);
    undo_magic_quotes_gpc($_GET);
    undo_magic_quotes_gpc($_COOKIE);
}

@header('Content-Type: text/html; charset=utf-8');
?>
