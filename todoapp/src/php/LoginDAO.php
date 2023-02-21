<?php
class Login
{
    function get_pdo()
    {
        $pdo = new PDO('mysql:host=mysql211.phy.lolipop.lan;dbname=LAA1418138-grouptask;charset=utf8', 'LAA1418138', 'apstdnb');
        return $pdo;
    }

    function create_user($name, $pass, $mail)
    {
        try {
            $pdo = $this->get_pdo();

            //既に同じメールで登録されていないかの確認
            $sql =  "SELECT * FROM user_tbl WHERE user_mail = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $mail, PDO::PARAM_STR);
            $ps->execute();
            $search = $ps->fetchAll();

            if ($search == null) {
                $sql2 = "INSERT INTO user_tbl (user_name,user_pass,user_mail) VALUE (?,?,?);";
                $ps = $pdo->prepare($sql2);
                $ps->bindValue(1, $name, PDO::PARAM_STR);
                $ps->bindValue(2, $pass, PDO::PARAM_STR);
                $ps->bindValue(3, $mail, PDO::PARAM_STR);
                $ps->execute();
                $id = $pdo->lastInsertId();
                if ($id == null) {
                    $data = false;
                } else {
                    $data = $id;
                }
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

    function login_user($pass, $mail)
    {
        try {
            $pdo = $this->get_pdo();

            $sql =  "SELECT * FROM user_tbl WHERE user_mail = ? AND user_pass = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $mail, PDO::PARAM_STR);
            $ps->bindValue(2, $pass, PDO::PARAM_STR);
            $ps->execute();
            $search = $ps->fetchAll();
            if ($search != null) {
                foreach ($search as $row) {
                    $this->login_update($row['user_id']);
                    $data = array('id' => $row['user_id'], 'name' => $row['user_name'], 'chk' => true);
                }
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

    function login_update($id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql =  "UPDATE user_tbl SET last_login = NOW() WHERE user_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $id, PDO::PARAM_INT);
            $ps->execute();
            $data = true;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }

        return $data;
    }

    function get_username($id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql =  "SELECT * FROM user_tbl WHERE user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            if ($search != null) {
                foreach ($search as $row) {
                    $data = $row['user_name'];
                }
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
