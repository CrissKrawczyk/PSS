<?php namespace app\controllers;
use app\forms\CalcForm;
use app\model\CalcResult;

class CalcCtrl {

    private $form;
    private $result;

    public function __construct() {
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    public function getParams(){
        $this->form->amount = isset ($_REQUEST ['amount']) ? $_REQUEST ['amount'] : null;
        $this->form->time = isset ($_REQUEST ['time']) ? $_REQUEST ['time'] : null;
        $this->form->interest = isset ($_REQUEST ['interest']) ? $_REQUEST ['interest'] : null;
    }

    public function validate() {
        if ( ! (isset($this->form->amount) && isset($this->form->time) && isset($this->form->interest))) {
            return false;
        }

        if ( $this->form->amount == "") {
            getMessages()->addError('Nie podano wartości kredytu');
        }
        if ( $this->form->time == "") {
            getMessages()->addError('Nie podano liczby czasu spłaty kredytu');
        }
        if ( $this->form->interest == "") {
            getMessages()->addError('Nie podano oprocentowania');
        }

        if (!getMessages() ->hasError()) {
            $this->form->amount = str_replace(",", ".", $this->form->amount);
            $this->form->interest = str_replace(",", ".", $this->form->interest);
            if (! is_numeric( $this->form->amount )) {
                getMessages()->addError('Kwota kredytu nie jest liczbą!');
            }

            if (! is_numeric( $this->form->time )) {
                getMessages()->addError('Czas spłaty nie jest liczbą całkowitą!');
            }

            if (! is_numeric( $this->form->interest )) {
                getMessages()->addError('Oprocentowanie nie jest liczbą!');
            }
        }

        if (!getMessages() ->hasError()) {

            $this->form->amount = floatval($this->form->amount);
            $this->form->time = intval($this->form->time);
            $this->form->interest = floatval($this->form->interest);

            if ($this->form->amount <= 0) {
                getMessages()->addError('Kwota kredytu musi być większa od 0');
            }

            if ($this->form->time <= 0) {
                getMessages()->addError('Czas spłaty musi wynosić przynajmniej rok');
            }
        }
        return !getMessages() ->hasError();
    }

    public function validateSecurity() {
        global $role;
        if ($this->form->amount > 10000 && $role != 'admin') {
            getMessages()->addError('Tylko admin może brać kredyt o kwocie większej niż 10 000');
        }
        if ($this->form->interest <= 0 && $role != 'admin') {
                getMessages()->addError('Tylko admin może brać kredyt bez oprocentowania');
            }
        return !getMessages() ->hasError();
    }

    public function process() {

        $this->getParams();
        if ($this->validate() && $this->validateSecurity()) {
            $timeInMonths = $this->form->time * 12;
            $this->result->result = ($this->form->amount / $timeInMonths) * (($this->form->interest / 100) + 1);
        }
        $this->generateView();
    }

    public function generateView() {
        global $conf;

        $smarty = getSmarty();
        $smarty->assign('app_root',$conf->app_root);
        $smarty->assign('app_url',$conf->app_url);
        $smarty->assign('root_path',$conf->root_path);

        $smarty->assign('form',$this->form);
        $smarty->assign('result',$this->result);
        $smarty->assign('messages',getMessages());
        $smarty->assign('conf',$conf);

        $smarty->assign('user_login',$_SESSION['role']);

        $smarty->display('CalcView.tpl');
    }
}