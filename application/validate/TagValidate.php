<?php

/**
 * TagValidate
 *
 * @author DartVadius
 */
class TagValidate implements iValidate {
    private $tag = NULL;
    public function __construct(TagModel $data) {
        $this->tag = $data;
    }
    public function validate() {
        if (preg_match("/^[a-z\d]$/i", $this->tag->getTagName())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    /**
     * check existence of Id in object
     * 
     * @return boolean
     */
    public function validateId() {
        if (isset($this->tag->getTagId())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
