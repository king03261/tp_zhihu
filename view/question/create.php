<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/header.php"; ?>

<div class="content content-center">
    <form class="form" action="" method="post">
        <h3>提问题</h3>
        <?php if (!is_null($error)) : ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
        <p>问题标题</p>
        <input type="text" name="title" value="<?=$input["title"] ?? ''?>">
        <p>问题描述</p>
        <textarea name="discription"><?=$input["discription"] ?? ''?></textarea>
        <p></p>
        <button type="submit">提交</button>
    </form>
</div>

<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/footer.php"; ?>