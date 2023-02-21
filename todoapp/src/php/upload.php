<?php
//CROSエラーの解消
header("Access-Control-Allow-Origin: *");
//JSON形式で返却すること、文字形式がUTF-8だということの宣言
header('Content-Type: application/json; charset=UTF-8');
// PHP

require_once './Todo.php';
// check if file is uploaded via HTTP POST method
if (is_uploaded_file($_FILES['image']['tmp_name'])) {


    $image = uniqid(mt_rand(), true);
    $image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);
    $file = "images/$image";
    if (!empty($_FILES['image']['name'])) {
        move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);
        if (exif_imagetype($file)) {
            $class = new Todo();
            $img_pass = './images/' . $image;
            $img_id = $class->create_image($img_pass);
            $data = $class->request_todo($img_id,$_POST['todo_id'],$_POST['user_id']);
            echo $data;
        } else {
            echo false;
        }
    }
} else {
    // return error message if no file is uploaded via HTTP POST method
    echo "No file uploaded";
}
