<?php

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 20.11.16
 * Time: 10:26
 */
class IndexController extends BaseController {
    public function indexAction() {
        $art = new ArticleRepository();
        $articles = $art->getPage();      
        $param = array ([
            'index', ['articles' => $articles]
        ]);
        $this->view->render($param);
    }
}