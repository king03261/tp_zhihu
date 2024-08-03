<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/header.php"; ?>

<div class="content content-center">

    <form class="form" action="" method="post">
        <?php if (!is_null($error)) : ?>
            <p style="color:red;"><?= $error ?></p>
        <?php endif; ?>
        <p>昵称</p>
        <input type="text" name="nickname">
        <p>邮箱</p>
        <input id="email" type="email" name="email">
        <a href="javascript:;" onclick="sendEmail()">发邮件</a>
        <p>验证码</p>
        <input type="text" name="email-code">
        <p>密码</p>
        <input type="password" name="password">
        <p>确认密码</p>
        <input type="password" name="repassword">
        <p></p>
        <button type="submit">注册</button>
    </form>
</div>

<script>

    function sendEmail() {
        console.log("asda");
        var e = document.querySelector("#email").value
        window.location.href = "/account/send-mail?email=" + e;
    }
</script>

<?php require_once "/Users/chenzitao/projects/zhihu/view/layout/footer.php"; ?>