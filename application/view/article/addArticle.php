<?php 
$cat = showTree($tree);

function showTree($data) {
    static $tree;    
    foreach($data as $arr){
        if (!empty($arr['children'])) {
            $tree .= "<option value='{$arr['category_id']}'>" . $arr['category_name'] . "</option>";
            showTree ($arr['children']);
        } else {
            $tree .= "<option value='{$arr['category_id']}'>" . $arr['category_name'] . "</option>";
        }
    }    
    return $tree;
}
?>

<div class="row">
    <div class="col-lg-1">
        
    </div>
    <div class="col-lg-11">
        <form class="" action="/blog/article/addarticle" method="POST" enctype="multipart/form-data">            
            <label for="title" class="">Заголовок статьи</label><br>
            <input name="title" type="text" size="100" required='required'><br><br>
            <label for="desc" class="">Краткое описание статьи</label><br>
            <textarea name="desc" cols="100" rows="3" required='required'></textarea><br><br>

            <label for="text" class="">Полный текст статьи</label><br>
            <textarea name="text" cols="100" rows="10" required='required'></textarea><br><br>

            <label for="meta" class="">Ключевые слова</label><br>
            <input name="meta" type="text" size="100"><br><br>
            <label for="category_id" class="">Выберите категорию</label><br>
            <select name ="category_id" size="1">                
                <?php echo $cat; ?>
            </select><br><br>
            <label for="tag" class="">Тэги (через запятую)</label><br>
            <input name="tag" type="text" size="100"><br><br>
            <input type="submit" value="Добавить статью" name="submit" class="btn btn-primary wellcome">
        </form>
    </div>    
</div>