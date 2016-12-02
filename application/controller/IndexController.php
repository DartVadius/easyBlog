<?php
/**
 * IndexController
 */
class IndexController extends BaseController {
    public function indexAction() {
        //SupportLib::page('article');
        /*$rep = new CategoryRepository();             
        $tree = SupportLib::Tree('category_id', 'category_parent_id', 'category');           
        $cat = $rep->findChildren($tree, 1);
        $id = $rep->findChildrenCategoryId($cat);         
        $art = new ArticleRepository();
        $articles = $art->getPage();*/
        if (!empty($_SESSION['user_id'])) {
            $param = array (
                ['layout/logged', ['' => '']],
                ['index/index', ['' => '']]            
            );
        } else {
            $param = array (
                ['layout/guest', ['' => '']],
                ['index', ['' => '']]            
            );
        }
        
        $this->view->render($param);
    }
    
   /** public function error($exception = '') {
        $param = array (['error', ['exception' => $exception]]);
        $this->view->render($param);        
    }*/
}