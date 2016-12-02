<?php
function __autoload($class) {

    preg_match_all('/[A-Z][^A-Z]*/', $class, $results);
    $results =  end($results[0]);
    $pathToClassFile = __DIR__ . '/../'. strtolower($results). '/' . $class.'.php';
    if (file_exists($pathToClassFile)) {
        require_once $pathToClassFile;
    }
}

define('APPLICATION_ENV', $_SERVER['APPLICATION_ENV']);

return [
    'layout' => 'layout',
    'defaultController' => 'index',
    'defaultAction' => 'index',
    'exceptionController' => 'error',
    'exceptionAction' => 'error',
    'title' => 'Easy Blog',
    //количество статей на странице
    'article_limit' => 5,
    //минимальная длина логина, имени и пароля
    'login_length' => 6,
    'name_length' => 3,
    'pass_length' =>6,
    //группа доступа, которая будет присваиваться новым зарегистрировавшимся пользователям по умолчанию
    'group_value' => 1,
    'db' => [
        'host' => '',
        'name' => '',
        'user' => '',
        'password' => ''
    ],
    'email' => [
        'name' => "DartVadius",
        'email' => 'test@gmail.com'
    ]
];