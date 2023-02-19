<?php

//CROSエラーの解消
header("Access-Control-Allow-Origin: *");
//JSON形式で返却すること、文字形式がUTF-8だということの宣言
header('Content-Type: application/json; charset=UTF-8');

//DAOの読み込み
require_once './LoginDAO.php';
require_once './TitleDAO.php';


$data = false;

//login_userの引数がある時の処理
if (isset($_POST['login_user']) == true) {
    $class = new Login();
    $data = $class->login_user($_POST['pass'], $_POST['mail']);
}

//create_userの引数がある時の処理
if (isset($_POST['create_user']) == true) {
    $class = new Login();
    $data = $class->create_user($_POST['name'], $_POST['pass'], $_POST['mail']);
}

//create_todoの引数がある時の処理
if (isset($_POST['create_todo']) == true) {
    $class = new Todo();
    $data = $class->create_todo($_POST['title'], $_POST['message'], $_POST['user_id'], $_POST['group_id'], $_POST['genre_id'], $_POST['deadline'], $_POST['rank'], $_POST['comment'], $_POST['permission'], $_POST['todo_condition']);
}

//create_titleの引数がある時の処理
if (isset($_POST['create_title']) == true) {
    $class = new Title();
    $data = $class->create_title($_POST['title_name'], $_POST['title_conditions']);
}

//create_achievementの引数がある時の処理
if (isset($_POST['create_achievement']) == true) {
    $class = new Achievement();
    $data = $class->create_achievement($_POST['user_id'], $_POST['title_id']);
}

//create_genreの引数がある時の処理
if (isset($_POST['create_genre']) == true) {
    $class = new Todo();
    $data = $class->create_genre($_POST['name'], $_POST['color']);
}

//arrayの中身をJSON形式に変換している
$json_array = json_encode($data);

print $json_array;
