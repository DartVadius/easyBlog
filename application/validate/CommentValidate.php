<?php

/**
 * CommentValidate
 *
 * @author DartVadius
 */
class CommentValidate implements iValidate {
    private $comment = NULL;
    public function __construct(CommentModel $data) {
        $this->comment = $data;
    }
    public function validate() {
        if (isset($this->comment->getCommentUserId()) && is_numeric($this->comment->getCommentUserId()) &&
                isset($this->comment->getCommentArticleId()) && is_numeric($this->comment->getCommentArticleId()) &&
                isset($this->comment->getCommentText())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function validateId() {
        if (isset($this->comment->getCommentId())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
