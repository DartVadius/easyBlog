<?php
/**
 * ArticleController
 *
 * @author DartVadius
 */
class ArticleController extends BaseController {
    /**
     * redirect to index page
     */
    public function indexAction() {
        header("Location: /blog/index");
        exit();
    }

    /**
     * open empty form for add new article
     */
    public function addArticleAction() {
        if (empty($_SESSION['user_group']) || $_SESSION['user_group'] < 5) {
            header("Location: /blog/index");
            exit();
        }
        //список категорий для селекта в форме добавления статьи
        $tree = SupportLib::tree('category_id', 'category_parent_id', 'category');
        $param = array (
            ['layout/logged', ['' => '']],
            ['article/addArticle', ['tree' => $tree]]
        );
        $this->view->render($param);
    }
    /**
     * save a new article in database
     */
    public function saveAction() {
        $article = new ArticleModel($_POST['title'], $_POST['desc'], $_POST['text'], $_POST['category_id'], $_SESSION['user_id']);
        if (!empty($_POST['meta'])) {
            $article->setArtMeta($_POST['meta']);
        }
        $valid = new ArticleValidate($article);
        if ($valid->validate()) {
            $article->save();
            $artId = $this->pdo->lastInsertId();
        } else {
            header("Location: /blog/article/addarticle");
            exit();
        }
        //обработка и запись тэгов, если они есть
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

    public function idAction($id = NULL) {
        if ($id == NULL) {
            header("Location: /blog/index");
            exit();
        }
        $art = new ArticleRepository();
        $newArt = $art->findById($id);
        if (!empty($_SESSION['user_id'])) {
            $param = array (
                ['layout/logged', ['' => '']],
                ['layout/menu', ['' => '']],
                ['article/id', ['article' => $newArt]]
            );
        } else {
            $param = array (
                ['layout/guest', ['' => '']],
                ['layout/menu', ['' => '']],
                ['article/id', ['article' => $newArt]]
            );
        }

        $this->view->render($param);
    }

    public function updateArticleAction($id) {        
        if (empty($_SESSION['user_group']) || $_SESSION['user_group'] <= 1) {
            header("Location: /blog/index");
            exit();
        }
        if ($id == NULL) {
            header("Location: /admin/index");
            exit();
        }
        $art = new ArticleRepository();        
        $newArt = $art->findById($id);
        
        if (empty($newArt)) {
            header("Location: /blog/admin/index");
            exit();
        }
        
        $tree = SupportLib::tree('category_id', 'category_parent_id', 'category');
        $param = array (
            ['layout/logged', ['' => '']],
            ['article/update', ['art' => $newArt, 'tree' => $tree]]
        );
        $this->view->render($param);
    }
}
