<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/header.php"; ?>

<div class="content content-center">
    <form class="form" action="" method="post">
        <h3>问题</h3>
        <p><?=$question["title"]?></p>
        <?php if (!is_null($error)) : ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
        <p>回答问题</p>
        <input type="hidden" name="qid" value="<?=$question["id"]?>">
        <textarea name="content"><?=$input["content"] ?? ''?></textarea>
        <p></p>
        <button type="submit">提交</button>
    </form>
</div>

<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/footer.php"; ?>