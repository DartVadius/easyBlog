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
        $sql = "SELECT * FROM ".ArticleModel::getTableName()." WHERE article_id = $id";
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
    public function getPage($page = 1) {
        //количество статей
        $sql = "SELECT COUNT(*) FROM " . ArticleModel::getTableName();
        $res = $this->pdo->query($sql);
        $artCount = $res->fetch();
        //количество страниц с $this->artLimit статей на странице (задается в конфиге)
        $pages = ceil($artCount / $this->artLimit);
        //исходная статья для выборки
        $start = $page * $this->artLimit - $this->artLimit;
        $sql = "SELECT * FROM " . ArticleModel::getTableName() . "LIMIT $start, $this->artLimit";
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

    public function deleteById($id) {
        $sql = "DELETE FROM " . ArticleModel::getTableName() . " WHERE article_id = $id";
        $this->pdo->query($sql);
    }
}