<?php
class Todo
{
    function get_pdo()
    {
        $pdo = new PDO('mysql:host=mysql211.phy.lolipop.lan;dbname=LAA1418138-grouptask;charset=utf8', 'LAA1418138', 'apstdnb');
        return $pdo;
    }

    function create_todo($title, $message, $user_id, $group_id, $genre_id, $deadline, $rank, $permission, $todo_condition)
    {
        try {
            $pdo = $this->get_pdo();

            $sql = "INSERT INTO todo_tbl (todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition) VALUE (?,?,?,?,?,?,?,?,?,?);";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $title, PDO::PARAM_STR);
            $ps->bindValue(2, $message, PDO::PARAM_STR);
            $ps->bindValue(3, "未完了", PDO::PARAM_STR);
            $ps->bindValue(4, $user_id, PDO::PARAM_INT);
            $ps->bindValue(5, $group_id, PDO::PARAM_INT);
            $ps->bindValue(6, $genre_id, PDO::PARAM_INT);
            $ps->bindValue(7, $deadline, PDO::PARAM_STR);
            $ps->bindValue(8, $rank, PDO::PARAM_STR);
            $ps->bindValue(9, $permission, PDO::PARAM_INT);
            $ps->bindValue(10, $todo_condition, PDO::PARAM_STR);
            $ps->execute();
            $data = true;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function delete_todo($todo_id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql = "DELETE FROM todo_tbl WHERE todo_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $todo_id, PDO::PARAM_STR);
            $ps->execute();
            $data = true;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function request_todo($image_id, $todo_id, $user_id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql = "UPDATE todo_tbl SET image_id = ? ,todo_state = ? WHERE todo_id = ? AND user_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $image_id, PDO::PARAM_INT);
            $ps->bindValue(2, "仮完了", PDO::PARAM_STR);
            $ps->bindValue(3, $todo_id, PDO::PARAM_INT);
            $ps->bindValue(4, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $data = true;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }


    function approval_todo($approval, $comment, $todo_id)
    {
        try {
            $pdo = $this->get_pdo();
            $data = "OK";
            if ($approval == true) {
                $sql = "UPDATE todo_tbl SET comment = ? ,todo_state = ? WHERE todo_id = ?;";
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1, $comment, PDO::PARAM_STR);
                $ps->bindValue(2, "完了", PDO::PARAM_STR);
                $ps->bindValue(3, $todo_id, PDO::PARAM_INT);
                $ps->execute();
                $data = "completion";
            } else {
                $sql2 = "UPDATE todo_tbl SET comment = ? ,todo_state = ? WHERE todo_id = ?;";
                $ps2 = $pdo->prepare($sql2);
                $ps2->bindValue(1, $comment, PDO::PARAM_STR);
                $ps2->bindValue(2, "未完了", PDO::PARAM_STR);
                $ps2->bindValue(3, $todo_id, PDO::PARAM_INT);
                $ps2->execute();
                $data = "uncompletion";
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function create_genre($name, $color)
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


    function get_groupname($id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql =  "SELECT * FROM group_tbl WHERE group_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                $data = $row['group_name'];
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function get_genre($id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql =  "SELECT * FROM genre_tbl WHERE genre_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                $data = array('genre_name' => $row['genre_name'], 'genre_color' => $row['genre_color']);
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function create_group($name, $user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "INSERT INTO group_tbl (group_name,user_count) VALUE (?,?);";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $name, PDO::PARAM_STR);
            $ps->bindValue(2, 0, PDO::PARAM_INT);
            $ps->execute();
            $group_id = $pdo->lastInsertId();
            foreach ($user_id as $row) {
                $this->add_affiliation($group_id, $row);
            }
            $data = true;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function add_affiliation($group_id, $user_id)
    {
        try {
            $pdo = $this->get_pdo();

            //既に同じidが登録されていないかの確認
            $sql =  "SELECT * FROM affiliation_tbl WHERE group_id = ? AND user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $group_id, PDO::PARAM_INT);
            $ps->bindValue(2, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();

            if ($search == null) {
                $sql2 = "INSERT INTO affiliation_tbl (group_id,user_id) VALUE (?,?);";
                $ps2 = $pdo->prepare($sql2);
                $ps2->bindValue(1, $group_id, PDO::PARAM_INT);
                $ps2->bindValue(2, $user_id, PDO::PARAM_STR);
                $ps2->execute();
                $sql3 = "UPDATE group_tbl SET user_count=user_count+ 1 WHERE group_id = ?;";
                $ps3 = $pdo->prepare($sql3);
                $ps3->bindValue(1, $group_id, PDO::PARAM_INT);
                $ps3->execute();
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

    function delete_affiliation($group_id, $user_id)
    {
        try {
            $pdo = $this->get_pdo();

            //既に同じidが登録されていないかの確認
            $sql =  "DELETE FROM affiliation_tbl WHERE group_id = ? AND user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $group_id, PDO::PARAM_INT);
            $ps->bindValue(2, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $sql3 = "UPDATE group_tbl SET user_count=user_count- 1 WHERE group_id = ?;";
            $ps3 = $pdo->prepare($sql3);
            $ps3->bindValue(1, $group_id, PDO::PARAM_INT);
            $ps3->execute();
            $data = true;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function rename_group($group_id, $group_name, $user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $user_chk = $this->gorup_chk($group_id, $user_id);
            if ($user_chk) {
                $sql = "UPDATE group_tbl SET group_name = ? WHERE group_id = ?;";
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1, $group_name, PDO::PARAM_STR);
                $ps->bindValue(2, $group_id, PDO::PARAM_INT);
                $ps->execute();
                $data = true;
            } else {
                $data = "not group user";
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function gorup_chk($group_id, $user_id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql = "SELECT * FROM group_tbl WHERE group_id = ? AND user_id = ?";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $group_id, PDO::PARAM_INT);
            $ps->bindValue(2, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            if ($search == null) {
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


    //グループごとのユーザ情報を返すメソッド
    function get_group_userlist($group_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM affiliation_tbl WHERE group_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $group_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            $class = new Login();
            foreach ($search as $row) {
                $data[] = array('id' => $row['user_id'], 'name' => $class->get_username($row['user_id']));
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }


    //グループごとの未完了情報を返すメソッド
    function get_group_uncompletion($group_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM todo_tbl WHERE group_id = ? AND todo_state = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $group_id, PDO::PARAM_INT);
            $ps->bindValue(2, "未完了", PDO::PARAM_STR);
            $ps->execute();
            $search = $ps->fetchAll();
            $class = new Login();
            foreach ($search as $row) {
                //todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition
                $data[] = array(
                    'todo_id' => $row['todo_id'], 'title' => $row['todo_title'], 'messsage' => $row['todo_message'], 'state' => $row['todo_state'], 'user_id' => $row['user_id'], 'name' => $class->get_username($row['user_id']),
                    'genre' => $this->get_genre($row['genre_id']), 'deadline' => $row['deadline'], 'rank' => $row['rank'], 'permission' => $row['permission'], 'todo_condition' => $row['todo_condition'], 'comment' => $row['comment']
                );
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //グループごとの仮完了情報を返すメソッド
    function get_group_tentative($group_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM todo_tbl WHERE group_id = ? AND todo_state = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $group_id, PDO::PARAM_INT);
            $ps->bindValue(2, "仮完了", PDO::PARAM_STR);
            $ps->execute();
            $class = new Login();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                //todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition
                $data[] = array(
                    'todo_id' => $row['todo_id'], 'title' => $row['todo_title'], 'messsage' => $row['todo_message'], 'state' => $row['todo_state'], 'user_id' => $row['user_id'], 'image_pass' => $this->get_image_pass($row['image_id']), 'name' => $class->get_username($row['user_id']),
                    'genre' => $this->get_genre($row['genre_id']), 'deadline' => $row['deadline'], 'rank' => $row['rank'], 'permission' => $row['permission'], 'todo_condition' => $row['todo_condition'], 'comment' => $row['comment']
                );
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //グループごとの完了情報を返すメソッド
    function get_group_completion($group_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM todo_tbl WHERE group_id = ? AND todo_state = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $group_id, PDO::PARAM_INT);
            $ps->bindValue(2, "完了", PDO::PARAM_STR);
            $ps->execute();
            $class = new Login();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                //todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition
                $data[] = array(
                    'todo_id' => $row['todo_id'], 'title' => $row['todo_title'], 'messsage' => $row['todo_message'], 'state' => $row['todo_state'], 'user_id' => $row['user_id'], 'image_pass' => $this->get_image_pass($row['image_id']), 'name' => $class->get_username($row['user_id']),
                    'genre' => $this->get_genre($row['genre_id']), 'deadline' => $row['deadline'], 'rank' => $row['rank'], 'permission' => $row['permission'], 'todo_condition' => $row['todo_condition'], 'comment' => $row['comment']
                );
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }


    //ユーザごとの未完了情報を返すメソッド
    function get_user_uncompletion($user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM todo_tbl WHERE user_id = ? AND todo_state = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->bindValue(2, "未完了", PDO::PARAM_STR);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                //todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition
                $data[] = array(
                    'todo_id' => $row['todo_id'], 'title' => $row['todo_title'], 'messsage' => $row['todo_message'], 'state' => $row['todo_state'], 'user_id' => $row['user_id'], 'group_id' => $row['group_id'], 'group_name' => $this->get_groupname($row['group_id']),
                    'genre' => $this->get_genre($row['genre_id']), 'deadline' => $row['deadline'], 'rank' => $row['rank'], 'permission' => $row['permission'], 'todo_condition' => $row['todo_condition'], 'comment' => $row['comment']
                );
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //ユーザごとの仮完了情報を返すメソッド
    function get_user_tentative($user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM todo_tbl WHERE user_id = ? AND todo_state = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->bindValue(2, "仮完了", PDO::PARAM_STR);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                //todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition
                $data[] = array(
                    'todo_id' => $row['todo_id'], 'title' => $row['todo_title'], 'messsage' => $row['todo_message'], 'state' => $row['todo_state'], 'user_id' => $row['user_id'], 'group_id' => $row['group_id'], 'group_name' => $this->get_groupname($row['group_id']), 'image_pass' => $this->get_image_pass($row['image_id']),
                    'genre' => $this->get_genre($row['genre_id']), 'deadline' => $row['deadline'], 'rank' => $row['rank'], 'permission' => $row['permission'], 'todo_condition' => $row['todo_condition'], 'comment' => $row['comment']
                );
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //ユーザごとの完了情報を返すメソッド
    function get_user_completion($user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM todo_tbl WHERE user_id = ? AND todo_state = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->bindValue(2, "完了", PDO::PARAM_STR);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                //todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition
                $data[] = array(
                    'todo_id' => $row['todo_id'], 'title' => $row['todo_title'], 'messsage' => $row['todo_message'], 'state' => $row['todo_state'], 'user_id' => $row['user_id'], 'group_id' => $row['group_id'], 'group_name' => $this->get_groupname($row['group_id']), 'image_pass' => $this->get_image_pass($row['image_id']),
                    'genre' => $this->get_genre($row['genre_id']), 'deadline' => $row['deadline'], 'rank' => $row['rank'], 'permission' => $row['permission'], 'todo_condition' => $row['todo_condition'], 'comment' => $row['comment']
                );
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //グループtodoの情報をすべて返すメソッド
    function get_completionlist($group_id)
    {
        try {
            $data = array('uncompletion' => $this->get_group_uncompletion($group_id), 'tentative' => $this->get_group_tentative($group_id), 'completion' => $this->get_group_completion($group_id));
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }


    //グループtodo画面の情報をメソッド
    function get_todolist($group_id)
    {
        try {
            $data[] = array('group_name' => $this->get_groupname($group_id), 'group_information' => $this->get_completionlist($group_id), 'group_user_list' => $this->get_group_userlist($group_id));
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //ユーザのtodoの情報をすべて返すメソッド
    function get_user_todolist($user_id)
    {
        try {
            $data = array('uncompletion' => $this->get_user_uncompletion($user_id), 'tentative' => $this->get_user_tentative($user_id), 'completion' => $this->get_user_completion($user_id));
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //ユーザの情報を返すメソッド
    function get_user_information($user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM affiliation_tbl WHERE user_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                $data[] = array('group_id' => $row['group_id'], 'group_name' => $this->get_groupname($row['group_id']), 'group_information' => $this->get_completionlist($row['group_id']), 'group_user_list' => $this->get_group_userlist($row['group_id']));
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }


    //ホーム情報を返すメソッド
    function rank_count($user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $rank = ['S', 'A', 'B', 'C'];
            foreach ($rank as $i) {
                $sql = "SELECT COUNT(*) AS count,rank FROM todo_tbl WHERE user_id = ? AND rank = ?;";
                $ps = $pdo->prepare($sql);
                $ps->bindValue(1, $user_id, PDO::PARAM_INT);
                $ps->bindValue(2, $i, PDO::PARAM_STR);
                $ps->execute();
                $search = $ps->fetchAll();
                foreach ($search as $row) {
                    $data[] = array('rank' => $i, 'count' => $row['count']);
                }
            }
            $sql2 = "SELECT COUNT(*) AS count FROM todo_tbl WHERE user_id = ?;";
            $ps2 = $pdo->prepare($sql2);
            $ps2->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps2->execute();
            $search = $ps2->fetchAll();
            foreach ($search as $row) {
                $data[] = array('all' => $row['count']);
            }
            $sql3 = "SELECT * FROM todo_tbl WHERE user_id = ? AND todo_state = ? ORDER BY deadline LIMIT 1;";
            $ps3 = $pdo->prepare($sql3);
            $ps3->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps3->bindValue(2, "未完了", PDO::PARAM_STR);
            $ps3->execute();
            $search = $ps3->fetchAll();
            foreach ($search as $row) {
                //todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition
                $data[] = array(
                    'todo_id' => $row['todo_id'], 'title' => $row['todo_title'], 'messsage' => $row['todo_message'], 'state' => $row['todo_state'], 'user_id' => $row['user_id'],
                    'genre' => $this->get_genre($row['genre_id']), 'deadline' => $row['deadline'], 'rank' => $row['rank'], 'permission' => $row['permission'], 'todo_condition' => $row['todo_condition']
                );
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //ユーザの実績を返すメソッド
    function get_title($user_id)
    {
        try {

            $pdo = $this->get_pdo();
            $sql = "SELECT A.title_id,A.title_name,A.title_conditions,B.achievement_id FROM title_tbl AS A 
            LEFT OUTER JOIN (SELECT * FROM achievement_tbl WHERE user_id = ?) AS B 
            ON A.title_id = B.title_id ORDER BY A.title_id;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                if ($row['achievement_id'] == null) {
                    $chk = false;
                } else {
                    $chk = true;
                }
                $data[] = array('title' => $row['title_id'], 'name' => $row['title_name'], 'conditions' => $row['title_conditions'], 'get' => $chk);
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    //ユーザ情報を返すメソッド
    function get_home_information($user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM affiliation_tbl WHERE user_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                $data[] = array('group_id' => $row['group_id'], 'group_information' => $this->get_completionlist($row['group_id']));
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function create_image($img_pass)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "INSERT INTO image_tbl (image_pass) VALUE (?);";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $img_pass, PDO::PARAM_STR);
            $ps->execute();
            $id = $pdo->lastInsertId();
            $data = $id;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function get_image_pass($id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM image_tbl WHERE image_id=?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                $data = $row['image_pass'];
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function get_header($user_id)
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM user_tbl WHERE user_id=?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                $data = array('name' => $row['user_name'], 'title' => $this->get_title_detail($row['title_id']));
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function update_usertitle($user_id, $title_id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql = "UPDATE user_tbl SET title_id = ? WHERE user_id = ?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $title_id, PDO::PARAM_INT);
            $ps->bindValue(2, $user_id, PDO::PARAM_INT);
            $ps->execute();
            $data = true;
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }

    function get_title_detail($title_id)
    {
        try {
            $pdo = $this->get_pdo();

            $sql = "SELECT * FROM title_tbl WHERE title_id=?;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, $title_id, PDO::PARAM_INT);
            $ps->execute();
            $search = $ps->fetchAll();
            foreach ($search as $row) {
                $data = array('name' => $row['title_name'], 'title_conditions' => $row['title_conditions']);
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }


    //掲示板に表示するの完了情報を50件返すメソッド
    function get_bulletinboard()
    {
        try {
            $pdo = $this->get_pdo();
            $sql = "SELECT * FROM todo_tbl WHERE permission = ? AND todo_state = ? ORDER BY deadline LIMIT 50;";
            $ps = $pdo->prepare($sql);
            $ps->bindValue(1, 1, PDO::PARAM_INT);
            $ps->bindValue(2, "完了", PDO::PARAM_STR);
            $ps->execute();
            $search = $ps->fetchAll();
            $class = new Login();
            foreach ($search as $row) {
                //todo_title,todo_message,todo_state,user_id,group_id,genre_id,deadline,rank,permission,todo_condition
                $data[] = array(
                    'title' => $row['todo_title'], 'messsage' => $row['todo_message'], 'state' => $row['todo_state'], 'name' => $class->get_username($row['user_id']), 'image_pass' => $this->get_image_pass($row['image_id']),
                    'genre' => $this->get_genre($row['genre_id']), 'deadline' => $row['deadline'], 'rank' => $row['rank'], 'permission' => $row['permission'], 'todo_condition' => $row['todo_condition'], 'comment' => $row['comment']
                );
            }
        } catch (Exception $e) {
            $data = $e;
        } catch (Error $e) {
            $data = $e;
        }
        return $data;
    }
}
