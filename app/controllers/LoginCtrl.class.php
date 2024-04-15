<?php namespace app\controllers;
use app\forms\LoginForm;
use app\model\User;

class LoginCtrl {

    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }

    function getParamsLogin(){
        $this->form->login = getFromRequest('login');
        $this->form->pass = getFromRequest('pass');
    }

    function validateLogin(){
        if ( ! (isset($this->form->login) && isset($this->form->pass))) {
            return false;
        }

        if ( $this->form->login == "") {
            getMessages()->addError('Nie podano loginu');
        }
        if ( $this->form->pass == "") {
            getMessages()->addError('Nie podano hasła');
        }
        if (getMessages() ->hasError()) return false;

        if ($this->form->login == "admin" && $this->form->pass == "admin") {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $user = new User($this->form->login, 'admin');
            $_SESSION['user'] = serialize($user);
            addRole($user->role);
            return true;
        }
        if ($this->form->login == "user" && $this->form->pass == "user") {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $user = new User($this->form->login, 'user');
            $_SESSION['user'] = serialize($user);
            addRole($user->role);
            return true;
        }

        getMessages()->addError('Niepoprawny login lub hasło');
        return false;
    }

    public function action_login() {
        $this->getParamsLogin();
        if (!$this->validateLogin()) {
            $this->generateView();
        } else {
            header("Location: ".getConf()->app_url."/");
        }
    }

    public function generateView() {
        $smarty = getSmarty();
        $smarty->assign('messages',getMessages());
        $smarty->assign('form',$this->form);
        $smarty->assign('app_root',getConf()->app_root);
        $smarty->assign('app_url',getConf()->app_url);
        $smarty->assign('root_path',getConf()->root_path);
        $smarty->display('LoginView.tpl');
    }

    public function action_logout() {
        session_destroy();
        $this->generateView();
    }

}