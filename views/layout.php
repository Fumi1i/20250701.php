<?php
// views/layout.php
// $pageTitle と $content_path は、このファイルをrequireするファイルで定義されることを想定
if (!isset($pageTitle)) {
    $pageTitle = 'TODOアプリ'; // デフォルトのタイトル
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <!-- 共通のスタイルシートを読み込む -->
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container">
        <!-- 各ページのコンテンツがここに埋め込まれる -->
        <?php
        if (isset($content_path) && file_exists($content_path)) {
            require $content_path;
        } else {
            // コンテンツパスが設定されていないか、ファイルが存在しない場合のフォールバック
            echo '<p>コンテンツが読み込めませんでした。</p>';
        }
        ?>
    </div>
</body>
</html>
