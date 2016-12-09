<?php

/**
 * TagRepository
 *
 * @author DartVadius
 */
class TagRepository extends BaseRepository {
    public function findAll() {
        $tagList = array();
        $sql = "SELECT * FROM " . TagModel::getTableName();
        $res = $this->pdo->query($sql);
        $tags = $res->fetchAll();
        if ($tags) {
            foreach ($tags as $tag) {
                $newTag = new TagModel($tag['tags_name']);
                $newTag->setTagId($tag['tags_id']);
                array_push($tagList, $newTag);
            }
            return $tagList;
        } else {
            return FALSE;
        }
    }
    public function findByName($name) {
        $sql = "SELECT * FROM " . TagModel::getTableName() . " WHERE tags_name = '$name'";
        $res = $this->pdo->query($sql);
        $tag = $res->fetch();
        if (!empty($tag)) {
            $newTag = new TagModel($name);
            $newTag->setTagId($tag['tags_id']);
            return $newTag;
        } else {
            return FALSE;
        }
    }

    public function findById($id) {
        $sql = "SELECT * FROM ".TagModel::getTableName()." WHERE tags_id = '$id'";
        $res = $this->pdo->query($sql);
        $tags = $res->fetch();
        if ($tags) {
            $newTag = new TagModel($tags['tags_name']);
            $newTag->setTagId($tags['tags_id']);
            return $newTag;
        } else {
            return FALSE;
        }
    }

    public function findByArtId($id) {
        $tagList = array();
        $sql = "SELECT tags_id, tags_name FROM tags
            LEFT JOIN art_to_tag ON tags_id = art_to_tag_tag_id
            LEFT JOIN article ON article_id = art_to_tag_art_id
            WHERE article_id = :id";
        $arr = array (
            'id' => $id
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
        $tags = $res->fetchAll();
        if (!empty($tags)) {
            foreach ($tags as $tag) {
                $newTag = new TagModel($tag['tags_name']);
                $newTag->setTagId($tag['tags_id']);
                array_push($tagList, $newTag);
            }
            return $tagList;
        } else {
            return FALSE;
        }
    }
}
