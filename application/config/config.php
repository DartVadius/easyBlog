<?php
/**
 * autoloader for classes 
 * 
 * @param string $class class name
 */
function __autoload($class) {
    preg_match_all('/[A-Z][^A-Z]*/', $class, $results);
    $results =  end($results[0]);
    $pathToClassFile = __DIR__ . '/../'. strtolower($results). '/' . $class.'.php';
    if (file_exists($pathToClassFile)) {
        require_once $pathToClassFile;
    }
}
/**
 * DB connection
 */
define("HOST_NAME", 'localhost');
define("DB_NAME", 'blog');
define("USER_NAME", 'root');
define("PASSWORD", '');

/**
 * params for Application class 
 */

return [
    'layout' => 'layout',
    'defaultController' => 'index',
    'defaultAction' => 'index',
    'title' => 'Book Shop',
    'defaultUser' => 0,
    'articlesOnPage' => 5
];