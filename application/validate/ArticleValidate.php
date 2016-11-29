<?php
/**
 * saveArticleValidate
 *
 * @author DartVadius
 */
class ArticleValidate {
    private $article = NULL;
    public function __construct(ArticleModel $data) {
        $this->article = $data;
    }
    public static function validateModel() {
        if (isset($this->article->artTitle) &&
            isset($this->article->artDesc) &&
            isset($this->article->artCategory) && is_numeric($this->article->artCategory) &&
            isset($this->article->artAuthor) && is_numeric($this->article->artAuthor)
                
                ) {
            
        }
    }
}

/*
    private $artTitle;
    private $artDesc;
    private $artText;
    private $artCategory;
    private $artAuthor;
    private $artMeta;    */