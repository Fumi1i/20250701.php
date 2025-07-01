<?php
require_once __DIR__ . '/app/Functions/db_functions.php';


$dbConfig = require __DIR__ . '/config/database.php';
try {
    $pdo = get_pdo($dbConfig);
} catch (PDOException $e) {
    die("アプリケーション起動エラー: " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content']) && !empty($_POST['content'])) {
    $content = trim($_POST['content']);
    create_todo_item($pdo, $content);
}


// 処理後、一覧ページにリダイレクト
header('Location: index.php');
exit;
