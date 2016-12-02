<?php

/**
 * GroupValidate
 *
 * @author DartVadius
 */
class GroupValidate implements iValidate {
    private $group = NULL;
    public function __construct(GroupModel $data) {
        $this->group = $data;
    }
    public function validate() {
        if (isset($this->group->getGroupValue()) && is_numeric($this->group->getGroupValue()) &&
            isset($this->group->getGroupName()) && isset($this->group->getGroupDesc())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function validateId() {
        if (isset($this->group->getGroupId())) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
