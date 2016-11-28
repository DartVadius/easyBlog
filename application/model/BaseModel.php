<?php
abstract class BaseModel {
    protected $pdo = null;
    protected $tableName = NULL;
    public function __construct() {
        $this->pdo = PDOLib::getInstance()->getPdo();
    }
    abstract protected function save();
    abstract protected function update();
    public static function getTableName() {
        return $this->tableName;
    }
}