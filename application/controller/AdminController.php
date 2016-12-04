<?php

/**
 * AdminController
 *
 * @author DartVadius
 */
class AdminController extends BaseController {
    public function indexAction() {
        if (empty($_SESSION['user_group']) || $_SESSION['user_group'] < 5) {
            header("Location: /blog/index");
            exit();
        } 
        $rep = new ArticleRepository();
        if ($_SESSION['user_group'] >= 10) {
            $artId = SupportLib::page('article', Application::$App->admin_art_limit, 1);            
        } else {
            $artId = SupportLib::page('article', Application::$App->admin_art_limit, 1, $_SESSION['user_id']);
        }        
        if (!empty($artId)) {
            $art = array();
            foreach ($artId as $id) {
                array_push($art, $rep->findById($id));
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
