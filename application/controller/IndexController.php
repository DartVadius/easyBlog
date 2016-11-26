<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.11.16
 * Time: 10:26
 */
class IndexController extends BaseController {
    public function indexAction() {
        $book = new BookRepository();
        $books = $book->findAll();      
        //index - ищет view/book/index.php
        $this->view->render('index', ['books' => $books]);
    }
}