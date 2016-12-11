<?php
if (!empty($commList)) {
    $commTree = showTree($commList, $article);    
}
function showTree($commList) {
    static $tree;
    $tree .= "<ul>";
    foreach($commList as $comm){        
        $us = new UserRepository();
        $user = $us->findById($comm['comment_user_id']);            
        $tree .=  "<li> Пользователь " . $user->getUserName() . " написал</li>";
        $tree .=  "<li class='small'> Дата: " . $comm['comment_date'] . "</li>";
        $tree .=  "<li>" . $comm['comment_text'] . "</li>";
        $tree .=  "<li><a class='btn btn-primary btn-sm' href='/blog/comment/answer/" . $comm['comment_id'] ."'>Ответить</a></li><hr/>";
        if (!empty($comm['children'])) {
            showTree ($comm['children']);
        }        
    }
    $tree .= "</ul>";
    return $tree;
}
?>

<div class="row">
    <div class="col-lg-1">
        <span></span>
    </div>
    <div class="col-lg-10 comm">        
        <h3 class='title-comments'>Комментарии</h3>
        <?php
        if (!empty($commTree)) {
            echo "$commTree";
        } else {
            echo "<h3 class='text-center'>Здесь пока нет комментариев</h3>";
        }
        ?> 
    </div>
    <div class="col-lg-1">

    </div>
</div>