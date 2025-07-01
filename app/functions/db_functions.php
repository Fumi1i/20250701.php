<?php
/**
 * データベース接続を確立し、PDOオブジェクトを返す
 * @param array $config データベース接続設定
 * @return PDO
 * @throws PDOException データベース接続に失敗した場合
 */
function get_pdo(array $config): PDO
{
    $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
    try {
        $pdo = new PDO($dsn, $config['user'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    } catch (PDOException $e) {
        die("データベース接続エラー: " . $e->getMessage()); // 直接終了させる
    }
}


/**
 * 全てのTODOアイテムを取得する
 * @param PDO $pdo
 * @return array
 */
function get_all_todo_items(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT * FROM todo_items ORDER BY created_at DESC");
    return $stmt->fetchAll();
}

/**
 * 特定のTODOアイテムをIDで検索する
 * @param PDO $pdo
 * @param int $id
 * @return array|false
 */
function find_todo_item_by_id(PDO $pdo, int $id)
{
    $stmt = $pdo->prepare("SELECT * FROM todo_items WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}

/**
 * TODOアイテムを更新する
 * @param PDO $pdo
 * @param int $id
 * @param string $content
 * @param string $detail
 * @param bool $isCompleted
 * @return bool
 */
function update_todo_item(PDO $pdo, int $id, string $content, bool $isCompleted): bool
{
    $stmt = $pdo->prepare("UPDATE todo_items SET content = :content, is_completed = :is_completed WHERE id = :id");
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    $stmt->bindParam(':is_completed', $isCompleted, PDO::PARAM_BOOL);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}


/**
 * 新しいTODOアイテムを作成する
 * @param PDO $pdo
 * @param string $content
 * @return bool
 */
function create_todo_item(PDO $pdo, string $content): bool
{
    $stmt = $pdo->prepare("INSERT INTO todo_items (content) VALUES (:content)");
    $stmt->bindParam(':content', $content, PDO::PARAM_STR);
    return $stmt->execute();
}

/**
 * TODOアイテムの完了状態をトグルする
 * @param PDO $pdo
 * @param int $id
 * @param bool $isCompleted
 * @return bool
 */
function toggle_todo_item_complete(PDO $pdo, int $id, bool $isCompleted): bool
{
    $stmt = $pdo->prepare("UPDATE todo_items SET is_completed = :is_completed WHERE id = :id");
    $stmt->bindParam(':is_completed', $isCompleted, PDO::PARAM_BOOL);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}

/**
 * TODOアイテムを削除する
 * @param PDO $pdo
 * @param int $id
 * @return bool
 */
function delete_todo_item(PDO $pdo, int $id): bool
{
    $stmt = $pdo->prepare("DELETE FROM todo_items WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    return $stmt->execute();
}


