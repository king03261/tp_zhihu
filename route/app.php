<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get("/", "question/list");
Route::get("/hot", "question/hot");

Route::get("/question/:id", "question/detail");


Route::get("/user/add-question", "question/create");
Route::post("/user/add-question", "question/create_post");

Route::get("/user/add-answer", "answer/create");
Route::post("/user/add-answer", "answer/create_post");



Route::get('/account/login', 'account/login');
Route::post('/account/login', 'account/login_post');

Route::get('/account/register', 'account/register');
Route::post('/account/register', 'account/register_post');


Route::get('/account/logout', 'account/logout');
