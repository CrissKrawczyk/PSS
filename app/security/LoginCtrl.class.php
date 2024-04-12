<?php
require_once dirname(__FILE__).'/../../config.php';
require_once $conf->root_path.'/app/security/LoginForm.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/lib/vendor/autoload.php';
use Smarty\Smarty;

class LoginCtrl {

    private $msgs;
    private $form;

    public function __construct() {
        $this->msgs = new Messages();
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
            $this->msgs->addError('Nie podano loginu');
        }
        if ( $this->form->pass == "") {
            $this->msgs->addError('Nie podano hasła');
        }
        if ($this->msgs ->hasError()) return false;

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

        $this->msgs->addError('Niepoprawny login lub hasło');
        return false;
    }

    public function process() {
        global $conf;
        $this->getParamsLogin();
        $smarty = new Smarty();
        $smarty->assign('form',$this->form);
        $smarty->assign('app_root',$conf->app_root);
        $smarty->assign('app_url',$conf->app_url);
        $smarty->assign('root_path',$conf->root_path);
        if (!$this->validateLogin()) {
            $smarty->assign('messages',$this->msgs);
            $smarty->display($conf->root_path.'/app/security/login_view.tpl');
        } else {
            header("Location: ".$conf->app_url);
        }
    }

}