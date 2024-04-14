<?php namespace app\controllers;
use app\forms\LoginForm;

class LoginCtrl {

    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }

    function getParamsLogin(){
        $this->form->login = isset ($_REQUEST ['login']) ? $_REQUEST ['login'] : null;
        $this->form->pass = isset ($_REQUEST ['pass']) ? $_REQUEST ['pass'] : null;
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
            session_start();
            $_SESSION['role'] = 'admin';
            return true;
        }
        if ($this->form->login == "user" && $this->form->pass == "user") {
            session_start();
            $_SESSION['role'] = 'user';
            return true;
        }

        getMessages()->addError('Niepoprawny login lub hasło');
        return false;
    }

    public function process() {
        global $conf;
        $this->getParamsLogin();
        $smarty = getSmarty();
        $smarty->assign('form',$this->form);
        $smarty->assign('app_root',$conf->app_root);
        $smarty->assign('app_url',$conf->app_url);
        $smarty->assign('root_path',$conf->root_path);
        if (!$this->validateLogin()) {
            $smarty->assign('messages',getMessages());
            $smarty->display('LoginView.tpl');
        } else {
            header("Location: ".$conf->app_url);
        }
    }

    public function logout() {
        session_start();
        session_destroy();

        header("Location: ".$conf->app_url);
    }

}