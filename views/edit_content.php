<?php
// views/edit_content.php
// $todo 変数は親のスコープから渡されることを想定
?>
<h1>TODO編集</h1>
<?php if (isset($todo) && $todo): ?>
    <form action="update.php" method="POST" class="flex-column">
        <input type="hidden" name="id" value="<?= htmlspecialchars($todo['id']) ?>">


        <label for="content">TODO内容:</label>
        <input
            type="text"
            id="content"
            name="content"
            value="<?= htmlspecialchars($todo['content']) ?>"
            required
        >
         <div>
            <label for="detail">内容:<nr></label>
            <textarea name="detail" id="detail" cols="30" rows="10"><?= htmlspecialchars($todo['detail']) ?></textarea>
        </div>

        <div class="checkbox-group">
            <input
                type="checkbox"
                id="is_completed"
                name="is_completed"
                <?= $todo['is_completed'] ? 'checked' : '' ?>
            >
            <label for="is_completed">完了</label>
        </div>
        <button type="submit">更新</button>
    </form>
<?php else: ?>
    <p>TODOが見つかりませんでした。</p>
<?php endif; ?>


<a href="index.php" class="back-link">TODOリストに戻る</a>
