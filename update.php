
<?php
require_once __DIR__ . '/app/Functions/db_functions.php';


$dbConfig = require __DIR__ . '/config/database.php';
try {
    $pdo = get_pdo($dbConfig);
} catch (PDOException $e) {
    die("アプリケーション起動エラー: " . $e->getMessage());
}


if (
    $_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['id'])
    && isset($_POST['content'])
    ) {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $content = trim($_POST['content']);
    $detail = htmlspecialchars($_POST['detail'],ENT_QUOTES,'UTF-8');
    $isCompleted = isset($_POST['is_completed']) ? 1 : 0;


    if ($id && !empty($content)) {
        update_todo_item($pdo, $id, $content, $detail, (bool)$isCompleted);
    }
}


// 処理後、一覧ページにリダイレクト
header('Location: index.php');
exit;
