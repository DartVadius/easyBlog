<?php

/**
 * 
 *
 * @author DartVadius
 */
class ClearLib {
    public static function clearReq($str) {
        $res = NULL;
        $res = trim($str);
        $res = addslashes($res);
        $res = htmlspecialchars ($res);
        return $res;
    }
}
