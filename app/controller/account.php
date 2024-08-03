<?php

namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\Session;
use think\facade\Validate;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

class Account extends BaseController
{
    function login() {
        return view("",[
            "info" => Session::get("info"),
            "error" => Session::get("error"),
        ]);
    }

    function login_post() {
        $input = request()->param();
        $validate = Validate::rule([
            'email' => 'require|email',
            'password' => 'require|min:6|max:20',
        ]);
        $validate->message([
            'email.require'  => '邮箱是必须的',
            'email.email'    => '邮箱格式错误',
            'password.require' => '密码是必须的',
            'password.min' => '密码最少不能少于 6 个字符',
            'password.max' => '密码最多不能超过 20 个字符',
        ]);
        if (!$validate->check($input)) {
            $err = $validate->getError();
            Session::flash('error', $err);
            return redirect("/account/login");
        }
        $user = Db::table("users")->where("email", $input["email"])->find();
        if (is_null($user)) {
            Session::flash('error', "邮箱未注册");
            return redirect("/account/login");
        }
        if ($user["password"] != md5($input["password"]."123")) {
            Session::flash('error', "密码输入错误");
            return redirect("/account/login");
        }
        Session::set('user', $user);
        return redirect("/");
    }

    function register() {
        return view("",[
            "error" => Session::get("error"),
        ]);
    }

    function register_post() {
        $input = request()->param();
        $validate = Validate::rule([
            'nickname'  => 'require|min:3|max:10',
            'email' => 'require|email',
            'password' => 'require|min:6|max:20',
        ])->rule([
            "repassword" => function($value) use ($input) {
                return $input["password"] == $input["repassword"];
            }
        ]);
        $validate->message([
            'nickname.require' => '昵称是必须的',
            'nickname.min'     => '昵称最少不能少于 3 个字符',
            'nickname.max'     => '昵称最多不能超过 10 个字符',
            'email.require'  => '邮箱是必须的',
            'email.email'        => '邮箱格式错误',
            'password.require' => '密码是必须的',
            'password.min' => '密码最少不能少于 6 个字符',
            'password.max' => '密码最多不能超过 20 个字符',
            'repassword.' => '两次密码输入不一致',
        ]);
        if (!$validate->check($input)) {
            $err = $validate->getError();
            if ($err == "") {
                $err = "两次密码输入不一致";
            }
            Session::flash('error', $err);
            return redirect("/account/register");
        }

        if (!is_null(Db::table("users")->where("email", $input["email"])->find())) {
            Session::flash('error', "邮箱已注册");
            return redirect("/account/register");
        }
        unset($input["repassword"]);
        $input["created_at"] = time();
        $input["password"] = md5($input["password"] . "123");
        if (!Db::table("users")->insertGetId($input)) {
            Session::flash('error', "服务器异常");
            return redirect("/account/register");
        }
        
        Session::flash('info', "注册成功");
        return redirect("/account/login");
    }

    function logout() {
        Session::delete('user');
        return redirect("/account/login");
    }

    function send_mail() {
        $code = rand(100000,999999);
        Db::table("codes")->save([
            "content" => $code,
            "created_at" => time(),
        ]);
        // https://github.com/symfony/mailer
        $input = request()->param();
        //smtp://user:pass@smtp.example.com:25
        $transport = Transport::fromDsn('smtp://:@smtp.163.com:25');
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from('@163.com')
            ->to($input["email"])
            ->subject('TP知乎网')
            ->text("你的邮箱验证码是 {$code}, 打死都不能告诉别人,十分钟有效。");
            // ->html('<p>See Twig integration for better HTML integration!</p>');
        $mailer->send($email);
        return redirect("/account/register");
    }
}
