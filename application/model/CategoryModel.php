<?php

/**
 * Description of CategoryModel
 *
 * @author DartVadius
 */
class CategoryModel extends BaseModel {
    protected static $tableName = 'category';
    private $categoryId;
    private $categoryName;
    private $categoryDesc;
    private $categoryParentId;
    public function __construct($categoryName, $categoryDesc, $categoryParentId = 0) {
        parent::__construct();
        $this->categoryName = $categoryName;
        $this->categoryDesc = $categoryDesc;
        $this->categoryParentId = $categoryParentId;        
    }
    public static function getTableName() {        
        return self::$tableName;
    }
    public function setCategoryParentId($id) {
        $this->categoryParentId = $id;
    }
    public function setCategoryId($id) {
        $this->categoryId = $id;
    }
    public function getCategoryId() {
        return $this->categoryId;
    }
    public function getCategoryParentId() {
        return $this->categoryParentId;
    }
    public function getCategoryName() {
        return $this->categoryName;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function save() {
        $sql =  "INSERT INTO $this->tableName SET
        category_name = :categoryName,
        category_desc = :categoryDesc,
        category_parent_id = :categoryParentId";
        $arr = array (
            'categoryName' => $this->categoryName,
            'categoryDesc' => $this->categoryDesc,
            'categoryParentId' => $this->categoryParentId
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
        category_name = :categoryName,
        category_desc = :categoryDesc,
        category_parent_id = :categoryParentId";
        $arr = array (
            'categoryName' => $this->categoryName,
            'categoryDesc' => $this->categoryDesc,
            'categoryParentId' => $this->categoryParentId
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