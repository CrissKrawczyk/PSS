<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\RoleUtils;
use core\ParamUtils;
use app\forms\SignUpForm;

class SignUpCtrl {

    private $form;

    public function __construct() {
        $this->form = new SignUpForm();
    }

    public function validate() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');
        $this->form->pass2 = ParamUtils::getFromRequest('pass2');
        $this->form->email = ParamUtils::getFromRequest('email');

        if (!isset($this->form->login))
            return false;

        if (empty($this->form->email)) {
            Utils::addErrorMessage('Nie podano e-mail');
        }
        if (empty($this->form->pass) || empty($this->form->pass2)) {
            Utils::addErrorMessage('Nie podano hasła');
        }

        if (App::getMessages()->isError())
            return false;

        if ($this->form->pass !=  $this->form->pass2) {
            Utils::addErrorMessage('Hasła różnią się');
            return false;
        }

        if (empty($this->form->login)) {
            $this->form->login = $this->form->email;
        }

        return !App::getMessages()->isError();
    }

    public function createUser() {
        App::getDB()->insert("user", [
            "login" => $this->form->login,
            "email" => $this->form->email,
            "password" => $this->form->pass,
            "modified_date" => date("Y-m-d")
        ]);
        $user_id = App::getDB()->id();
        App::getDB()->update("user", [
            "modified_user" => $user_id,
                ], [
            "id" => $user_id
        ]);
        App::getDB()->insert("user_role", [
            "user_id" => $user_id,
            "role_idn" => "user"
        ]);
        RoleUtils::setUserId($user_id);
        RoleUtils::addRole('user');
    }

    public function action_signUp() {
        if ($this->validate()) {
            $this->createUser();
            App::getRouter()->redirectTo("welcomePage");
        } else {
            $this->generateView();
        }
    }

    public function action_createUser() {
        if ($this->validate()) {
            $this->createUser();
            App::getRouter()->redirectTo("adminPage");
        } else {
            App::getSmarty()->assign('title', "Dodanie użytkownika");
            App::getSmarty()->assign('submitCaption', "dodaj");
            App::getSmarty()->assign('goTo', "createUser");
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('SignUpPage.tpl');
    }

}
