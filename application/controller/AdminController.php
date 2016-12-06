<?php

/**
 * AdminController
 *
 * @author DartVadius
 */
class AdminController extends BaseController {
    public function indexAction($page = 1, $sort = 'DESC') {
        if (empty($_SESSION['user_group']) || $_SESSION['user_group'] < 5) {
            header("Location: /blog/index");
            exit();
        } 
        $rep = new ArticleRepository();        
        if ($_SESSION['user_group'] >= 10) {
            $artId = $rep->findAllId();
        } else {
            $artId = $rep->findAllId($_SESSION['user_id']);
        }
        $_SESSION['admin_page'] = 1;
        if (!empty($artId)) {
            $listId = SupportLib::pagination($artId, $page, Application::$App->admin_art_limit);
            $art = array();
            foreach ($listId as $id) {                
                array_push($art, $rep->findById($id['article_id']));
            }
            $param = array (
                ['layout/logged', ['' => '']],
                ['admin/index', ['articles' => $art]]
            ); 
        } else {
            $param = array (
                ['layout/logged', ['' => '']],
                ['admin/index', ['' => '']]
            ); 
        }
               
        $this->view->render($param);
    }    
    
}
