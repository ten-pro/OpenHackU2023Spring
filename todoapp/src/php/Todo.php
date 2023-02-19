<?php
class Todo
{
    function get_pdo()
    {
        $pdo = new PDO('mysql:host=mysql211.phy.lolipop.lan;dbname=LAA1418138-grouptask;charset=utf8', 'LAA1418138', 'apstdnb');
        return $pdo;
    }

    function create_todo($title, $message, $user_id, $group_id, $genre_id, $deadline, $rank,$comment,$permission,$todo_condition)
    {
        try {
            $pdo = $this->get_pdo();

            try {
                $sql = "INSERT INTO todo_tbl (todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,comment,permission,todo_condition) VALUE (?,?,?,?,?,?,?,?,?,?,?);";
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1, $title, PDO::PARAM_STR);
                $ps->bindValue(2, $message, PDO::PARAM_STR);
                $ps->bindValue(3, "未完了", PDO::PARAM_STR);
                $ps->bindValue(4, $user_id, PDO::PARAM_INT);
                $ps->bindValue(5, $group_id, PDO::PARAM_INT);
                $ps->bindValue(6, $genre_id, PDO::PARAM_INT);
                $ps->bindValue(7, $deadline, PDO::PARAM_STR);
                $ps->bindValue(8, $rank, PDO::PARAM_STR);
                $ps->bindValue(9, $comment, PDO::PARAM_STR);
                $ps->bindValue(10, $permission, PDO::PARAM_STR);
                $ps->bindValue(11, $todo_condition, PDO::PARAM_INT);
                $ps->execute();
                $data = true;
            } catch (Exception $e) {
                $data = $e;
            } catch (Error $e) {
                $data = $e;
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function create_genre($name,$color)
    {
        try {
            $pdo = $this->get_pdo();

            //既に同じジャンルが登録されていないかの確認
            $sql =  "SELECT * FROM genre_tbl WHERE genre_name = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $name, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();

            if ($search == null) {
                $sql2 = "INSERT INTO genre_tbl (genre_name,genre_color) VALUE (?,?);";
                $ps = $pdo->prepare($sql2);
                $ps->bindValue(1, $name, PDO::PARAM_STR);
                $ps->bindValue(2, $color, PDO::PARAM_STR);
                $ps->execute();
                $data = true;
            } else {
                $data = false;
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }
}
