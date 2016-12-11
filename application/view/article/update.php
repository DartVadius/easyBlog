<?php
$cat = showTree($tree, $art);
/**
 * 
 * @staticvar string $tree
 * @param array $data 
 * @param object $art
 * @return string
 */
function showTree($data, $art) {
    static $tree;
    foreach($data as $arr){
        if (!empty($arr['children'])) {
            if ($art->artCategory == $arr['category_id']) {
                $tree .= "<option value='{$arr['category_id']}' selected='selected'>" . $arr['category_name'] . "</option>";
            } else {
                $tree .= "<option value='{$arr['category_id']}'>" . $arr['category_name'] . "</option>";
            }
            showTree ($arr['children'], $art);
        } else {
            if ($art->artCategory == $arr['category_id']) {
                $tree .= "<option value='{$arr['category_id']}' selected='selected'>" . $arr['category_name'] . "</option>";
            } else {
                $tree .= "<option value='{$arr['category_id']}'>" . $arr['category_name'] . "</option>";
            }
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
        <form class="" action="/blog/article/update" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $art->artId ?>">
            <label for="title" class="">Заголовок статьи</label><br>
            <input name="title" value="<?php echo $art->artTitle ?>" type="text" size="120" required='required'><br><br>
            <label for="desc" class="">Краткое описание статьи</label><br>
            <textarea name="desc" cols="120" rows="3" required='required'><?php echo $art->artDesc ?></textarea><br><br>
            <script>
                CKEDITOR.replace( 'desc' );
            </script>
            <label for="text" class="">Полный текст статьи</label><br>
            <textarea name="text" cols="120" rows="10" required='required'><?php echo $art->artText ?></textarea><br><br>
            <script>
                CKEDITOR.replace( 'text' );
            </script>
            <label for="meta" class="">Мета</label><br>
            <input name="meta" value="<?php echo $art->artMeta ?>" type="text" size="120"><br><br>
            <label for="category_id" class="">Выберите категорию</label><br>
            <select name ="category_id" size="1">
                <?php echo $cat; ?>
            </select><br><br>
            <label for="tag" class="">Тэги (через запятую)</label><br>
            <input name="tag" type="text" value="<?php echo $tags; ?>" size="120"><br><br>
            <input type="submit" value="Save" name="submit" class="btn btn-primary wellcome">
        </form>
    </div>
</div>