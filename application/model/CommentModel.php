<?php

/**
 *CommentModel
 *
 * @author DartVadius
 */
class CommentModel extends BaseModel {
    protected static $tableName = 'comment';
    private $commentId;
    private $commentParentId = 0;
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
    public static function getTableName() {
        return self::$tableName;
    }
    public function getCommentUserId() {
        return $this->commentUserId;
    }
    public function getCommentArticleId() {
        return $this->commentArticleId;
    }
    public function getCommentDate() {
        return $this->commentDate;
    }
    public function getCommentText() {
        return $this->commentText;
    }

    public function setCommentParentId($id) {
        $this->commentParentId = $id;
    }
    public function setCommentId($id) {
        $this->commentId = $id;
    }
    public function setCommentDate($date) {
        $this->commentDate = $date;
    }
    public function getCommentId() {
        return $this->commentId;
    }
    public function getCommentParentId() {
        return $this->commentParentId;
    }
    public function save() {
        $sql =  "INSERT INTO " . self::$tableName . " SET
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
        $sql =  "UPDATE " . self::$tableName . " SET
        comment_text = :commentText
        WHERE comment_id = $this->commentId";
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