<?php
class SequreLib {
    public static function hashing($str) {
        return hash('ripemd256', $str);
    }
    public static function clearReq($str) {
        $res = NULL;
        $res = trim($str);
        $res = addslashes($res);
        $res = htmlspecialchars ($res);
        return $res;
    }
}
