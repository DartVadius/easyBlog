<?php

/**
 * CategoryValidate
 *
 * @author DartVadius
 */
class CategoryValidate implements iValidate {
    private $category = NULL;
    public function __construct(CategoryModel $data) {
        $this->category = $data;
    }
    public function validate() {
        if (isset($this->category->getCategoryName()) && isset($this->category->getCategoryDesc())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function validateId() {
        if (isset($this->category->getCategoryId())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
