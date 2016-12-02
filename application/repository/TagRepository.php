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
    public function findById($id) {
        $sql = "SELECT * FROM ".TagModel::getTableName()." WHERE tags_id = $id";
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
    /**
     * splits the string in array of tag objects
     * 
     * @param string $str
     * @return array
     */
    public function stringToTags($str) {
        $newTags = [];
        $tags = explode(",", $str);
        $tags = array_map(trim, $tags);
        foreach ($tags as $tag) {
            $newTag = new TagModel($tag);
            array_push($newTags, $newTag);
        }
        return $newTags;
    }
}
