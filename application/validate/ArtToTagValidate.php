<?php

/**
 * ArtToTagValidate
 *
 * @author DartVadius
 */
class ArtToTagValidate implements iValidate {
    private $artToTag = NULL;
    public function __construct(ArtToTagModel $data) {
        $this->artToTag = $data;
    }
    public function validate() {
        if (is_numeric($this->artToTag->getArtId()) && is_numeric($this->artToTag->getTagId())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * check existence in DB
     * 
     * @return boolean
     */
    public function validateId() {
        $pdo = PDOLib::getInstance()->getPdo();
        $sql = "SELECT * FROM " . ArtToTagModel::getTableName() . 
                " WHERE art_to_tag_art_id = " . $this->artToTag->getArtId() . 
                " AND art_to_tag_tag_id = " . $this->artToTag->getTagId();
        $res = $this->pdo->query($sql);
        $user = $res->fetch();
        if (isset($user)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
