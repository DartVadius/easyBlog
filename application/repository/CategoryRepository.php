<?php

/**
 * CategoryRepository
 *
 * @author DartVadius
 */
class CategoryRepository extends BaseRepository {
    /**
     * get all categories
     * 
     * @return boolean|array of objects
     */
    public function findAll() {
        $categoryList = array();        
        $sql = "SELECT * FROM " . CategoryModel::getTableName();
        $res = $this->pdo->query($sql);
        $category = $res->fetchAll();
        if ($category) {
            foreach ($category as $value) {
                $newCategory = new CategoryModel($value['category_name'], $value['category_desc'], $value['category_parent_id']);
                $newCategory->setCategoryId($value['category_id']);
                array_push($categoryList, $newCategory);
            }
            return $categoryList;
        } else {
            return FALSE;
        }
    }  
    
    public function findById($id) {
        $sql = "SELECT * FROM " . CategoryModel::getTableName() . " WHERE category_id = '$id'";
        $res = $this->pdo->query($sql);
        $category = $res->fetch();
        if ($category) {            
            $newCategory = new CategoryModel($category['category_name'], $category['category_desc'], $category['category_parent_id']);
            $newCategory->setCategoryId($category['category_id']);
            return $newCategory;
        } else {
            return FALSE;
        }
    }

    /**
     * get branch of category starting from category ID = $id
     * 
     * @staticvar array $branch
     * @param array $tree -> get it from SupportLib::Tree
     * @param int $id
     * @return array
     */
    
    public function findChildren($tree, $id) {        
        static $branch;        
        foreach ($tree as $value) {            
            if ($value['category_id'] == $id) {
                $branch[0] = $value;                
            }
            if (isset($value['children'])) {
               $this->findChildren($value['children'], $id);
            }
        }        
        return $branch;
    }
    /**
     * get all category ID`s from this branch
     * 
     * @staticvar array $categoryID
     * @param array $branch -> get it from $this->findChildren()
     * @return array 
     */
    public function findChildrenCategoryId($branch) {
        static $categoryID = array();
        foreach ($branch as $cat) {            
            array_push($categoryID, $cat['category_id']);
            if (isset($cat['children'])) {
               $this->findChildrenCategoryId($cat['children']);
            }
        }
        return $categoryID;
    }

    public function deleteById($id) {
        $sql = "DELETE FROM " . CategoryModel::getTableName() . " WHERE category_id = $id";
        $this->pdo->query($sql);
    }
}

