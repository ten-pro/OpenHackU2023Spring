<?php
class Title
{
    function get_pdo()
    {
        $pdo = new PDO('mysql:host=mysql211.phy.lolipop.lan;dbname=LAA1418138-grouptask;charset=utf8', 'LAA1418138', 'apstdnb');
        return $pdo;
    }

    function create_title($name,$conditions)
    {
        try {
            $pdo = $this->get_pdo();

            //既に同じタイトル名で登録されていないかの確認
            $sql =  "SELECT * FROM title_tbl WHERE title_name = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $name, PDO::PARAM_STR);
            $ps->execute();
            $search = $ps->fetchAll();

            if ($search == null) {
                $sql2 = "INSERT INTO title_tbl (title_name,title_conditions) VALUE (?,?);";
                $ps = $pdo->prepare($sql2);
                $ps->bindValue(1, $name, PDO::PARAM_STR);
                $ps->bindValue(2, $conditions, PDO::PARAM_STR);
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
