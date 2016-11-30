<?php

/**
 * CommentRepository
 *
 * @author DartVadius
 */
class CommentRepository extends BaseRepository {
    /**
     * find all comments by article Id
     * 
     * @param int $id
     * @return boolean|array of objects
     */
    public function findByArtId($id) {
        $commentList = array();
        $sql = "SELECT * FROM " . CommentModel::getTableName();
        $res = $this->pdo->query($sql);
        $comm = $res->fetchAll();
        if ($comm) {
            foreach ($comm as $comment) {
                $newComment = new CommentModel(
                        $comment['comment_user_id'], 
                        $comment['comment_article_id'], 
                        $comment['comment_text']);
                        
                $newComment->setCommentParentId($comment['comment_parent_id']);
                $newComment->setCommentId($comment['comment_id']);
                $newComment->setCommentDate($comment['comment_date']);
                array_push($commentList, $newComment);
            }
            return $commentList;
        } else {
            return FALSE;
        }
    }   
}
