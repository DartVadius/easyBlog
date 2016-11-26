<?php
class SequreLib {
    public static function hashing($str) {
        return hash('ripemd256', $str);
    }
}
