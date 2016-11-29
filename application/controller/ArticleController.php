<?php
/**
 * ArticleController
 *
 * @author DartVadius
 */
class ArticleController extends BaseController {
    public function indexAction() {
        
    }

    public function saveArticleAction() {
        $artTitle = SequreLib::clearReq($_POST['title']);
        $artDesc = SequreLib::clearReq($_POST['short_desc']);
        $artText = SequreLib::clearReq($_POST['text']);
        $artCategory = SequreLib::clearReq($_POST['category_id']);
        $artAuthor = $_SESSION['user_id'];
        $artMeta = SequreLib::clearReq($_POST['meta']);
        $article = new ArticleModel($artTitle, $artDesc, $artText, $artCategory, $artAuthor, $artMeta);
        $valid = new ArticleValidate($article);
    }
    public function addArticleAction() {
        //список категорий для селекта в форме добавления статьи
        $cat = new CategoryRepository();
        $category = $cat->findAll();
        $param = array (
            ['addArticle', ['category' => $category]]
        );
        $this->view->render($param);
    }
}
