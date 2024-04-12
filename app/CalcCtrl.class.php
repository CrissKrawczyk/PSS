<?php
require_once dirname(__FILE__).'/../config.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
include $conf->root_path.'/app/security/check.php';
require_once $conf->root_path.'/lib/vendor/autoload.php';
use Smarty\Smarty;

class CalcCtrl {

    private $msgs;
    private $form;
    private $result;

    public function __construct() {
        $this->msgs = new Messages();
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
            $this->msgs->addError('Nie podano wartości kredytu');
        }
        if ( $this->form->time == "") {
            $this->msgs->addError('Nie podano liczby czasu spłaty kredytu');
        }
        if ( $this->form->interest == "") {
            $this->msgs->addError('Nie podano oprocentowania');
        }

        if (!$this->msgs ->hasError()) {
            $this->form->amount = str_replace(",", ".", $this->form->amount);
            $this->form->interest = str_replace(",", ".", $this->form->interest);
            if (! is_numeric( $this->form->amount )) {
                $this->msgs->addError('Kwota kredytu nie jest liczbą!');
            }

            if (! is_numeric( $this->form->time )) {
                $this->msgs->addError('Czas spłaty nie jest liczbą całkowitą!');
            }

            if (! is_numeric( $this->form->interest )) {
                $this->msgs->addError('Oprocentowanie nie jest liczbą!');
            }
        }

        if (!$this->msgs ->hasError()) {

            $this->form->amount = floatval($this->form->amount);
            $this->form->time = intval($this->form->time);
            $this->form->interest = floatval($this->form->interest);

            if ($this->form->amount <= 0) {
                $this->msgs->addError('Kwota kredytu musi być większa od 0');
            }

            if ($this->form->time <= 0) {
                $this->msgs->addError('Czas spłaty musi wynosić przynajmniej rok');
            }
        }
        return !$this->msgs ->hasError();
    }

    public function validateSecurity() {
        global $role;
        if ($this->form->amount > 10000 && $role != 'admin') {
            $this->msgs->addError('Tylko admin może brać kredyt o kwocie większej niż 10 000');
        }
        if ($this->form->interest <= 0 && $role != 'admin') {
                $this->msgs->addError('Tylko admin może brać kredyt bez oprocentowania');
            }
        return !$this->msgs ->hasError();
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

        $smarty = new Smarty();
        $smarty->assign('app_root',$conf->app_root);
        $smarty->assign('app_url',$conf->app_url);
        $smarty->assign('root_path',$conf->root_path);

        $smarty->assign('form',$this->form);
        $smarty->assign('result',$this->result);
        $smarty->assign('messages',$this->msgs);

        $smarty->assign('user_login',$_SESSION['role']);

        $smarty->display($conf->root_path.'/app/calc_view.tpl');
    }
}