<?php

/**
 * ArtToTagRepository
 *
 * @author DartVadius
 */
class ArtToTagRepository extends BaseRepository {
    public function findById($artId, $tagId) {
        $sql = "SELECT * FROM " . TagModel::getTableName() . " WHERE art_to_tag_art_id = :artId AND art_to_tag_tag_id = :tagId'";

        $arr = array (
            'artId' => $artId,
            'tagId' => $tagId
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
        $tag = $res->fetch();
        if (!empty($tag)) {
            return new ArtToTagModel($artId, $tagId);
        } else {
            return FALSE;
        }
    }

    public function findByArtId($artId) {
        $sql = "SELECT * FROM " . TagModel::getTableName() . " WHERE art_to_tag_art_id = :artId'";
        $arr = array (
            'artId' => $artId
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
        $tags = $res->fetchAll();
        if (!empty($tags)) {
            $tagArtList = array();
            foreach ($tags as $tag) {
                $newTagArt = new ArtToTagModel($tag['art_to_tag_art_id'], $tag['art_to_tag_tag_id']);
                array_push($tagArtList, $newTagArt);
            }
            return new $tagArtList;
        } else {
            return FALSE;
        }
    }

    /**
     * delete one row in  junction table
     *
     * @param int $artId
     * @param int $tagId
     */
    public function deleteArtToTag($artId, $tagId) {
        $sql = "DELETE FROM " . ArtToTagModel::getTableName() . " WHERE art_to_tag_art_id = :artId AND art_to_tag_tag_id = :tagId";
        $arr = array (
            'artId' => $artId,
            'tagId' => $tagId
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
    }
    /**
     * delete all links by article ID
     *
     * @param int $artId
     */
    public function deleteByArtId($artId) {
        $sql = "DELETE FROM " . ArtToTagModel::getTableName() . " WHERE art_to_tag_art_id = :artId";
        $arr = array (
            'artId' => $artId
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
    }
    /**
     * delete all links by tag ID
     *
     * @param int $tagId
     */
    public function deleteByTagId($tagId) {
        $sql = "DELETE FROM " . ArtToTagModel::getTableName() . " WHERE art_to_tag_tag_id = :tagId";
        $arr = array (
            'tagId' => $tagId
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
    }
}
