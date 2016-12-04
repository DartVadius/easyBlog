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
}
