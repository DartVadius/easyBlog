<?php
/**
 * IndexController
 */
class IndexController extends BaseController {
    public function indexAction() {
        
        $rep = new CategoryRepository();
        $cat = $rep->findAll();        
        /*$art = new ArticleRepository();
        $articles = $art->getPage();  */    
        $param = array (
            ['index', ['category' => $cat]],
            ['test', ['test' => 'testtest!']]
        );
        $this->view->render($param);
    }
    
    public function error($exception = '') {
        $param = array (['error', ['exception' => $exception]]);
        $this->view->render($param);        
    }
}