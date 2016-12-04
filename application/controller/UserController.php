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
            if (!empty($user)) {
                $param = array (
                    ['layout/logged', ['' => '']],
                    ['user/user', ['user_name' => $user->getUserName(), 
                        'user_login' => $user->getUserLogin(),
                        'user_email' => $user->getUserEmail()]]
                );
            } else {
                throw new Exception('User not found', 400);
            }
        } else {
            $param = array (
                ['layout/guest', ['' => '']],
                ['user/user', [
                    'user_name' => 'Guest',
                    'user_login' => '',
                    'user_email' => ''
                    ]
                ]
            );  
        }
        $this->view->render($param);
    }

    public function registerAction() {
        if (!empty($_SESSION['user_id'])) {
            header("Location: /blog/user/index");
            exit();
        }
        $param = array (            
            ['user/register', ['' => '']]
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
                header("Location: /blog/user/register");
                exit();            
            }

            if (!empty($_POST['email'])) {
                $email = $_POST['email'];
                if (!SequreLib::emailValidate($email)) {
                    $_SESSION['msg'] = "Введите корректный email";
                    header("Location: /blog/user/register");
                    exit();
                }
                $user = new UserModel($name, $log, $pass, $email);
            } else {
                $user = new UserModel($name, $log, $pass);
            }
            
            $valid = new UserValidate($user);
            if (!$valid->validate()) {
                $_SESSION['msg'] = "Для логина и пароля можно использовать только латинские буквы и цифры";
                header("Location: /blog/user/register");
                exit();
            }        

            $rep = new UserRepository();

            if ($rep->findByName($name)) {
                $_SESSION['msg'] = 'Пользователь с таким именем уже зарегистрирован';
                header("Location: /blog/user/register");
                exit();
            }

            if ($rep->findByLogin($log)) {
                $_SESSION['msg'] = 'Пользователь с таким логином уже зарегистрирован';
                header("Location: /blog/user/register");
                exit();
            }

            $user->save();            
            $user = $rep->findByName($name);
            $id = $user->getUserId();
            $name = $user->getUserName();
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['msg'] = '';
            header("Location: /blog/user/index");
            exit();
        }
        header("Location: /blog/index");
        exit();
    }
    public function logoutAction() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_group']);
        header("Location: /blog/index");
        exit();
    }
    public function loginAction() {
        if (!empty($_POST['login']) && !empty($_POST['pass'])) {
            $log = SequreLib::clearReq($_POST['login']);
            $pass = SequreLib::clearReq($_POST['pass']);
            $_SESSION['msg'] = '';
            $rep = new UserRepository();
            $user = $rep->findByLogin($log);
            if (empty($user)) {
                $_SESSION['msg'] = 'Пользователь с таким логином и паролем не найден';                
            } else {
                $hash = $user->getUserPass();
                if (password_verify($pass, $hash)) {
                    $_SESSION['user_id'] = $user->getUserId();
                    $_SESSION['user_name'] = $user->getUserName();
                    $_SESSION['user_group'] = $user->getUserGroup();
                }
                else {
                    $_SESSION['msg'] = 'Пользователь с таким логином и паролем не найден';                
                }
            }            
            header("Location: /blog/index");
            exit();
        }
        header("Location: /blog/index");
        exit();
    }    
}
