<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\RoleUtils;
use core\ParamUtils;
use app\forms\UseCodeForm;

class UseCodeCtrl {

    private $form;

    public function __construct() {
        $this->form = new UseCodeForm();
    }

    public function validate() {
        $this->form->code = ParamUtils::getFromRequest('code');

        if (!isset($this->form->code))
            return false;

        if (empty($this->form->code)) {
            Utils::addErrorMessage('Nie podano kodu');
        }

        if (App::getMessages()->isError())
            return false;

        $isValidCode = !empty(App::getDB()->select("premium_code",[
            "code"
        ], [
            "AND" => [
                "code" => $this->form->code,
                "user_id" => null
            ]
        ]));

        if (!$isValidCode)
            Utils::addErrorMessage('Niepoprawny kod');

        return !App::getMessages()->isError();
    }

    public function givePremium() {
        if (RoleUtils::inRole("premium"))
            return;
        App::getDB()->insert("user_role", [
            "user_id" => RoleUtils::getUserId(),
            "role_idn" => "premium"
        ]);
        App::getDB()->update("premium_code", [
            "user_id" => RoleUtils::getUserId(),
            "used_date" => date("Y-m-d")
        ], [
            "code" => $this->form->code
        ]);
        RoleUtils::addRole("premium");
    }

    public function action_useCode() {
        if ($this->validate()) {
            $this->givePremium();
            App::getRouter()->redirectTo("userPage");
        } else {
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('UseCodeView.tpl');
    }

}
