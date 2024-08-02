<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/header.php"; ?>

<div class="content box">
    <div>
        <a href="/">推荐</a>
        <a href="/hot">热榜</a>
    </div>
    <div class="qlist">
        <?php foreach($questions as $question): ?>
        <div class="item">
            <h3><a href="/question/<?=$question["id"]?>"><?=$question["title"]?></a></h3>
            <p><?=mb_substr($question["discription"],0,80)?>...</p>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/footer.php"; ?>