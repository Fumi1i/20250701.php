<?php
// destroy.php
require_once __DIR__ . '/app/Functions/db_functions.php';


$dbConfig = require __DIR__ . '/config/database.php';
try {
    $pdo = get_pdo($dbConfig);
} catch (PDOException $e) {
    die("アプリケーション起動エラー: " . $e->getMessage());
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        delete_todo_item($pdo, $id);
    }
}


// 処理後、一覧ページにリダイレクト
header('Location: index.php');
exit;
