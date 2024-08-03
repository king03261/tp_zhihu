<?php
declare (strict_types = 1);

namespace app\controller;

use think\facade\Db;
use think\facade\Session;
use think\facade\Validate;

class answer
{
    public function create()
    {
        $qid = request()->param("question_id");
        $question =  Db::table("questions")->where("id",$qid)->find();
        // dd($question);

        return view("", [
            "user" => Session::get("user"),
            "error" => Session::get("error"),
            "input" => Session::get("input"),
            "question"=>$question,
        ]);
    }

    public function create_post()
    {
        $input = request()->param();
        $validate = Validate::rule([
            'qid' => 'require|number',
            'content' => 'require|min:6|max:10000',
        ]);
        
        if (!$validate->check($input)) {
            Session::flash('error', $validate->getError());
            Session::flash("input", $input);
            return redirect("/user/add-answer?question_id={$input["qid"]}");
        }
        Db::table("answers")->save([
            "question_id" => $input["qid"],
            "content" => $input["content"],
            "user_id" => Session::get("user")["id"],
            "created_at" => time(),
        ]);
        return redirect("/question/{$input["qid"]}");
    }

    public function like($id) {
        $user = Session::get("user");
        $input = request()->param();
        if (count($input) == 0) {
            return redirect("/");
        }
        $like = Db::table("answer_likes")->where("answer_id",$id)->where("user_id",$user["id"])->find();
        if (is_null($like)) {
            Db::table("answer_likes")->save([
                "answer_id" => $id,
                "user_id" => $user["id"],
                "created_at" => time(),
            ]);
        } else {
            Db::table("answer_likes")->where("answer_id",$id)->where("user_id",$user["id"])->delete();
        }

        return redirect($input["return"]);
    }
}
