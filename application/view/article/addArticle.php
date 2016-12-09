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
    <div class="col-lg-2">
        <a class="btn btn-sm btn-block btn-primary" href='/blog/admin'>Main</a>
        <a class="btn btn-sm btn-block btn-primary" href='/blog/article/addArticle'>New article</a>
    </div>
    <div class="col-lg-10">
        <form class="" action="/blog/article/save" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="">
            <label for="title" class="">Заголовок статьи</label><br>
            <input name="title" type="text" size="100" required='required'><br><br>
            <label for="desc" class="">Краткое описание статьи</label><br>
            <textarea name="desc" cols="100" rows="3" required='required'></textarea><br><br>
            <script>
                CKEDITOR.replace('desc');
            </script>
            <label for="text" class="">Полный текст статьи</label><br>
            <textarea id="full" name="text" cols="100" rows="10" required='required'></textarea><br><br>
            <script>
                CKEDITOR.replace('text');
            </script>
            <label for="meta" class="">Мета</label><br>
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