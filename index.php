<?php
//DB情報の取得
require_once __DIR__ . '/app/Functions/db_functions.php';


// データベース設定を読み込む
$dbConfig = require __DIR__ . '/config/database.php';


// データベース接続を初期化
try {
    $pdo = get_pdo($dbConfig);
} catch (PDOException $e) {
    die("アプリケーション起動エラー: " . $e->getMessage());
}


// 全てのTODOアイテムを取得
$todos = get_all_todo_items($pdo);


// ページタイトルを設定
$pageTitle = 'TODOリスト';


// 読み込むコンテンツファイルを指定
$content_path = __DIR__ . '/views/index_content.php';


// レイアウトファイルを読み込み、コンテンツを埋め込む
require_once __DIR__ . '/views/layout.php';
