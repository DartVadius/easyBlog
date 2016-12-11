<?php
/**
 * UserModel
 *
 * @author DartVadius
 */
class UserModel extends BaseModel {
    protected static $tableName = 'user';
    private $userId;
    private $userName;
    private $userLogin;
    private $userPass;
    private $userEmail;
    private $userGroup = NULL;

    public function __construct($userName, $userLogin, $userPass, $userEmail = '') {
        parent::__construct();
        $this->userName = $userName;
        $this->userLogin = $userLogin;
        $this->userPass = $userPass;
        $this->userEmail = $userEmail;
    }

    public static function getTableName() {
        return self::$tableName;
    }
    public function getUserEmail() {
        return $this->userEmail;
    }

    public function getUserLogin() {
        return $this->userLogin;
    }
    public function getUserPass() {
        return $this->userPass;
    }
    public function getUserName() {
        return $this->userName;
    }
    public function getUserId() {
        return $this->userId;
    }
    public function getUserGroup() {
        return $this->userGroup;
    }

    public function setUserId($id) {
        $this->userId = $id;
    }

    public function setUserGroup($userGroup) {
        $this->userGroup = $userGroup;
    }

    public function save() {
        $sql =  "INSERT INTO ". self::$tableName . " SET
        user_name = :userName,
        user_login = :userLogin,
        user_password = :userPass,
        user_email = :userEmail,
        user_group = :userGroup";
        $pass = password_hash($this->userPass, PASSWORD_DEFAULT);
        $arr = array (
            'userName' => $this->userName,
            'userLogin' => $this->userLogin,
            'userPass' => $pass,
            'userEmail' => $this->userEmail,
            'userGroup' => 1
        );
        try {
            $res = $this->pdo->prepare($sql);
            $res->execute($arr);
            return TRUE;
        } catch (PDOException $ex) {
            return 'Что-то пошло не так: ' . $ex->getMessage();
        }
    }

    public function update() {
        $sql =  "UPDATE " . self::$tableName . " SET
            user_email = :userEmail,            
            user_group = :userGroup
            WHERE user_id = $this->userId";        
        $arr = array (
            'userEmail' => $this->userEmail,            
            'userGroup' => $this->userGroup
        );
        try {
            $res = $this->pdo->prepare($sql);
            $res->execute($arr);
            return TRUE;
        } catch (PDOException $ex) {
            throw new PDOException();
        }
    }
    
}