<?php

//CROSエラーの解消
header("Access-Control-Allow-Origin: *");
//JSON形式で返却すること、文字形式がUTF-8だということの宣言
header('Content-Type: application/json; charset=UTF-8');

//DAOの読み込み
require_once './LoginDAO.php';
require_once './TitleDAO.php';
require_once './Todo.php';


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
    $data = $class->create_todo($_POST['title'], $_POST['message'], $_POST['user_id'], $_POST['group_id'], $_POST['genre_id'], $_POST['deadline'], $_POST['rank'], $_POST['permission'], $_POST['todo_condition']);
}

//request_todoの引数がある時の処理
if (isset($_POST['request_todo']) == true) {
    $class = new Todo();
    $data = $class->request_todo($_POST['image_id'],$_POST['todo_id'],$_POST['user_id']);
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

//create_groupの引数がある時の処理
if (isset($_POST['create_group']) == true) {
    $class = new Todo();
    $data = $class->create_group($_POST['name'], $_POST['user_id']);
}

//rename_groupの引数がある時の処理
if (isset($_POST['rename_group']) == true) {
    $class = new Todo();
    $data = $class->rename_group($_POST['group_id'],$_POST['group_name'],$_POST['user_id']);
}

//get_usernameの引数がある時の処理
if (isset($_POST['get_username']) == true) {
    $class = new Login();
    $data = $class->get_username($_POST['user_id']);
}

//add_affiliationの引数がある時の処理
if (isset($_POST['add_affiliation']) == true) {
    $class = new Todo();
    $data = $class->add_affiliation($_POST['group_id'],$_POST['user_id']);
}

//delete_affiliationの引数がある時の処理
if (isset($_POST['delete_affiliation']) == true) {
    $class = new Todo();
    $data = $class->delete_affiliation($_POST['group_id'],$_POST['user_id']);
}

//get_group_userlistの引数がある時の処理
if (isset($_POST['get_group_userlist']) == true) {
    $class = new Todo();
    $data = $class->get_group_userlist($_POST['group_id']);
}

//get_completionlistの引数がある時の処理
if (isset($_POST['get_completionlist']) == true) {
    $class = new Todo();
    $data = $class->get_completionlist($_POST['group_id']);
}

//get_user_informationの引数がある時の処理
if (isset($_POST['get_user_information']) == true) {
    $class = new Todo();
    $data = $class->get_user_information($_POST['user_id']);
}

//rank_countの引数がある時の処理
if (isset($_POST['rank_count']) == true) {
    $class = new Todo();
    $data = $class->rank_count($_POST['user_id']);
}

//get_titleの引数がある時の処理
if (isset($_POST['get_title']) == true) {
    $class = new Todo();
    $data = $class->get_title($_POST['user_id']);
}

//get_user_todolistの引数がある時の処理
if (isset($_POST['get_user_todolist']) == true) {
    $class = new Todo();
    $data = $class->get_user_todolist($_POST['user_id']);
}

//arrayの中身をJSON形式に変換している
$json_array = json_encode($data);

print $json_array;
