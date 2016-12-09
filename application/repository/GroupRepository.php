<?php

/**
 * GroupRepository
 *
 * @author DartVadius
 */
class GroupRepository extends BaseRepository {
    public function findAll() {
        $groupList = array();
        $sql = "SELECT * FROM `".GroupModel::getTableName()."`";
        $res = $this->pdo->query($sql);
        $groups = $res->fetchAll();
        if (!empty($groups)) {
            foreach ($groups as $group) {
                $newGroup = new GroupModel($group['group_name'], $group['group_value'], $group['group_desc']);
                $newGroup->setGroupId($group['group_id']);
                array_push($groupList, $newGroup);
            }
            return $groupList;
        } else {
            return FALSE;
        }
    }
    public function findByValue($val) {
        $sql = "SELECT * FROM `".GroupModel::getTableName()."` WHERE group_value = :val";
        $arr = array (
            'val' => $val
        );
        $res = $this->pdo->prepare($sql);
        $res->execute($arr);
        $group = $res->fetch();
        if (!empty($group)) {
            $newGroup = new GroupModel($group['group_name'], $group['group_value'], $group['group_desc']);
            $newGroup->setGroupId($group['group_id']);
            return $newGroup;
        } else {
            return FALSE;
        }
    }
}
