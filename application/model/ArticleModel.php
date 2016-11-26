<?php

/**
 * ArticleModel
 *
 * @author DartVadius
 */
class ArticleModel extends BaseModel {
    private $tableName = 'article';
    private $artId;
    private $artTitle;
    private $artDesc;
    private $artText;
    private $artCategory;
    private $artAuthor;
    private $artMeta;
    private $artDate;
    private $artUpdate;
    public function __construct($artTitle, $artDesc, $artText, $artCategory, $artAuthor, $artMeta) {
        parent::__construct();
        $this->artTitle = $artTitle;
        $this->artDesc = $artDesc;
        $this->artText = $artText;
        $this->artCategory = $artCategory;
        $this->artAuthor = $artAuthor;
        $this->artMeta = $artMeta;
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
    public function save() {
        $sql =  "INSERT INTO $this->tableName SET
        article_title = :artTitle,
        article_desc = :artDesc,
        article_text = :artText,
        article_category = :artCategory,
        article_author = :artAuthor,
        article_date = :artDate,
        article_update = :artUpdate,
        article_meta = :artMeta";
        $date = date("Y-m-d H:i:s");
        $arr = array (
            'artTitle' => $this->artTitle,
            'artDesc' => $this->artDesc,
            'artText' => $this->artText,
            'artCategory' => $this->artCategory,
            'artAuthor' => $this->artAuthor,
            'artDate' => $date,
            'artUpdate' => $date,
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

    }
}