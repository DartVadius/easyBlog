<div>
    <form action="article/saveArticle" method="POST">
        <label for="title" class="">Заголовок статьи</label><br>
        <input name="title" type="text" size="100" required='required'><br><br>
        <label for="short_desc" class="">Краткое описание статьи</label><br>
        <textarea name="short_desc" cols="100" rows="3" required='required'></textarea><br><br>
        <label for="text" class="">Полный текст статьи</label><br>
        <textarea name="text" cols="100" rows="10" required='required'></textarea><br><br>
        <label for="meta" class="">Ключевые слова</label><br>
        <input name="meta" type="text" size="100"><br><br>        
        <label for="category_id" class="">Выберите категорию</label><br>
        <select name ="category_id" size="1">
                <?php 			
                foreach ($category as $value) {
                        echo '<option value="'.$value->getCategoryId().'">'.$value->getCategoryName().'</option>';					
                }				
                ?>		
        </select><br><br>
        <label for="tag" class="">Тэги</label><br>
        <input name="tag" type="text" size="100"><br><br>
        <input type="submit" value="Добавить статью" name="submit">
        <input type="reset" value="Очистить">
    </form>
</div>