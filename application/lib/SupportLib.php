<?php

/**
 * supportLib
 *
 * @author DartVadius
 */
class SupportLib {
    /**
     * pagination
     * 
     * 
     * @param array $arrayObj
     * @param int $page
     * @return boolean|array of objects
     */
    public static function page($tableName, $limit, $page = 1, $author = NULL) {
        $pageList = array();
        $pdo = PDOLib::getInstance()->getPdo();
        if ($author == NULL) {
            $sql = "SELECT COUNT(*) FROM " . $tableName;
        } else {
            $sql = "SELECT COUNT(*) FROM " . $tableName . " WHERE article_author = '$author'";
        }
        
        $res = $pdo->query($sql);
        $count = $res->fetch();
        $objCount = $count['COUNT(*)'];
        
        //количество страниц 
        $pages = ceil($objCount / $limit);
        
        //если статей нет 
        if ($pages == 0) {            
            return FALSE;
        } 
        //если запрашиваемая страница больше общего количества страниц - выводится первая страница
        if ($pages < $page || $page < 0) {
            $page = 1;
        }
        //точка отсчета для выборки
        $start = $page * $limit - $limit;
        $name = $tableName . "_id";
        if ($author == NULL) {            
            $sql = "SELECT $name FROM " . $tableName . " LIMIT $start, $limit";
        } else {            
            $sql = "SELECT $name FROM " . $tableName . " WHERE article_author = '$author' LIMIT $start, $limit";
        }        
        $res = $pdo->query($sql);
        $list = $res->fetchAll(PDO::FETCH_NUM);        
        if (!empty($list)) {
            $newList = array();
            foreach ($list as $value) {
                array_push($newList, $value[0]);
            }
            return $newList;
        } else {
            return FALSE;
        }
    }
    /**
     * 
     * @param string $id name of ID folder in DB
     * @param string $parent_id name of parent ID folder in DB     
     * @param string $table  table name in DB
     * @return array
     */
    public static function Tree($id, $parent_id, $table) {
        $pdo = PDOLib::getInstance()->getPdo();
        $sql = "SELECT * FROM " . $table;
        $res = $pdo->query($sql);
        $category = $res->fetchAll();        
        $tree = [['children' => []]];
        $references = [&$tree[0]];
        foreach($category as $item) {
            if(isset($references[$item[$id]])) {
                $item['children'] = $references[$item[$id]]['children'];
            }
            $references[$item[$parent_id]]['children'][] = $item;
            $references[$item[$id]] =& $references[$item[$parent_id]]['children'][count($references[$item[$parent_id]]['children']) - 1];
        }        
        return $tree[0]['children'];
    }
    /**
     * 
     * @todo !!!!!!!
     */
    public static function showTree($comments) {
    static $tree;
    $tree .= "<ul>";
    foreach($comments as $arr){
        $tree .= "<li class='list-unstyled'><p>РџРѕР»СЊР·РѕРІР°С‚РµР»СЊ ".$arr['comment_username']." РЅР°РїРёСЃР°Р»:</p></li>";
        $tree .= "<li class='list-unstyled small'><p>Р”Р°С‚Р°: ".$arr['comment_datetime']."</p></li>";
        $tree .= "<li class='list-unstyled'><p>".$arr['comment_text']."</p></li>";
        $tree .= <<<EOT
        <li class='list-unstyled'>
        <div>
            <input class="hide" id="{$arr['comment_id']}" type="checkbox" >
            <label for="{$arr['comment_id']}">РћС‚РІРµС‚РёС‚СЊ</label>
        <div>
        <div>
            <form action="comment.php" method="post" name="addcomment">
                <div class="form-group">
                    <input type="hidden" class="form-control" id="postid" name="commentpostid" value="{$arr['post_id']}">
                    <input type="hidden" class="form-control" id="parentid" name="parentid" value="{$arr['comment_id']}">
                </div>
                <div class="form-group">
                    <label for="username">Р�РјСЏ</label>
                    <input type="text" class="form-control" name="username" required="">
                    <label for="content">РљРѕРјРјРµРЅС‚Р°СЂРёР№</label>
                    <textarea class="form-control" id="content" placeholder="Enter text" name="content"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">РћС‚РїСЂР°РІРёС‚СЊ</button>
                </div>
            </form>
        </div>
        </li><br>
EOT;
        if($arr['children']){
            showTree ($arr['children']);
        }
    }
    $tree .= "</ul>";
    return $tree;
}
}