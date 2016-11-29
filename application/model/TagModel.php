<?php

/**
 * TagsModel
 *
 * @author DartVadius
 */
class TagModel extends BaseModel {
    private $tableName = 'tags';
    private $tagId;
    private $tagName;
    public function __construct($tagName) {
        parent::__construct();
        $this->tagName = $tagName;
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
