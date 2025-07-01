<?php
// toggle_complete.php
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
        $todo = find_todo_item_by_id($pdo, $id);
        if ($todo) {
            $newStatus = $todo['is_completed'] ? 0 : 1;
            toggle_todo_item_complete($pdo, $id, (bool)$newStatus);
        }
    }
}


// 処理後、一覧ページにリダイレクト
header('Location: index.php');
exit;
