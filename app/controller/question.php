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


        $answers = Db::table("answers")
            ->join('users','answers.user_id = users.id')
            ->where("question_id",$question["id"])->select();

        return view("", [
            "user" => Session::get("user"),
            "question" => $question,
            "answers"=>$answers,
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
            return redirect("/user/question");
        }
        $input["user_id"] = Session::get("user")["id"];
        $input["created_at"] = time();
        Db::table("questions")->save($input);
        return redirect("/");
    }
}
