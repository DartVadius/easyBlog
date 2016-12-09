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
        $sql = "SELECT * FROM ".ArticleModel::getTableName()." WHERE article_category = '$id'";
        $res = $this->pdo->query($sql);
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
    public function findAllId($author = NULL, $sort = 'ASC') {
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
}