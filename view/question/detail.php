<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/header.php"; ?>

<div class="content">
    <div class="box">
        <h1><?=$question["title"]?></h1>
        <a href="/space/<?=$question["user_id"]?>"><?=$question["nickname"]?></a>
        <p><?=$question["discription"]?></p>
        <p>
            <a href="/user/add-answer?question_id=<?=$question["id"]?>">写回答</a>
        </p>
    </div>
    <?php foreach($answers as $answer): ?>
    <div class="box">
        <p><a href="/space/<?=$answer["user_id"]?>"><?=$answer["nickname"]?></a></p>
        <?=$answer["content"]?>
    </div>
    <?php endforeach; ?>
</div>



<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/footer.php"; ?>