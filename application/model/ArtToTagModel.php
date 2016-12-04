<?php

/**
 * Description of ArtToTagModel
 *
 * @author DartVadius
 */
class ArtToTagModel extends BaseModel {
    protected static $tableName = 'art_to_tag';
    private $artId;
    private $tagId;
    public function __construct($artId, $tagId) {
        parent::__construct();
        $this->artId = $artId;
        $this->tagId = $tagId;
    }
    public static function getTableName() {        
        return self::$tableName;
    }
    public function getArtId() {
        return $this->artId;
    }
    public function getTagId() {
        return$this->tagId;
    }

    public function save() {
        $sql =  "INSERT INTO " . self::$tableName . " SET
        art_to_tag_art_id = :artId,
        art_to_tag_tag_id = :tagId";
        $arr = array (
            'artId' => $this->artId,
            'tagId' => $this->tagId
        );
        try {
            $res = $this->pdo->prepare($sql);
            $res->execute($arr);
            return TRUE;
        } catch (PDOException $ex) {
            return 'Что-то пошло не так: ' . $ex->getMessage();
        }
    }
    protected function update() {
        
    }
}