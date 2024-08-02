<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>知乎</title>
    <style>
        html,
        body {
            padding: 0;
            margin: 0;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        a {
            color: #8491a5;
            text-decoration: none;
            transition-timing-function: ease-in;
        }

        a:hover {
            color: #777;
        }

        .header {
            width: 100%;
            background-color: #fff;
            /* border-bottom: 1px solid #eee; */
            box-shadow: oklch(0 0 0 / 0.1) 0px 1px 3px 0px;

        }

        .header-content {
            width: 800px;
            margin: 0 auto;
            display: flex;
            height: 50px;
            justify-content: space-between;
            align-items: center;
        }

        .main {
            flex: 1;
        }

        .main .content {
            width: 800px;
            min-height: 500px;
            margin: 30px auto;
        }

        .main .content-center {
            display: flex;
            align-items: center;
        }

        .form {
            width: 320px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            border: 1px solid #eee;
        }

        .form input {
            width: 100%;
            height: 25px;
            box-sizing: border-box;
        }

        .form textarea {
            width: 100%;
            box-sizing: border-box;
            height: 120px;
        }

        .form button {
            width: 100%;
            height: 30px;
            margin-top: 20px;
        }

        .footer {
            background: #fff;
            height: 60px;
            padding: 10px;
            text-align: center;
            color: #999;
            font-size: 14px;
            line-height: 60px;
        }

        .user-content {
            display: flex;
            gap: 10px;
        }

        .user {
            position: relative;
        }

        .user-menu {
            position: absolute;
            left: -30px;
            width: 100px;
            background-color: #fff;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            border: 1px solid #eee;
            display: none;
        }

        .user:hover .user-menu {
            display: flex !important;
        }

        .box {
            box-shadow: oklch(0 0 0 / 0.1) 0px 1px 3px 0px;
            background-color: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
        }

        .qlist {
            display: flex;
            gap: 10px;
            flex-direction: column;
        }

        .qlist .item {}

        .qlist .item a {
            color: #333;
        }

        .qlist .item p {
            color: #999;
        }

        .btn {}
    </style>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <a href="/">知乎</a>
            <div class="right">
                <?php if (isset($user)) : ?>
                    <div class="user-content">
                        <a class="btn" href="/user/add-question">提问题</a>
                        <div class="user">
                            <a href="/space/<?= $user["id"]; ?>"><?= $user["nickname"] ?></a>
                            <div class="user-menu">
                                <a href="/account/logout">退出登陆</a>
                                <a href="">退出登陆</a>
                                <a href="">退出登陆</a>
                                <a href="">退出登陆</a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <a href="/account/login">登陆</a>
                    <a href="/account/register">注册</a>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <main class="main">