<?php

namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\Session;
use think\facade\Validate;

class Question extends BaseController
{
    function list()
    {
        // dd();
        return view("", [
            "user" => Session::get("user"),
        ]);
    }

    function hot()
    {
        $questions = Db::table("questions")->select();
        return view("", [
            "user" => Session::get("user"),
            "questions"=> $questions,
        ]);
    }

    function detail($id) {
        $question = Db::table("questions")
        ->join('users','questions.user_id = users.id')
        ->where("questions.id",$id)->find();

        // id" => 2
        // "question_id" => 2
        // "user_id" => 2
        // "content" => "上能去金融搬砖，下能去烟草干活，实在不行当个体育老师凑合一下。2024年堪称是体育生元年，拼搏百天，我也要当体育生重振辉煌！"
        // "pv" => 0
        // "created_at" => 1722582018
        // "email" => "111@qq.com"
        // "password" => "74522afe4fc91f35665218af8b6eab56"
        // "nickname" => "陈老师"


        $answers = Db::table("answers")
            ->field('`answers`.id AS id,question_id,user_id,content,`answers`.created_at,email,password,nickname,`users`.id AS uid')
            ->join('users','answers.user_id = users.id')
            ->where("question_id",$id)->select();

        Db::table('questions')->where('id', $id)->inc('pv', 1)->update();
    
        $answerIds = [];
        $answer_likes = [];
        foreach($answers as $answer) {
            $answerIds[] = $answer["id"];
            $answer_likes[$answer["id"]] = 0;
        }
        $all_answer_likes = Db::table("answer_likes")->where("answer_id","IN", $answerIds)->select();
        
        foreach($all_answer_likes as $all_answer_like) {
            $answer_likes[$all_answer_like["answer_id"]] += 1;
        }
        return view("", [
            "user" => Session::get("user"),
            "question" => $question,
            "answers"=>$answers,
            "answer_likes" => $answer_likes,
        ]);
    }

    function create() {
        return view("", [
            "user" => Session::get("user"),
            "error" => Session::get("error"),
            "input" => Session::get("input"),
        ]);
    }

    function create_post() {
        $input = request()->param();
        $validate = Validate::rule([
            'title' => 'require|min:3|max:70',
            'discription' => 'require|min:6|max:1000',
        ]);
        if (!$validate->check($input)) {
            Session::flash('error', $validate->getError());
            Session::flash("input",$input);
            return redirect("/user/add-question");
        }

        $input["user_id"] = Session::get("user")["id"];
        $input["created_at"] = time();
        Db::table("questions")->save($input);
        return redirect("/");
    }
}
