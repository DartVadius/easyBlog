<?php

/**
 * ArtToTagRepository
 *
 * @author DartVadius
 */
class ArtToTagRepository extends BaseRepository {
    /**
     * delete one row in  junction table
     * 
     * @param int $artId
     * @param int $tagId
     */
    public function deleteArtToTag($artId, $tagId) {
        $sql = "DELETE FROM " . ArtToTagModel::getTableName() . " WHERE art_to_tag_art_id = $artId AND art_to_tag_tag_id = $tagId";
        $this->pdo->query($sql);
    }
    /**
     * delete all links by article ID
     * 
     * @param int $artId
     */
    public function deleteByArtId($artId) {
        $sql = "DELETE FROM " . ArtToTagModel::getTableName() . " WHERE art_to_tag_art_id = $artId";
        $this->pdo->query($sql);
    }
    /**
     * delete all links by tag ID
     * 
     * @param int $tagId
     */
    public function deleteByTagId($tagId) {
        $sql = "DELETE FROM " . ArtToTagModel::getTableName() . " WHERE art_to_tag_tag_id = $tagId";
        $this->pdo->query($sql);
    }
}
