<?php

/**
 * ArticleModel
 *
 * @author DartVadius
 */
class ArticleModel extends BaseModel {
    protected static $tableName = 'article';
    private $artId;
    private $artTitle;
    private $artDesc;
    private $artText;
    private $artCategory;
    private $artAuthor;
    private $artMeta;
    private $artDate;
    private $artUpdate;
    public function __construct($artTitle, $artDesc, $artText, $artCategory, $artAuthor, $artMeta = '') {
        parent::__construct();
        $this->artTitle = $artTitle;
        $this->artDesc = $artDesc;
        $this->artText = $artText;
        $this->artCategory = $artCategory;
        $this->artAuthor = $artAuthor;
        $this->artMeta = $artMeta;
    }
    public static function getTableName() {
        return self::$tableName;
    }

    public function setArtId($id) {
        $this->artId = $id;
    }
    public function setArtDate($date) {
        $this->artDate = $date;
    }
    public function setArtUpdate($date) {
        $this->artUpdate = $date;
    }
    public function setArtMeta($meta) {
        $this->artMeta = $meta;
    }

    public function __get($name) {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }

    public function save() {
        $sql =  "INSERT INTO ". self::$tableName . " SET
        article_title = :artTitle,
        article_desc = :artDesc,
        article_text = :artText,
        article_category = :artCategory,
        article_author = :artAuthor,
        article_date = :artDate,
        article_meta = :artMeta";
        $date = date("Y-m-d H:i:s");
        $arr = array (
            'artTitle' => $this->artTitle,
            'artDesc' => $this->artDesc,
            'artText' => $this->artText,
            'artCategory' => $this->artCategory,
            'artAuthor' => $this->artAuthor,
            'artDate' => $date,
            'artMeta' => $this->artMeta
        );
        try {
            $res = $this->pdo->prepare($sql);
            $res->execute($arr);
            return TRUE;
        } catch (PDOException $ex) {
            return 'Что-то пошло не так: ' . $ex->getMessage();
        }
    }
    public function update() {
        $sql =  "UPDATE " . self::$tableName . " SET
        article_title = :artTitle,
        article_desc = :artDesc,
        article_text = :artText,
        article_category = :artCategory,
        article_author = :artAuthor,
        article_meta = :artMeta
        WHERE article_id = $this->artId";
        $arr = array (
            'artTitle' => $this->artTitle,
            'artDesc' => $this->artDesc,
            'artText' => $this->artText,
            'artAuthor' => $this->artAuthor,
            'artCategory' => $this->artCategory,
            'artMeta' => $this->artMeta
        );
        try {
            $res = $this->pdo->prepare($sql);
            $res->execute($arr);
            return TRUE;
        } catch (PDOException $ex) {
            return 'Что-то пошло не так: ' . $ex->getMessage();
        }
    }
}