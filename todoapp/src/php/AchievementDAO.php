<?php
class Achievement
{
    function get_pdo()
    {
        $pdo = new PDO('mysql:host=mysql211.phy.lolipop.lan;dbname=LAA1418138-grouptask;charset=utf8', 'LAA1418138', 'apstdnb');
        return $pdo;
    }

    function create_achievement($user_id,$title_id)
    {
        try {
            $pdo = $this->get_pdo();

            //既に同じ称号が登録されていないかの確認
            $sql =  "SELECT * FROM achievement_tbl WHERE user_id = ? title_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->bindValue(2, $title_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();

            if ($search == null) {
                $sql2 = "INSERT INTO achievement_tbl (title_id,user_id) VALUE (?,?);";
                $ps = $pdo->prepare($sql2);
                $ps->bindValue(1, $title_id, PDO::PARAM_STR);
                $ps->bindValue(2, $user_id, PDO::PARAM_STR);
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
