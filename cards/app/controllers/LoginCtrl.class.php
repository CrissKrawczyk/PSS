<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\RoleUtils;
use core\ParamUtils;
use app\forms\LoginForm;

class LoginCtrl {

    private $form;

    public function __construct() {
        //stworzenie potrzebnych obiektów
        $this->form = new LoginForm();
    }

    public function validate() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');

        if (!isset($this->form->login))
            return false;

        if (empty($this->form->login)) {
            Utils::addErrorMessage('Nie podano loginu');
        }
        if (empty($this->form->pass)) {
            Utils::addErrorMessage('Nie podano hasła');
        }

        if (App::getMessages()->isError())
            return false;
        $data = App::getDB()->select("user", [
            "[>]user_role" => ["id" => "user_id"]
        ], [
            "user_role.role_idn",
            "user.id"
        ], [
            "AND" => [
                "archive" => 0,
                "password" => $this->form->pass,
                "OR" => [
                    "email" => $this->form->login,
                    "login" => $this->form->login
                ]
            ]
        ]);
        if(empty($data)) {
            Utils::addErrorMessage('Niepoprawny login lub hasło');
        } else {
            foreach($data as $item) {
                RoleUtils::addRole($item["role_idn"]);
                RoleUtils::setUserId($item["id"]);
            }
        }

        return !App::getMessages()->isError();
    }

    public function action_login() {
        if ($this->validate()) {
            App::getRouter()->redirectTo("welcomeScreen");
        } else {
            $this->generateView();
        }
    }

    public function action_logout() {
        session_destroy();
        App::getRouter()->redirectTo('login');
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('LoginView.tpl');
    }

}
