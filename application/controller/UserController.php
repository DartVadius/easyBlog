<?php

/**
 * UserController
 *
 * @author DartVadius
 */
class UserController extends BaseController {
    public function indexAction() {        
        if (!empty($_SESSION['user_id'])) {
            $rep = new UserRepository();
            $user = $rep->findById($_SESSION['user_id']);            
            if ($user) {
                $param = array (
                    ['user', ['user_name' => $user->getUserName(), 
                        'user_login' => $user->getUserLogin(),
                        'user_email' => $user->getUserEmail()]]
                );
            } else {
                throw new Exception('User not found', 400);
            }
        } else {
            $param = array (
                ['user', [
                    'user_name' => 'Guest',
                    'user_login' => '',
                    'user_email' => ''
                    ]
                ]
            );  
        }
        $this->view->render($param);
    }

    public function addUserAction() {
        if (!empty($_SESSION['user_id'])) {
            header("Location: /blog/user/index");
            exit();
        }
        $param = array (
            ['./view/layout/guest', ['' => '']],
            ['addUser', ['' => '']]
        );
        $this->view->render($param);
    }
    public function saveUserAction() {
        if (!empty($_POST)) {
            $_SESSION['msg'] = '';
            $name = SequreLib::clearReq($_POST['name']);        
            $_SESSION['reg_name'] = $name;
            $log = SequreLib::clearReq($_POST['login']);        
            $_SESSION['reg_log'] = $log;
            $pass = SequreLib::clearReq($_POST['pass']);        
            $passcheck = SequreLib::clearReq($_POST['passcheck']);        
            if ($pass != $passcheck) {
                $_SESSION['msg'] = 'Пароли не совпадают';
                header("Location: /blog/user/adduser");
                exit();            
            }

            if (!empty($_POST['email'])) {
                $email = $_POST['email'];
                if (!SequreLib::emailValidate($email)) {
                    $_SESSION['msg'] = "Введите корректный email";
                    header("Location: /blog/user/adduser");
                    exit();
                }
                $user = new UserModel($name, $log, $pass, $email);
            } else {
                $user = new UserModel($name, $log, $pass);
            }

            $valid = new UserValidate($user);
            if (!$valid->validate()) {
                $_SESSION['msg'] = "Для логина и пароля можно использовать только латинские буквы и цифры";
                header("Location: /blog/user/adduser");
                exit();
            }        

            $rep = new UserRepository();

            if ($rep->findByName($name)) {
                $_SESSION['msg'] = 'Пользователь с таким именем уже зарегистрирован';
                header("Location: /blog/user/adduser");
                exit();
            }

            if ($rep->findByLogin($log)) {
                $_SESSION['msg'] = 'Пользователь с таким логином уже зарегистрирован';
                header("Location: /blog/user/adduser");
                exit();
            }

            $user->save();
            $user = $rep->findByName($name);
            $id = $user->getUserId();
            $name = $user->getUserName();
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            header("Location: /blog/user/index");
            exit();
        }
        header("Location: /blog/index");
        exit();
    }
    public function logoutAction() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        header("Location: /blog/index");
        exit();
    }
    public function loginAction() {
        
    }
}
