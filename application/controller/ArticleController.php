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
        $article = new ArticleModel($_POST['title'], $_POST['desc'], $_POST['text'], $_POST['category_id'], $_SESSION['user_id']);
        if (!empty($_POST['meta'])) {
            $article->setArtMeta($_POST['meta']);
        }        
        $valid = new ArticleValidate($article);        
        //if ($valid->validate()) {
            $article->save();
            $artId = $this->pdo->lastInsertId();            
        //} else {            
            //header("Location: /blog/article/addarticle");
            //exit();
        //}        
        if (!empty($_POST['tag'])) {
            $tags = explode(',', $_POST['tag']);
            $tags = array_map('trim', $tags);
            $tags = array_map('strtolower', $tags);            
            $rep = new TagRepository();
            foreach ($tags as $tag) {                
                $find = $rep->findByName($tag);                
                if ($find) {
                    $tagId = $find->getTagId();                                        
                } else {
                    $newTag = new TagModel($tag);                    
                    $res = $newTag->save();                    
                    $tagId = $this->pdo->lastInsertId();                    
                }
                $newArtToTag = new ArtToTagModel($artId, $tagId);
                $newArtToTag->save();
            }
        }
        header("Location: /blog/admin");
        exit();
    }
    public function addArticleAction() {
        if ($_SESSION['user_group'] < 5) {
            header("Location: /blog/index");
            exit();
        }
        //список категорий для селекта в форме добавления статьи
        $cat = new CategoryRepository();
        $category = $cat->findAll();
        $param = array (
            ['layout/logged', ['' => '']],
            ['article/addArticle', ['category' => $category]]
        );
        $this->view->render($param);
    }
    
    
    public function pageAction($pageNum = 1) {
        $art = new ArticleRepository();
        $page = $art->getPage($pageNum);
        $param = array (
            ['article/page', ['page' => $page]]
        );
        $this->view->render($param);
    }
}
