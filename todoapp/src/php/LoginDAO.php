<?php
require_once './AchievementDAO.php';
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
                $this->login_update($id);
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
                    $date = date('Y-m-d');
                    if ($date > $row['last_login'])
                        $this->user_countup($row['user_id']);
                    $data = array('id' => $row['user_id'], 'name' => $row['user_name'], 'chk' => true);

                    //称号獲得の処理
                    $class2 = new Achievement();
                    switch ($row['days']) {
                        case 1:
                            $title_id = 5;
                            break;
                        case 3:
                            $title_id = 6;
                            break;
                        case 7:
                            $title_id = 7;
                            break;
                        case 14:
                            $title_id = 8;
                            break;
                        case 30:
                            $title_id = 9;
                            break;
                        case 60:
                            $title_id = 10;
                            break;
                        case 180:
                            $title_id = 11;
                            break;
                        case 365:
                            $title_id = 12;
                            break;
                    }
                    $class2->create_achievement($row['user_id'], $title_id);
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

    function user_countup($user_id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql = "UPDATE user_tbl SET days = days+ 1 WHERE user_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $data = true;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }

        return $data;
    }
}
