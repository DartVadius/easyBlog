<?php
/**
 * IndexController
 */
class IndexController extends BaseController {
    public function indexAction() {
        
        $rep = new CategoryRepository();             
        $tree = SupportLib::Tree('category_id', 'category_parent_id', 'category');           
        $cat = $rep->findChildren($tree, 1);
        $id = $rep->findChildrenCategoryId($cat);         
        /*$art = new ArticleRepository();
        $articles = $art->getPage();  */    
        $param = array (
            ['index', ['tree' => $cat]],
            ['test', ['test' => 'testtest!']]
        );
        $this->view->render($param);
    }
    
   /** public function error($exception = '') {
        $param = array (['error', ['exception' => $exception]]);
        $this->view->render($param);        
    }*/
}