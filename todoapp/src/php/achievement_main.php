<?php

//CROSエラーの解消
header("Access-Control-Allow-Origin: *");
//JSON形式で返却すること、文字形式がUTF-8だということの宣言
header('Content-Type: application/json; charset=UTF-8');

//DAOの読み込み
require_once './TitleDAO.php';


$data = false;

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

//arrayの中身をJSON形式に変換している
$json_array = json_encode($data);

print $json_array;
