<?php

/**
 * CategoryRepository
 *
 * @author DartVadius
 */
class CategoryRepository extends BaseRepository {
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

    /**
     * Функция превращает одномерный массив в многомерный по принципу родитель -> потомок
     *
     * @param array $array
     * @param string $id
     * @param string $parent_id
     * @param string $children
     * @return array
     */
    public function categoryTree($id = 'category_id', $parent_id = 'category_parent_id', $children = 'children') {              
        $sql = "SELECT * FROM " . CategoryModel::getTableName();
        $res = $this->pdo->query($sql);
        $category = $res->fetchAll();        
        $tree = [[$children => []]];
        $references = [&$tree[0]];
        foreach($category as $item) {
            if(isset($references[$item[$id]])) {
                $item[$children] = $references[$item[$id]][$children];
            }
            $references[$item[$parent_id]][$children][] = $item;
            $references[$item[$id]] =& $references[$item[$parent_id]][$children][count($references[$item[$parent_id]][$children]) - 1];
        }        
        return $tree[0][$children];
    }
    public function deleteById($id) {
        $sql = "DELETE FROM " . CategoryModel::getTableName() . " WHERE category_id = $id";
        $this->pdo->query($sql);
    }
}

