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
    <div class="col-lg-10">
        <form class="" action="/blog/article/save" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $art->artId ?>">
            <label for="title" class="">Заголовок статьи</label><br>
            <input name="title" value="<?php echo $art->artTitle ?>" type="text" size="120" required='required'><br><br>
            <label for="desc" class="">Краткое описание статьи</label><br>
            <textarea name="desc" cols="120" rows="3" required='required'><?php echo $art->artDesc ?></textarea><br><br>
            <label for="text" class="">Полный текст статьи</label><br>
            <textarea name="text" cols="120" rows="10" required='required'><?php echo $art->artText ?></textarea><br><br>

            <label for="meta" class="">Ключевые слова</label><br>
            <input name="meta" value="<?php echo $art->artMeta ?>" type="text" size="120"><br><br>
            <label for="category_id" class="">Выберите категорию</label><br>
            <select name ="category_id" size="1">                
                <?php echo $cat; ?>
            </select><br><br>
            <label for="tag" class="">Тэги (через запятую)</label><br>
            <input name="tag" type="text" size="120"><br><br>
            <input type="submit" value="Добавить статью" name="submit" class="btn btn-primary wellcome">
        </form>
    </div>
</div>