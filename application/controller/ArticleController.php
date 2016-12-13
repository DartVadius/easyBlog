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

        //the list of categories for a select in the form of addition of article
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
        if (isset($_POST)) {
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
            //processing and recording tags if they are set
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
        } else {
            header("Location: /blog/article/addarticle");
            exit();
        }
    }
    /**
     * open the selected article
     *
     * @param int $id
     */
    public function idAction($id = NULL) {
        if ($id == NULL) {
            header("Location: /blog/index");
            exit();
        }
        $art = new ArticleRepository();
        $newArt = $art->findById($id);
        $tag = new TagRepository();
        $tags = $tag->findByArtId($id);
        $commTree = SupportLib::tree('comment_id', 'comment_parent_id', 'comment');
        if (!empty($commTree)) {
            $commList = array();
            foreach ($commTree as $tree) {
                if ($tree['comment_article_id'] == $newArt->artId) {
                    array_push($commList, $tree);
                }
            }
        } else {
            $commList = '';
        }
        if (!empty($_SESSION['user_id'])) {
            $param = array (
                ['layout/logged', ['' => '']],
                ['layout/menu', ['' => '']],
                ['article/id', ['article' => $newArt, 'tags' => $tags]],
                ['article/comments', ['article' => $newArt, 'commList' => $commList]]
            );
        } else {
            $param = array (
                ['layout/guest', ['' => '']],
                ['layout/menu', ['' => '']],
                ['article/id', ['article' => $newArt, 'tags' => $tags]],
                ['article/comments', ['article' => $newArt, 'commList' => $commList]]
            );
        }

        $this->view->render($param);
    }
    /**
     * open form for updating selected article
     *
     * @param int $id
     */
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
        $tag = new TagRepository();
        $newTags = $tag->findByArtId($id);
        if (!empty($newTags)) {
            $tagList = array();
            foreach ($newTags as $newTag) {
                array_push($tagList, $newTag->getTagName());
            }
            $tags = implode(',', $tagList);
        } else {
            $tags = '';
        }
        $tree = SupportLib::tree('category_id', 'category_parent_id', 'category');
        $param = array (
            ['layout/logged', ['' => '']],
            ['article/update', ['art' => $newArt, 'tree' => $tree, 'tags' => $tags]]
        );
        $this->view->render($param);
    }
    /**
     * save article in database after updating
     */
    public function updateAction() {
        if (isset($_POST['id'])) {
            $article = new ArticleModel($_POST['title'], $_POST['desc'], $_POST['text'], $_POST['category_id'], $_SESSION['user_id']);
            $article->setArtId($_POST['id']);
            $artId = $article->artId;
            if (!empty($_POST['meta'])) {
                $article->setArtMeta($_POST['meta']);
            }
            $valid = new ArticleValidate($article);
            if ($valid->validate()) {
                $article->update();
            } else {
                header("Location: /blog/article/addarticle");
                exit();
            }
            //previously we delete all communications article->tag in the intermediate table
            $artToTag = new ArtToTagRepository();
            $artToTag->deleteByArtId($article->artId);
            //processing and recording tags if they are set
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
            header("Location: /blog/admin/index/{$_SESSION['admin_page']}");
            exit();
        } else {
            header("Location: /blog/article/addarticle");
            exit();
        }
    }
    /**
     * delete article by id, relationships with the tags are also deleted
     *
     * @param int $id
     */
    public function deleteAction($id = NULL) {
        if ($id == NULL) {
            header("Location: /blog/admin/index/{$_SESSION['admin_page']}");
            exit();
        }
        $rep = new ArticleRepository();
        $rep->deleteById($id);
        $artToTag = new ArtToTagRepository();
        $artToTag->deleteByArtId($id);
        header("Location: /blog/admin/index/{$_SESSION['admin_page']}");
        exit();
    }
    /**
     * find articles by tag
     *
     * @param int $id
     */
    public function tagAction($id = NULL) {
        if ($id == NULL) {
            header("Location: /blog/index/index/{$_SESSION['blog_page']}");
            exit();
        }
        $rep = new ArticleRepository();
        $art = $rep->findByTagId($id);
        if (!empty($_SESSION['user_id'])) {
            $param = array (
                ['layout/logged', ['' => '']],
                ['layout/menu', ['' => '']],
                ['article/tags', ['article' => $art]]
            );
        } else {
            $param = array (
                ['layout/guest', ['' => '']],
                ['layout/menu', ['' => '']],
                ['article/tags', ['article' => $art]]
            );
        }
        $this->view->render($param);
    }
    public function categoryAction($id = NULL) {
        if ($id == NULL) {
            header("Location: /blog/index/index/{$_SESSION['blog_page']}");
            exit();
        }
        $rep = new ArticleRepository();
        $art = $rep->findByCatId($id);        
        if (!empty($_SESSION['user_id'])) {
            $param = array (
                ['layout/logged', ['' => '']],
                ['layout/menu', ['' => '']],
                ['article/category', ['article' => $art]]
            );
        } else {
            $param = array (
                ['layout/guest', ['' => '']],
                ['layout/menu', ['' => '']],
                ['article/category', ['article' => $art]]
            );
        }
        $this->view->render($param);
    }
}
