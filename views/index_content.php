<?php
// views/index_content.php
// $todos 変数は親のスコープから渡されることを想定
?>
<h1>TODOリスト</h1>


<form action="store.php" method="POST">
    <input type="text" name="content" placeholder="新しいTODOを追加" required>
    <button type="submit">追加</button>
</form>


<ul>
    <?php if (empty($todos)): ?>
        <li>TODOアイテムはありません。</li>
    <?php else: ?>
        <?php foreach ($todos as $todo): ?>
            <li class="<?= $todo['is_completed'] ? 'completed' : '' ?>">
                <span><?= htmlspecialchars($todo['content']) ?></span>
                <div class="actions">
                    <form action="toggle_complete.php" method="POST">
                        <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                        <button
                            type="submit"
                            class="toggle-btn
                            <?= $todo['is_completed'] ? 'completed' : '' ?>"
                        >
                            <?= $todo['is_completed'] ? '未完了にする' : '完了にする' ?>
                        </button>
                    </form>
                    <a href="edit.php?id=<?= $todo['id'] ?>" class="actions edit">編集</a>
                    <form
                        action="destroy.php"
                        method="POST"
                        onsubmit="return confirm('本当に削除しますか？');"
                    >
                        <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                        <button type="submit" class="actions delete">削除</button>
                    </form>
                </div>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>

