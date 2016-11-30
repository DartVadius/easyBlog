<?php
/**
 * GroupModel
 *
 * @author DartVadius
 */
class GroupModel extends BaseModel {
    protected static $tableName = 'group';
    private $groupId;
    private $groupName;
    private $groupValue;
    private $groupDesc;
    public function __construct($groupName, $groupValue, $groupDesc) {
        parent::__construct();
        $this->groupName = $groupName;
        $this->groupValue = $groupValue;
        $this->groupDesc = $groupDesc;
    }
    
    public static function getTableName() {        
        return self::$tableName;
    }
    public function setGroupId($id) {
        $this->groupId = $id;
    }
    public function getGroupValue() {
        return $this->groupValue;
    }

    public function save() {
        $sql =  "INSERT INTO $this->tableName SET
        group_name = :groupName,
        group_value = :groupValue,
        group_desc = :groupDesc";
        $arr = array (
            'groupName' => $this->groupName,
            'groupValue' => $this->groupValue,
            'groupDesc' => $this->groupDesc
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
        $sql =  "UPDATE $this->tableName SET
        group_name = :groupName,
        group_value = :groupValue,
        group_desc = :groupDesc";
        $arr = array (
            'groupName' => $this->groupName,
            'groupValue' => $this->groupValue,
            'groupDesc' => $this->groupDesc
        );
        try {
            $res = $this->pdo->prepare($sql);
            $res->execute($arr);
            return TRUE;
        } catch (PDOException $ex) {
            return 'Что-то пошло не так: ' . $ex->getMessage();
        }
    }
}
