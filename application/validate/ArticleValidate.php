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
        if ($this->article->artTitle &&
            $this->article->artDesc &&
            $this->article->artText &&    
            $this->article->artCategory && preg_match('/^\d+$/', $this->article->artCategory) &&
            $this->article->artAuthor && preg_match('/^\d+$/', $this->article->artAuthor)) 
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
