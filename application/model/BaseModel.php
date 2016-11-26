<?php
abstract class BaseModel {
    protected $pdo = null;
    public function __construct() {
        $this->pdo = PDOLib::getInstance()->getPdo();
    }
    abstract protected function save();
    abstract protected function update();
}