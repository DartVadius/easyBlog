<?php

/**
 * AdminController
 *
 * @author DartVadius
 */
class AdminController extends BaseController {
    /**
     * index page for admin panel
     *
     * @param int $page
     * @param string $sort
     */
    public function indexAction($page = 1, $sort = 'DESC') {
        //set $page value if page < 0 or page > total num of pages
        if ($page < 1) {
            $page = 1;
        }
        if ($page > $_SESSION['page_num']) {
            $page = $_SESSION['page_num'];
        }

        //variable used to return to the original page
        $_SESSION['admin_page'] = $page;

        //if access level not enough -> redirect to site main page
        if (empty($_SESSION['user_group']) || $_SESSION['user_group'] < 5) {
            header("Location: /blog/index");
            exit();
        }

        $rep = new ArticleRepository();

        //selecting what to show users accordint to their access level
        if ($_SESSION['user_group'] >= 10) {
            $artId = $rep->findAllId();
        } else {
            $artId = $rep->findAllId($_SESSION['user_id']);
        }

        //pagination and forming array of articles for render
        if (!empty($artId)) {
            $listId = SupportLib::pagination($artId, $page, Application::$App->admin_art_limit);
            $art = array();
            foreach ($listId as $id) {
                array_push($art, $rep->findById($id['article_id']));
            }
        } else {
            $art = '';
        }

        $param = array (
                ['layout/logged', ['' => '']],
                ['admin/index', ['articles' => $art, 'page' => $page]]
            );
        $this->view->render($param);
    }
    
    /**
     *
     */
    public function usersAction() {
        if ($_SESSION['user_group'] < 25 || empty($_SESSION['user_id'])) {
            header("Location: /blog/admin/index/{$_SESSION['admin_page']}");
            exit();
        }
        $rep = new UserRepository();
        $users = $rep->findAll();
        $param = array (
                ['layout/logged', ['' => '']],
                ['admin/users', ['users' => $users]]
            );
        $this->view->render($param);
    }
}
