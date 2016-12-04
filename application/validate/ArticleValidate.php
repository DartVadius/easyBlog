<?php
/**
 * saveArticleValidate
 *
 * @author DartVadius
 */
class ArticleValidate implements iValidate {
    private $article = NULL;
    public function __construct(ArticleModel $data) {
        $this->article = $data;
    }
    /**
     * validate model
     * 
     * @return boolean
     */
    public function validate() {        
        if (!empty($this->article->artTitle) &&
            !empty($this->article->artDesc) &&
            !empty($this->article->artCategory) && is_numeric($this->article->artCategory) &&
            !empty($this->article->artAuthor) && is_numeric($this->article->artAuthor)) 
            {
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
        if (isset($this->article->artId)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
