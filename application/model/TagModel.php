<?php

/**
 * TagsModel
 *
 * @author DartVadius
 */
class TagModel extends BaseModel {
    protected static $tableName = 'tags';
    private $tagId;
    private $tagName;
    public function __construct($tagName) {
        parent::__construct();
        $this->tagName = $tagName;
    }
    public static function getTableName() {
        return self::$tableName;
    }
    public function getTagName() {
        return $this->tagName;
    }

    public function setTagId($id) {
        $this->tagId = $id;
    }
    public function getTagId() {
        return $this->tagId;
    }

    public function save() {
        $sql =  "INSERT INTO $this->tableName SET
        tags_name = :tagName";
        $arr = array (
            'tagName' => $this->tagName
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
        tags_name = :tagName";
        $arr = array (
            'tagName' => $this->tagName
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
