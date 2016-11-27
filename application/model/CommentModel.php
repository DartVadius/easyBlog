<?php

/**
 *CommentModel
 *
 * @author DartVadius
 */
class CommentModel extends BaseModel {
    private $tableName = 'comments';
    private $commentId;
    private $commentParentId = NULL;
    private $commentUserId;
    private $commentArticleId;
    private $commentDate;
    private $commentText;
    public function __construct($commentUserId, $commentArticleId, $commentText) {
        parent::__construct();
        $this->commentUserId = $commentUserId;
        $this->commentArticleId = $commentArticleId;
        $this->commentText = $commentText;
    }
    public function setCommentParentId($id) {
        $this->commentParentId = $id;
    }
    public function save() {
        $sql =  "INSERT INTO $this->tableName SET
        comment_parent_id = :commentParentId,
        comment_user_id = :commentUserId,
        comment_article_id = :commentArticleId,
        comment_date = :commentDate,
        comment_text = :commentText";
        $date = date("Y-m-d H:i:s");
        $arr = array (
            'commentParentId' => $this->commentParentId,
            'commentUserId' => $this->commentUserId,
            'commentArticleId' => $this->commentArticleId,
            'commentDate' => $this->$date,
            'commentText' => $this->commentText
        );
        try {
            $res = $this->pdo->prepare($sql);
            $res->execute($arr);
            return TRUE;
        } catch (PDOException $ex) {
            return 'Что-то пошло не так: ' . $ex->getMessage();
        }
    }
    public function update() {
        $sql =  "UPDATE $this->tableName SET
        comment_text = :commentText";
        $arr = array (
            'commentText' => $this->commentText
        );
        try {
            $res = $this->pdo->prepare($sql);
            $res->execute($arr);
            return TRUE;
        } catch (PDOException $ex) {
            return 'Что-то пошло не так: ' . $ex->getMessage();
        }
    }
}