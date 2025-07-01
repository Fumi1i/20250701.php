<?php
//DB設定
require_once __DIR__ . '/app/Functions/db_functions.php';
//DBの操作
$dbConfig = require __DIR__ . '/config/database.php';
try {
    $pdo = get_pdo($dbConfig);
} catch (PDOException $e) {
    die("アプリケーション起動エラー: " . $e->getMessage());
}


$todo = false;
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $todo = find_todo_item_by_id($pdo, $id);
}


// IDが無効、またはTODOが見つからない場合は一覧へリダイレクト
if (!$todo) {
    header('Location: index.php');
    exit;
}


// ページタイトルを設定
$pageTitle = 'TODO編集';
// 読み込むコンテンツファイルを指定
$content_path = __DIR__ . '/views/edit_content.php';


// レイアウトファイルを読み込み、コンテンツを埋め込む
require_once __DIR__ . '/views/layout.php';
