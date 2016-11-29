<?php

/**
 * ArtToTagRepository
 *
 * @author DartVadius
 */
class ArtToTagRepository extends BaseRepository {
    public function deleteByArtId($artId) {
        $sql = "DELETE FROM " . ArtToTagModel::getTableName() . " WHERE art_to_tag_art_id = $artId";
        $this->pdo->query($sql);
    }
    public function deleteByTagId($tagId) {
        $sql = "DELETE FROM " . ArtToTagModel::getTableName() . " WHERE art_to_tag_tag_id = $tagId";
        $this->pdo->query($sql);
    }
}
