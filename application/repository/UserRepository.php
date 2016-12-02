<?php

/**
 * UserRepository
 *
 * @author DartVadius
 */
class UserRepository extends BaseRepository {
    public function findAll() {
        $artList = array();
        $sql = "SELECT * FROM " . UserModel::getTableName();
        $res = $this->pdo->query($sql);
        $users = $res->fetchAll();
        if ($users) {
            foreach ($users as $user) {
                $newUser = new UserModel($user['user_name'], $user['user_login'], $user['user_password'], $user['user_email']);
                $newUser->setUserGroup($user['user_group']);
                $newUser->setUserId($user['user_id']);
                array_push($artList, $newArticle);
            }
            return $artList;
        } else {
            return FALSE;
        }
    }
    public function findById($id) {
        $sql = "SELECT * FROM " . UserModel::getTableName() . " WHERE user_id = $id";
        $res = $this->pdo->query($sql);
        $user = $res->fetch();
        if ($user) {
            $newUser = new UserModel($user['user_name'], $user['user_login'], $user['user_password'], $user['user_email']);
            $newUser->setUserGroup($user['user_group']);
            $newUser->setUserId($id);
            return $newUser;
        } else {
            return FALSE;
        }
    }

    public function findByLogin($login) {
        $sql = "SELECT * FROM " . UserModel::getTableName() . " WHERE user_login = '$login'";
        $res = $this->pdo->query($sql);
        $user = $res->fetch();
        if ($user) {
            $newUser = new UserModel($user['user_name'], $user['user_login'], $user['user_password'], $user['user_email']);
            $newUser->setUserGroup($user['user_group']);
            $newUser->setUserId($user['user_id']);
            return $newUser;
        } else {
            return FALSE;
        }
    }
    public function findByName($name) {
        $sql = "SELECT * FROM " . UserModel::getTableName() . " WHERE user_name = '$name'";
        $res = $this->pdo->query($sql);
        $user = $res->fetch();
        if ($user) {
            $newUser = new UserModel($user['user_name'], $user['user_login'], $user['user_password'], $user['user_email']);
            $newUser->setUserGroup($user['user_group']);
            $newUser->setUserId($user['user_id']);
            return $newUser;
        } else {
            return FALSE;
        }
    }

    public function findByGroup($group) {
        $userList = array();
        $sql = "SELECT * FROM " . UserModel::getTableName() . " WHERE user_group = $group";
        $res = $this->pdo->query($sql);
        $users = $res->fetchAll();
        if ($users) {
            foreach ($users as $user) {
                $newUser = new UserModel($user['user_name'], $user['user_login'], $user['user_password'], $user['user_email']);
                $newUser->setUserGroup($user['user_group']);
                array_push($userList, $newUser);
            }            
            return $userList;
        } else {
            return FALSE;
        }
    }    
}
