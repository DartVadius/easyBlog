<?php

/**
 * Description of CategoryModel
 *
 * @author DartVadius
 */
class CategoryModel extends BaseModel {
    private $tableName = 'category';
    private $categoryId;
    private $categoryName;
    private $categoryDesc;
    private $categoryParentId = NULL;
    public function __construct($categoryName, $categoryDesc) {
        parent::__construct();
        $this->categoryName = $categoryName;
        $this->categoryDesc = $categoryDesc;
    }
    public function setCategoryParentId($id) {
        $this->categoryParentId = $id;
    }
    public function setCategoryId($id) {
        $this->categoryId = $id;
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