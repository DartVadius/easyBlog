<?php

/**
 * ArticleRepository
 *
 * @author DartVadius
 */
class ArticleRepository extends BaseRepository {
    private $artLimit;
    public function __construct() {
        parent::__construct();
        $this->artLimit = Application::$App->articlesOnPage;
    }

    public function findById($id) {
        $sql = "SELECT * FROM ".ArticleModel::getTableName()." WHERE article_id = :id";
        $arr = array (
            'id' => $id
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
        $article = $res->fetch();
        if ($article) {
            $newArticle = new ArticleModel(
                $article['article_title'],
                $article['article_desc'],
                $article['article_text'],
                $article['article_category'],
                $article['article_author'],
                $article['article_meta']
            );
            $newArticle->setArtId($article['article_id']);
            $newArticle->setArtDate($article['article_date']);
            $newArticle->setArtUpdate($article['article_update']);
            return $newArticle;
        } else {
            return FALSE;
        }
    }

    public function findByCatId($id) {
        $artList = array();
        $sql = "SELECT * FROM ".ArticleModel::getTableName()." WHERE article_category = :id";
        $arr = array (
            'id' => $id
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
        $art = $res->fetchAll();
        if ($art) {
            foreach ($art as $article) {
                $newArticle = new ArticleModel(
                    $article['article_title'],
                    $article['article_desc'],
                    $article['article_text'],
                    $article['article_category'],
                    $article['article_author'],
                    $article['article_meta']
                );
                $newArticle->setArtId($article['article_id']);
                $newArticle->setArtDate($article['article_date']);
                $newArticle->setArtUpdate($article['article_update']);
                array_push($artList, $newArticle);
            }            
            return $artList;
        } else {
            return FALSE;
        }
    }

    public function findAll() {
        $artList = array();
        $sql = "SELECT * FROM " . ArticleModel::getTableName();
        $res = $this->pdo->query($sql);
        $art = $res->fetchAll();
        if ($art) {
            foreach ($art as $article) {
                $newArticle = new ArticleModel($article['article_title'],
                    $article['article_desc'],
                    $article['article_text'],
                    $article['article_category'],
                    $article['article_author'],
                    $article['article_meta']);
                $newArticle->setArtId($article['article_id']);
                $newArticle->setArtDate($article['article_date']);
                $newArticle->setArtUpdate($article['article_update']);
                array_push($artList, $newArticle);
            }
            return $artList;
        } else {
            return FALSE;
        }
    }

    /**
     * get all ID`s of articles in DB
     *
     * @return boolean | array
     */
    public function findAllId($author = NULL, $sort = 'DESC') {
        if ($author == NULL) {
            $sql = "SELECT article_id FROM " . ArticleModel::getTableName() . " ORDER BY article_id $sort";
        } else {
            $sql = "SELECT article_id FROM " . ArticleModel::getTableName() . " WHERE article_author = $author ORDER BY article_id $sort";
        }

        $res = $this->pdo->query($sql);
        $art = $res->fetchAll();
        if (!empty($art)) {
            return $art;
        } else {
            return FALSE;
        }
    }

    public function deleteById($id) {
        $sql = "DELETE FROM " . ArticleModel::getTableName() . " WHERE article_id = :id";
        $arr = array (
            'id' => $id
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
    }
    
    public function findByTagId($id) {
        $artList = array();
        $sql = " SELECT * FROM article 
                LEFT JOIN art_to_tag ON article_id = art_to_tag_art_id
                LEFT JOIN tags ON tags_id = art_to_tag_tag_id
                WHERE tags_id = :id ORDER BY article_id DESC";
        $arr = array (
            'id' => $id
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
        $articles = $res->fetchAll();        
        if (!empty($articles)) {
            foreach ($articles as $article) {
                $newArt = new ArticleModel($article['article_title'], $article['article_desc'], $article['article_text'], $article['article_category'], $article['article_author'], $article['article_meta']);
                $newArt->setArtId($article['article_id']);
                $newArt->setArtDate($article['article_date']);
                $newArt->setArtUpdate($article['article_update']);
                array_push($artList, $newArt);
            }
            return $artList;
        } else {
            return FALSE;
        }
    }
}